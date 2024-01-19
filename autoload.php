<?php

spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Assuming your project root is the parent directory of 'classes'
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . $classPath . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
