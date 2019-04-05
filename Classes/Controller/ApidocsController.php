<?php

namespace SaschaEnde\T3helpers\Controller;

use SaschaEnde\T3helpers\Helpers\DocBlock;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ApidocsController extends ActionController {

    public function listAction() {

        $this->view->assignMultiple([
            'docs' => $this->getDocs()
        ]);
    }

    public function markdownAction() {

        $this->view->assignMultiple([
            'docs' => $this->getDocs()
        ]);
    }

    private function getDocs() {
        $docs = [];

        // Get files
        $dir = PATH_typo3conf . 'ext/t3helpers/Classes/Utilities';
        $files = scandir($dir);

        foreach ($files as $className) {

            if ($className == '.' || $className == '..') {
                continue;
            }

            $className = str_replace('.php', '', $className);
            $reflectClass = new \ReflectionClass("SaschaEnde\\T3helpers\\Utilities\\" . $className);
            $reflectMethods = $reflectClass->getMethods();

            // Get Class docblock
            $docComment = $reflectClass->getDocComment();
            if (!empty($docComment)) {
                $classDocBlock = new DocBlock($docComment);
                $classDescription = $classDocBlock->description;
            } else {
                $classDescription = '';
            }


            $methods = [];
            foreach ($reflectMethods as $reflectMethod) {

                if ($reflectMethod->isPublic()) {

                    if ($reflectMethod->getName() == '__construct') {
                        continue;
                    }

                    // Example
                    $exampleFile = PATH_typo3conf . 'ext/t3helpers/Documentation/Examples/'.$className.'_'.$reflectMethod->getName().'.phpexample';
                    if(file_exists($exampleFile)){
                        $example = highlight_string(file_get_contents($exampleFile),true);
                        preg_match_all('/<code>(.*)<\/code>/ms', $example, $output_array);
                        $example = $output_array[1][0];
                    }else{
                        $example = false;
                    }


                    $docBlock = $reflectMethod->getDocComment();
                    if (!empty($docBlock)) {
                        $docBlock = new DocBlock($docBlock);

                        $docComment = [
                            'name' => $reflectMethod->getName(),
                            'paramstring' => $this->parseParameters($reflectMethod->getParameters()),
                            'description' => $docBlock->description,
                            'params' => $docBlock->all_params,
                            'example'   => $example
                        ];
                    } else {
                        $docComment = [
                            'name' => $reflectMethod->getName(),
                            'paramstring' => $this->parseParameters($reflectMethod->getParameters()),
                            'description' => false,
                            'params' => false,
                            'example'   => $example
                        ];
                    }

                    /** @var \ReflectionMethod $reflectMethod */
                    $methods[] = $docComment;
                }

            }

            // Example
            $exampleFile = PATH_typo3conf . 'ext/t3helpers/Documentation/Examples/'.$className.'.phpexample';
            if(file_exists($exampleFile)){
                $example = highlight_string(file_get_contents($exampleFile),true);
                preg_match_all('/<code>(.*)<\/code>/ms', $example, $output_array);
                $example = $output_array[1][0];
            }else{
                $example = false;
            }

            $docs[$className] = [
                'name' => $className,
                'description' => $classDescription,
                'example'   => $example,
                'methods' => $methods
            ];
        }

        return $docs;
    }

    private function parseParameters($params) {


        $p = [];
        foreach ($params as $param) {
            /** @var \ReflectionParameter $param */

            if ($param->isOptional()) {

                $default = $param->getDefaultValue();

                if ($param->getDefaultValue() === true) {
                    $default = 'true';
                } elseif ($param->getDefaultValue() === false) {
                    $default = 'false';
                } elseif ($param->getDefaultValue() === null) {
                    $default = 'null';
                } elseif (is_array($param->getDefaultValue())) {
                    $default = '[]';
                } elseif (is_int($param->getDefaultValue())) {
                    $default = $param->getDefaultValue();
                } else {
                    $default = '"' . $param->getDefaultValue() . '"';
                }

                $p[] = '<span class="label label-primary">$' . $param->getName() . ' = ' . $default . '</span>';
            } else {
                $p[] = '<span class="label label-danger">$' . $param->getName() . '</span>';
            }

        }


        return implode(', ', $p);
    }

    private function parseSingleParam($param) {
        $val = explode(' ', $param);
        $ret[] = array_shift($val);
        $ret[] = implode(' ', $val);
        return $ret;
    }

    private function getParams($docComment, $part = 'param') {
        // Parse Params
        $parsedParams = [];
        if (isset($docComment['params'][$part])) {
            foreach ($docComment['params'][$part] as $param) {
                $parsedParams[] = $this->parseSingleParam($param);
            }
        }
        return $parsedParams;
    }

}