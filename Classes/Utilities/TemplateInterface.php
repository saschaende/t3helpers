<?php

namespace SaschaEnde\T3helpers\Utilities;

interface TemplateInterface {

    public function render($extension, $path, $variables = []);

}