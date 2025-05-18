<?php

define('ROOT',      dirname(__DIR__));                  //We first define our ROOT constant, which will be used to store our root path
define('CONFIG',    parse_ini_file(ROOT . '/config.ini'));   //Then we create a CONFIG constant that will store our parsed config from our file config.ini

require_once ROOT . '/core/Autoloader.php';
Autoloader::init();

new Router();