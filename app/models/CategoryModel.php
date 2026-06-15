<?php
class CategoryModel {
    private $conn;
    private $table_name = "category";

    public function __construct($db) { $this->conn = $db; }

    public function getCategories() {
        $stmt = $this->conn->prepare("SELECT id, name, description FROM " . $this->table_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function addCategory($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (name, description) VALUES (:name, :description)");
        $stmt->bindParam(':name', htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($description)));
        return $stmt->execute() ? true : false;
    }
    public function updateCategory($id, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET name=:name, description=:description WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(':description', htmlspecialchars(strip_tags($description)));
        return $stmt->execute() ? true : false;
    }
    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id=:id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute() ? true : false;
    }
}
?>
