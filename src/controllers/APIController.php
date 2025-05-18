<?php
/**
 * Handles API responses including static example data and randomly generated model data.
 * You can test it by viisting the Template page > API section
 */
class APIController extends Controller {
    /**
     * Returns a random name from our predefined list.
     *
     * @return string Randomly selected name.
     */
    private function randomName(): string {
        $random_names = array(
            'Johnathon', 'Anthony', 'Erasmo', 'Raleigh', 'Nancie', 'Tama', 'Camellia', 'Augustine',
            'Christeen', 'Luz', 'Diego', 'Lyndia', 'Thomas', 'Georgianna', 'Leigha', 'Alejandro',
            'Marquis', 'Joan', 'Stephania', 'Elroy', 'Zonia', 'Buffy', 'Sharie', 'Blythe', 'Gaylene',
            'Elida', 'Randy', 'Margarete', 'Margarett', 'Dion', 'Tomi', 'Arden', 'Clora', 'Laine',
            'Becki', 'Margherita', 'Bong', 'Jeanice', 'Qiana', 'Lawanda', 'Rebecka', 'Maribel',
            'Tami', 'Yuri', 'Michele', 'Rubi', 'Larisa', 'Lloyd', 'Tyisha', 'Samatha',
        );

        return $random_names[rand ( 0 , count($random_names) -1)];
    }

    /**
     * Outputs a static JSON response with example data.
     *
     * The response includes:
     * - a "text" field with a string typed value
     * - a "version" field with a float typed value
     * - an "object" field with two numeric properties
     *
     * @return void
     */
    function exempleData(): void {
        $data = [
            'text' => "hello world!",
            'version' => 1.4,
            'object' => [
                'prop1' => 1,
                'prop2' => 2
            ]
        ];

        header('Content-Type: application/json');
        echo(json_encode($data));
    }

    /**
     * Creates a TemplateModel instance with random values and outputs it as JSON.
     *
     * @return void
     */
    function exempleModelTemplate(): void {
        $model = new TemplateModel(
            $this->randomName(),
            date('Y-m-d'),
            (rand(0,1) == 1)
        );

        $data = [
            $model->getName(),
            $model->getBirthDate(),
            $model->getIsMale(),
            $model->getAge(),
        ];



        header('Content-Type: application/json');
        echo(json_encode($data));
    }
}