<?php

function displayHello() {
    echo 'Hello, world';
}

function render($templateName, $vars = array()) {

    if(is_array($vars) && count($vars) > 0) extract($vars);

    Ob_start ();
    Ob_implicit_flush(0);

    include(TEMPLATES_DIR . $templateName . '.phtml');

    $out = ob_get_contents ();
    Ob_end_clean ();

    return $out;

}
