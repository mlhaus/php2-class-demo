<?php
// Define site-wide variables
define("APPROOT", dirname(__FILE__, 2));

if($_SERVER["HTTP_HOST"] == "localhost") {
    // localhost
    $debug = true;
    define("URLROOT", "http://localhost/shareposts"); // Change mvc to whatever the current project is
    define("DB_HOST", "127.0.0.1");
    define("DB_PORT", "3307");
    define("DB_USER", "root");
    define("DB_PASS", "password");
    define("DB_NAME", "shareposts_23"); 
} else if($_SERVER["HTTP_HOST"] == "march58.sg-host.com") {
    $debug = false;
    define("URLROOT", "https://". $_SERVER["HTTP_HOST"]."/shareposts"); // Remove /mvc if this is the only project on the server
    define("DB_HOST", "localhost");
    define("DB_PORT", "3306");
    define("DB_USER", "uxo2mbapnjhmw");
    define("DB_PASS", "qkcG5*(kG724");
    define("DB_NAME", "dbizxlaveseavk");
}
define("SITENAME", "Share Posts");