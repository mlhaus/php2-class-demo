<?php

class Controller {
    public function __construct() {
        
    }
    public function model($model) {
        // Does this need a file_exists if statement
        require_once("../app/models/" . $model . ".php");
        return new $model;
    }
    public function view($view, $data = []) {
        if(file_exists("../app/views/" . $view . ".php")) {
            require_once("../app/views/" . $view . ".php");
        } else {
            // TODO require a view that contains a 404 notification
            die("Page not found");
        }
    }
}