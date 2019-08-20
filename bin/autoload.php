<?php
    spl_autoload_register(function (string $class) {
        $source_path = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
        if(is_readable($source_path))
        {
            require_once($source_path);
        }
    });