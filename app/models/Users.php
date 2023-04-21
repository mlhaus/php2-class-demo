<?php
class Users {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($user) {
        $this->db->query("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
        $this->db->bind(":name", $user["fullName"]);
        $this->db->bind(":email", $user["email"]);
        $this->db->bind(":password", password_hash($user["password1"], PASSWORD_DEFAULT));
        return $this->db->execute(); // will return true or false if the database processed the query
    }
    
    public function findUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(":email", $email);
        return $this->db->single();
    }
}