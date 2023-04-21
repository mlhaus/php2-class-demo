<?php
class Post extends Controller {
    public function __construct(){
        // Don't allow unregistered users from viewing this page
        if(!isLoggedIn()) {
            redirect("/user/login");
        }
        $this->postModel = $this->model("Posts");
    }

    public function home() {
        $posts = $this->postModel->getAllPosts();
        $data = [
            "title" => "All Posts",
            "posts" => $posts
        ];
        $this->view("post/all", $data);
    }

    public function show($id) {
        $post = $this->postModel->getPost($id);
        $data = [
            "title" => $post->title,
            "post" => $post
        ];
        $this->view("post/show", $data);
    }

    public function add() {
        $data = [
            "title" => "Add New Post",
            "post_title" => "",
            "post_body" => "",
            "post_title_error" => "",
            "post_body_error" => ""
        ];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $data["post_title"] = sanitize($_POST["post_title"]);
            $data["post_body"] = sanitize($_POST["post_body"]);
            if(empty($data["post_title"])) {
                $data["post_title_error"] = "Title is required";
            }
            if(empty($data["post_body"])) {
                $data["post_body_error"] = "Post is required";
            }
            if(empty($data["post_title_error"]) && empty($data["post_body_error"])) {
                try {
                    if ($this->postModel->addPost($data)) {
                        // data successfully added
                        flash("post_message", "Your post was created");
                        redirect("/post");
                        return;
                    }
                } catch (PDOException $e) {
                    flash("post_message", "Your post could not be created. Try again later.", "alert alert-danger");

                }
            }
        }
        $this->view("post/add", $data);
    }

    public function edit($id) {
        $post = $this->postModel->getPost($id);
        if($post->user_id != $_SESSION["userId"]) {
            redirect("/post");
            return;
        }
        $data = [
            "title" => "Edit Post",
            "post_id" => $post->post_id,
            "post_title" => $post->title,
            "post_body" => $post->body,
            "post_title_error" => "",
            "post_body_error" => ""
        ];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $data["post_title"] = sanitize($_POST["post_title"]);
            $data["post_body"] = sanitize($_POST["post_body"]);
            if(empty($data["post_title"])) {
                $data["post_title_error"] = "Title is required";
            }
            if(empty($data["post_body"])) {
                $data["post_body_error"] = "Post is required";
            }
            if(empty($data["post_title_error"]) && empty($data["post_body_error"])) {
                try {
                    if ($this->postModel->updatePost($data)) {
                        // data successfully added
                        flash("post_message", "Your post was updated");
                        redirect("/post");
                        return;
                    }
                    // ??
                } catch (PDOException $e) {
                    flash("post_message", "Your post could not be updated. Try again later.", "alert alert-danger");
                }
            }
        }
        $this->view("post/edit", $data);
    }

    public function delete($id) {
        $post = $this->postModel->getPost($id);
        if($post->user_id != $_SESSION["userId"]) {
            redirect("/post");
            return;
        }
        try {
            if ($this->postModel->deletePost($id)) {
                flash("post_message", "Your post was deleted");
                redirect("/post");
            }
        } catch(PDOException $e) {
            flash("post_message", "Your post could not be deleted. Try again later.", "alert alert-danger");
            $this->show($id);
        }
    }
}









