<?php
namespace App\Service;

use App\DAO\UserDAO;
use App\Entity\User;

class Authentification {

    private UserDAO $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function register(string $username, string $password, string $email, string $role): bool {
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $status = $role === "student" ? "active" : "pending"; 
        $user = new User(null, $username, $hashedPassword, $email, $role,$status);

        return $this->userDAO->saveUser($user);
    }

    public function login(string $username, string $password): ?User {
        $user = $this->userDAO->getUserByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            return $user;
        }
        return null;
    }

    public function logout(): void 
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        // Destroy the session
        session_destroy();
    }

    public function isAuthenticated(): bool 
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser(): ?User {
        
        if ($this->isAuthenticated()) {
            return $this->userDAO->getUserById($_SESSION['user_id']);
        }
        return null;
    }
    public function isAdmin() : bool
    {
        if($this->isAuthenticated()){
            $currentUser = $this->getCurrentUser();
            return $currentUser->role === "admin";
        }
        return false;
    }
}
