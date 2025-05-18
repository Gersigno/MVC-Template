<?php
/**
 * Abstract base Controller class.
 * This class handles session initialization, automatic CSRF token validation, and view rendering.
 * !Please extend any controllers from this class !
 */
abstract class Controller {

    /**
     * Controller's constructor: Starts a session and validates CSRF tokens.
     * Generates a new CSRF token if we are not on our API route.
     */
    public function __construct() {
        session_start(); //Start our session whenever a controller is loaded
        $this->isCSRFvalid(); //Check for any invalid CSRF token before creating a new one.

        if(explode("/", $_SERVER["REQUEST_URI"])[1] != CONFIG['api_controller']) {
            $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        }
    }

    /**
     * Validates CSRF token for any POST requests.
     * If the token is missing or invalid, it terminates the request with a 405 error.
     *
     * @return void
     */
    private function isCSRFvalid(): void {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && explode("/", $_SERVER["REQUEST_URI"])[1] != CONFIG['api_controller']){
            $token = filter_var($_POST['token'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$token || $token !== $_SESSION['token']) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                die;
            } 
        }
    }

    /**
     * Entry point for the controller when called by the router.
     * *PLEASE ALSO CHANGE THE VALUE OF THE KEY 'controller_base_entry' IN THE CONFIG FILE IF YOU CHANGE THIS METHOD'S NAME*
     */
    public function __entry(): void {
        
    }

    /**
     * This method will create our view and bring our data in it as accessible variables
     *
     * @param string $view target view name
     * @param array $data optional data to pass to our view
     * @return void
     */
    protected function createView($view, $data = []): void {
        $view = ucfirst($view) . 'View'; //Build our view's file name
        if (file_exists(ROOT . '/views/' . $view . '.php')) {
            extract($data); //Extract our data array as variables accessable by our view
            ob_start();
            include(ROOT . '/views/' . $view . '.php'); //Include our view file
            $content = ob_get_clean();
            include(ROOT . '/views/View.php'); //Then, we include our base view.
        } else {
            echo("<br><br><h1>⚠️Error: View not found: " . $view . "</h1>");
        }
    }
}