<?php

/**
 * Sample controller, extended from our abstract class "Controller"
 */
class TemplateController extends Controller {

    private string $test_data = 'none'; //Will store the data from the methode "testFunction", which demonstrate hw our router work

    /**
     * Our base entry point, use it in remplacment of the class' constructor
     *
     * @return void
     */
    function __entry(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->formReceived();
        } else {
            $_SESSION['form_error'] = "";
        }
        $this->createView('template', [
            'test_data' => $this->test_data,
            'models' => $this->getModels()
        ]);
    }

    /**
     * A testing function to call from our url thanks to our router
     * You can call this function with the following uri :
     * /template/testFunction
     * /template/testFunction/argument
     * /template/testFunction/arg1/arg2
     *
     * @return void
     */
    function testFunction(): void {
        $this->test_data = '<b class="color-function">testFunction()</b> call';
        $args = func_num_args();
        if($args > 0)
            $this->test_data = $this->test_data . ' with argument(s) : <i>';
        for($i = 0; $i < $args; $i++) {
            $this->test_data = $this->test_data . "<b class='color-variable'>" . func_get_arg($i) . "</b>" . (($i + 1 == $args) ? "</i>" : ", ");   
        }
    }

    /**
     * Will return all our models as an array
     * This method is private to prevent direct route access "template/getModels"
     *
     * @return Array List of all models stored in our current session
     */
    private function getModels(): Array {
        if(isset($_SESSION["Models"])) {

        } else {
            $_SESSION["Models"] = [];
        }

        return $_SESSION["Models"];
    }

    /**
     * Handles form submission via POST request.
     * This method will sanitizes our user's input, creates a TemplateModel, and stores it in the session.
     *
     * @return void
     */
    private function formReceived(): void {
        $_POST = filter_input_array(INPUT_POST, [
            'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'born' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'gender' => FILTER_VALIDATE_BOOLEAN
        ]); //Sanitize our inputs to prevent code injection

        $model = new TemplateModel(
            $_POST['name'],
            $_POST['born'],
            $_POST['gender']
        );
        array_push($_SESSION["Models"], $model);
    }

    /**
     * Clears all models from the session and redirects to the template page.
     *
     * @return void
     */
    function clearModels(): void {
        unset($_SESSION["Models"]);
        header("location: /template");
    }
}