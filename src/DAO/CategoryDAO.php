<?php
namespace App\DAO;

use App\Database\Database;
use App\Entity\Category;


class CategoryDAO {
    private \PDO $con;

    public function __construct() {
        $this->con = Database::getInstance()->getConnection();
    }

    private function mapRowToCategory(array $row): Category {
        return new Category($row['name'], $row['description'],$row['category_id']);
    }
    
    public function getAllCategories(): array {
        $query = "SELECT * FROM Categories";
        $stmt = $this->con->query($query);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = $this->mapRowToCategory($row);
        }
        return $categories;
    }

    public function getCategoryById(int $id): ?Category {
        $query = "SELECT * FROM Categories WHERE category_id = :category_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':category_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return $this->mapRowToCategory($row);
        }
        return null;
    }

    public function saveCategory(Category $category): bool {
        $stmt = $this->con->prepare("INSERT INTO Categories (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            'name' => $category->name,
            'description' => $category->description
        ]);
    }

    public function updateCategory(Category $category): bool {
        $stmt = $this->con->prepare("UPDATE Categories SET name = :name, description = :description WHERE category_id = :category_id");
        return $stmt->execute([
            'category_id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ]);
    }

    public function deleteCategory(int $id): bool {
        $stmt = $this->con->prepare("DELETE FROM Categories WHERE category_id = :category_id");
        return $stmt->execute(['category_id' => $id]);
    }
}
