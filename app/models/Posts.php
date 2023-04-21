<?php

class Posts {
    private $db; // this refers to a PHP data object (PDO) that talks to the database

    public function __construct() {
        $this->db = new Database();
    }

    public function getPostCount() {
        $this->db->query("SELECT count(*) FROM posts");
        return $this->db->rowCount();
    }
    
    public function getAllPosts() {
        $this->db->query("SELECT post_id, name, title, body, created_at
            FROM users
            INNER JOIN posts
            ON users.user_id = posts.user_id
            ORDER BY created_at DESC
        ; ");
        return $this->db->resultSet();
    }

    public function getPost($post_id) {
        $this->db->query("SELECT users.user_id, post_id, name, title, body, created_at
            FROM users
            INNER JOIN posts
            ON users.user_id = posts.user_id
            WHERE post_id = :post_id");
        $this->db->bind("post_id", $post_id);
        return $this->db->single();
    }

    public function addPost($data) {
        $this->db->query(
            "INSERT INTO posts (user_id, title, body)
            VALUES (:user_id, :title, :body)");
        $this->db->bind("user_id", $_SESSION["userId"]);
        $this->db->bind("title", $data["post_title"]);
        $this->db->bind("body", $data["post_body"]);
        return $this->db->execute();
    }

    public function updatePost($data) {
        $this->db->query("UPDATE posts SET title = :title, body = :body WHERE post_id = :post_id");
        $this->db->bind(":post_id", $data["post_id"] );
        $this->db->bind(":title", $data["post_title"] );
        $this->db->bind(":body", $data["post_body"] );
        return $this->db->execute();
    }
    
    public function deletePost($id) {
        $this->db->query("DELETE FROM posts WHERE post_id = :post_id");
        $this->db->bind(":post_id", $id );
        return $this->db->execute();
    }



}