<?php
    
	spl_autoload_register(function(string $class_name){
        $path = $class_name . '.php';
        
        if(file_exists($path)) {
            require_once $path;
        }
    });


