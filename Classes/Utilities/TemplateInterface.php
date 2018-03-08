<?php

namespace SaschaEnde\T3helpers\Utilities;

interface TemplateInterface {

    public function renderTemplate($extension, $path, $variables = []);

}