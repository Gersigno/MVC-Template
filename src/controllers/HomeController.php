<?php
class HomeController extends Controller {

    function __entry(): void {
        $this->createView('home');
    }
}