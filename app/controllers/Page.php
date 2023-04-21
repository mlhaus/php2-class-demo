<?php

class Page extends Controller {
    public function __construct() {
        
    }
    public function home() {
        if(isLoggedIn()) {
            redirect("/post");
        }
        $data = [
            "title" => "Home",
            "description" => "A simple social media network written in PHP"
        ];
        $this->view("page/home", $data);
    }
    public function about() {
        $data = [
            "title" => "About",
        ];
        $this->view("page/about", $data);
    }
    
}