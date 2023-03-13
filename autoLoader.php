<?php

function myAutoLoader($class) {
        $classFile = __DIR__ . "/{$class}.php";
        if(file_exists($classFile) && is_readable($classFile)) {
                include $classFile;
        } else {
                die( "Could not read file directory : {$classFile}");
        }
}

spl_autoload_register("myAutoLoader");

