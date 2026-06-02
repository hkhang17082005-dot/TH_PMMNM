<?php
class ProductModel {
    private $conn;
    private $table_name = "product";

    public function __construct($db) { $this->conn = $db; }

    public function getProducts() {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name FROM " . $this->table_name . " p LEFT JOIN category c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getProductById($id) {
        $query = "SELECT p.*, c.name as category_name FROM " . $this->table_name . " p LEFT JOIN category c ON p.category_id = c.id WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function addProduct($name, $description, $price, $category_id, $image) {
        $errors = [];
        if (empty($name)) $errors['name'] = 'Tên sản phẩm không được để trống';
        if (empty($description)) $errors['description'] = 'Mô tả không được để trống';
        if (!is_numeric($price) || $price < 0) $errors['price'] = 'Giá không hợp lệ';
        if (count($errors) > 0) return $errors;
    
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        $n = htmlspecialchars(strip_tags($name));
        $d = htmlspecialchars(strip_tags($description));
        $p = htmlspecialchars(strip_tags($price));
        $c = htmlspecialchars(strip_tags($category_id));
        $i = htmlspecialchars(strip_tags($image));
        $stmt->bindParam(':name', $n);
        $stmt->bindParam(':description', $d);
        $stmt->bindParam(':price', $p);
        $stmt->bindParam(':category_id', $c);
        $stmt->bindParam(':image', $i);
        return $stmt->execute() ? true : false;
    }
    public function updateProduct($id, $name, $description, $price, $category_id, $image) {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id, image=:image WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $n = htmlspecialchars(strip_tags($name));
        $d = htmlspecialchars(strip_tags($description));
        $p = htmlspecialchars(strip_tags($price));
        $c = htmlspecialchars(strip_tags($category_id));
        $im = htmlspecialchars(strip_tags($image));
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $n);
        $stmt->bindParam(':description', $d);
        $stmt->bindParam(':price', $p);
        $stmt->bindParam(':category_id', $c);
        $stmt->bindParam(':image', $im);
        return $stmt->execute() ? true : false;
    }
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute() ? true : false;
    }
    public function addProductImages($product_id, $images) {
        foreach ($images as $image) {
            $query = "INSERT INTO product_images (product_id, image) VALUES (:product_id, :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        }
    }
    public function getProductImages($product_id) {
        $query = "SELECT * FROM product_images WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>