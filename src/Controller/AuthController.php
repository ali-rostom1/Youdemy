<?php

    namespace App\Controller;

    use App\DAO\UserDAO;
    use App\Service\Authentification;

    class AuthController{
        private Authentification $auth;
        private UserDAO $userDAO;

        public function __construct()
        {
            $this->auth = new Authentification();
            $this->userDAO = new UserDAO();
        }
        public function login() : void
        {
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $email = $_POST["loginEmail"];
                $password = $_POST["loginPassword"];
                $user = $this->auth->login($email,$password);
                if($user)
                {
                    switch($user->role)
                    {
                        case "teacher":
                            header("location: /catalogue");
                            break;
                        case "student":
                            header("location: /");
                            break;
                        case "admin":
                            header("location: /admin");
                            break;
                        default:
                            header("/authentification");
                            break;
                    }
                    exit;
                }else{
                    header("location: /authentification");
                    exit;
                }
            }
        }
        public function index() : void
        {
            if(!$this->auth->isAuthenticated()){
                include "../src/Views/authentification.php";
            }else if($this->auth->isAdmin()){
                header("location: /admin");
                exit;
            }else{
                header("location: /catalogue");
                exit;
            }
        }
        public function logout()
        {
            $this->auth->logout();
            header("location: /authentification");
            exit;
        }
    }