<?php

class Autoloader {
    /**
     * This function initialize our autoloader
     * @return void
     */
    public static function init(): void {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    } 

    /**
     * Include our class' file
     * @param $class string Class' name intended to be loaded
     * 
     * @return void
     */
    public static function autoload($class): void {
        $directory = array(
            'core/', 
            'models/', 
            'controllers/'
        ); //A list (array) of all of our folders that should be check by our autoloader to find our files.

        $found = false; //This variable will be used to check if our file was found in one of our folders.
        $file; //This variable will store our possible file path if it was found in one of our folders.
        foreach ($directory as $current_dir) {
            $path = ROOT . "/" .  $current_dir . $class . '.php';
            if(file_exists($path)) { //If our file exist in the current directory
                $found = true; //Set the found state to true
                $file = $path; //Set the file's path
                break; //Then break our foreach
            }
        }
        if($found) {
            //If our file was found, we include it with require_once.
            require_once $file;
        } else {
            //If our file wasn't found in any of our folders
            http_response_code(500);
            echo("Error : File not found ('{$class}')!");
        }
    }
}