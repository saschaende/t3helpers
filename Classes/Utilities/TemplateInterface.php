<?php

namespace SaschaEnde\T3helpers\Utilities;

interface TemplateInterface {

    /**
     * Render a template
     * @param $extension gridelements
     * @param $path Resources/Private/Templates/Mytemplate.html
     * @param array $variables
     * @param null $controllerContext In your controller action use $this->controllerContext, important for using translation
     * @return string
     */
    public function render($extension, $path, $variables = [], $controllerContext = null);

}