<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\User;

class UserDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    // Helpers
    private function mapRowToUser(array $row): User 
    {
        return new User(
            $row['user_id'], 
            $row['username'], 
            $row['password'], 
            $row['email'], 
            $row['role'], 
            $row['status']
        );
    }

    // CRUD Operations
    public function getAllUsers(): array 
    {
        $query = "SELECT * FROM Users";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
    }

    public function getUserById(int $id): ?User 
    {
        $query = "SELECT * FROM Users WHERE user_id = :user_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':user_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return $this->mapRowToUser($row);
        }
        return null;
    }

    public function saveUser(User $user): bool 
    {
        $stmt = $this->con->prepare("INSERT INTO Users (username, password, email, role, status) VALUES (:username, :password, :email, :role, :status)");
        return $stmt->execute([
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status
        ]);
    }

    public function updateUser(User $user): bool {
        $stmt = $this->con->prepare("UPDATE Users SET username = :username, password = :password, email = :email, role = :role, status = :status WHERE user_id = :user_id");
        return $stmt->execute([
            'user_id' => $user->id,
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status
        ]);
    }

    public function deleteUser(int $id): bool {
        $stmt = $this->con->prepare("DELETE FROM Users WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $id]);
    }

    public function getUserByEmail(string $email): ?User {
        $query = "SELECT * FROM Users WHERE email = :email";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToUser($row);
        }
        return null;
    }

    public function verifyPassword(string $email, string $password): bool {
        $user = $this->getUserByEmail($email);
        if ($user) {
            return password_verify($password, $user->password);
        }
        return false;
    }
}
