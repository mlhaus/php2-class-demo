<?php
class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model("Users");
    }

    public function register() {
        if(isLoggedIn()) {
            redirect("/post");
        }
        $data = [
            "title" => "Register an Account",
            // Include default values for form inputs
            "fullName" => "",
            "email" => "",
            "password1" => "",
            "password2" => ""
        ];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // The user submitted the registration form

            // Get and validate full name
            $data["fullName"] = sanitize($_POST["fullName"]);
            if($data["fullName"] == "") {
                $data["fullName_error"] = "Your name is required";
            }

            // Get and validate email
            $data["email"] = sanitize($_POST["email"]);
            if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                $data["email_error"] = "Invalid email address format";
            } else {
                // if email is valid, check if it already exists in the database
                if($this->userModel->findUserByEmail($data["email"])) {
                    $data["email_error"] = "That email address is already taken. Please login.";
                }
            }

            // Get and validate password
            $data["password1"] = sanitize($_POST["password1"]);
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $data["password1"])) {
                $data["password1_error"] = "Your password must include a minimum eight characters, at least one uppercase letter, one lowercase letter and one number";
            }

            // Get and validate password
            $data["password2"] = sanitize($_POST["password2"]);
            if($data["password2"] == "") {
                $data["password2_error"] = "Password confirmation required";
            }
            if($data["password2"] != $data["password1"]) {
                $data["password2_error"] = "Passwords must match";
            }

            if(empty($data["name_error"]) && empty($data["email_error"]) && empty($data["password1_error"]) && empty($data["password2_error"])) {
                try {
                    $rowcount = $this->userModel->register($data);
                } catch(PDOException $e) {
                    flash("register_fail", "Your account could not be created. Try again later.", "alert alert-danger");
                }
                if($rowcount == 1) {
                    // Will run if the user is added to the database
                    flash("register_success", "Welcome! Please log in to continue.");
                    redirect("/user/login");
                }
            } else {
                flash("register_fail", "Please fix the following errors.", "alert alert-danger");
            }

        }
        $this->view("user/register", $data);
    }

    public function login() {
        if(isLoggedIn()) {
            redirect("/post/");
        }
        $data = [
            "title" => "Login",
            // Include default values for form inputs
            "email" => "",
            "password1" => ""
        ];
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $data["email"] = sanitize($_POST["email"]);
            $data["password1"] = sanitize($_POST["password1"]);
            $userFromDatabase = $this->userModel->findUserByEmail($data["email"]);
            if(!empty($userFromDatabase) && password_verify($data["password1"], $userFromDatabase->password)) {
                // The email and password matched
                $_SESSION["userId"] = $userFromDatabase->user_id;
                $_SESSION["userName"] = $userFromDatabase->name;
                $_SESSION["userEmail"] = $userFromDatabase->email;
                // For the capstone project, set more session data, like the "admin" and "status"
                flash("login-success", "Good " . getTimeDescription() . ", " . $_SESSION["userName"] . "!");
                redirect("/post/");
            } else {
                // One or both were incorrect
                flash("login-fail", "The email or password you entered is not correct", "alert alert-warning");
            }
        }
        $this->view("user/login", $data);
    }

    public function logout() {
        //        session_destroy();
        unset($_SESSION["userId"]);
        unset($_SESSION["userName"]);
        unset($_SESSION["userEmail"]);
        flash("logout-success", "You have been logged out. Have a nice day!");
        redirect("/user/login");
    }
}