<?php

class Core {
    private $currentController = "Page";
    private $currentMethod = "home";
    private $params = [];

    public function __construct() {
        $url = $this->getURL();

        // Get the controller
        if(isset($url[0]) && file_exists("../app/controllers/" . ucfirst($url[0]) . ".php")) {
            $this->currentController = ucfirst($url[0]);
            unset($url[0]);
        } 
        require_once("../app/controllers/" . $this->currentController . ".php");
        // Example: new Page object is assigned to the controller
        $this->currentController = new $this->currentController;

        // Get the method
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Get the parameters
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL() {
        if(isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = strtolower(filter_var($url, FILTER_SANITIZE_URL));
            $url = explode("/", $url);
            return $url;
        }

    }
}
