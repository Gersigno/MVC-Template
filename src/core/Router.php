<?php

class Router {
    /**
     * Remove any '/' at the end of our uri
     * @param string $request_uri target uri
     */
    private function trailing(): void {
        $request_uri = $_SERVER['REQUEST_URI'];
        if (!empty($request_uri) && $request_uri != "/" && $request_uri[-1] === "/") {
            //If our uri is not emptry and endup with an '/'
            $request_uri = rtrim($request_uri, '/'); //Remove our "/" character from our uri
            http_response_code(301); //Permanent redirect code
            header('Location: ' . $request_uri); //Then, we redirect to our final url
            exit; //Stop execution after redirect
        }
    }

    /**
     * Our class' constructor magic function, automatically called whenever our class is instanced.
     */
    public function __construct() {
        $uri = $this->trailing(); //Remove any "/" at the end of our request url
        
        $parameters = explode('/', $_GET['p'] ?? ''); //"Parse" our uri sub-pages passed as url parameter(s) (thanks to our .htaccess file located in our public directory)

        $target_controller = $parameters[0]; //Store our first uri parameter, used to find the right controller

        if(!empty($target_controller)) {
            $target_controller = ucfirst($target_controller) . 'Controller'; //Define the real name of our controller ("Home" became "HomeController")
            $controller_path = ROOT . "/controllers/" .$target_controller . ".php";
            
            if (file_exists($controller_path)) {
                $target_controller = new $target_controller(); //Instanciate our controller
                $entryMethod = CONFIG['controller_base_entry']; //Store our entry function's name
                $action = (!empty($parameters[1])) ? $parameters[1] : $entryMethod; //controller's methode name (check 'controller_base_entry' from our config file)

                if (method_exists($target_controller, $action)) {
                    //Call the requested method (if not the same as our entry method to avoid duplicate calls)
                    if ($action !== $entryMethod) {
                        call_user_func_array([$target_controller, $action], array_slice($parameters, 2));
                    }
                } else {
                    boolval(CONFIG['redirect_on_not_found']) ? header('Location: /') : http_response_code(404);
                    return; //Stop method execution
                }

                //Then, after page's data (if any) got proceed and injected, we call our constructor entry to render our view
                if (method_exists($target_controller, $entryMethod)) {
                    call_user_func([$target_controller, $entryMethod]);
                }
            } else {
                //If our controller's file do not exist, we redirect our user to our index OR we throw an 404 error depending on our config file (../config.ini)
                boolval(CONFIG['redirect_on_not_found']) ? header('Location: /') : http_response_code(404);
                return; //Stop method execution
            }
        } else {
            $target_controller = new (CONFIG['index_controller'] . 'Controller')(); //find our index controller from our config.ini file and instanciate it
            call_user_func([$target_controller, CONFIG['controller_base_entry']]); //Call our controller's entry point (check 'controller_base_entry' from our config file)
        }
    }
}