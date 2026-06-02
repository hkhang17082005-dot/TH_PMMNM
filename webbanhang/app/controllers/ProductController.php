<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class ProductController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function index() {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }
    public function show($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) include 'app/views/product/show.php';
        else echo "Không thấy sản phẩm.";
    }
    public function add() {
        if (!SessionHelper::isAdmin()) {
            header('Location: ' . BASE_URL . '/Product');
            exit;
        }
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }
    public function save() {
        if (!SessionHelper::isAdmin()) {
            header('Location: ' . BASE_URL . '/Product');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $image = '';
                }
            }
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                $product_id = $this->productModel->getLastInsertId();
                if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
                    $uploadedImages = [];
                    foreach ($_FILES['images']['name'] as $key => $name2) {
                        if ($_FILES['images']['error'][$key] == 0) {
                            try {
                                $file = [
                                    'name'     => $_FILES['images']['name'][$key],
                                    'tmp_name' => $_FILES['images']['tmp_name'][$key],
                                    'size'     => $_FILES['images']['size'][$key],
                                    'error'    => $_FILES['images']['error'][$key],
                                ];
                                $uploadedImages[] = $this->uploadImage($file);
                            } catch (Exception $e) { }
                        }
                    }
                    if (!empty($uploadedImages)) {
                        $this->productModel->addProductImages($product_id, $uploadedImages);
                    }
                }
                header('Location: ' . BASE_URL . '/Product');
            }
        }
    }
    public function edit($id) {
        if (!SessionHelper::isAdmin()) {
            header('Location: ' . BASE_URL . '/Product');
            exit;
        }
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) include 'app/views/product/edit.php';
        else echo "Không thấy sản phẩm.";
    }
    public function update() {
        if (!SessionHelper::isAdmin()) {
            header('Location: ' . BASE_URL . '/Product');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                try {
                    $image = $this->uploadImage($_FILES['image']);
                } catch (Exception $e) {
                    $image = $_POST['existing_image'];
                }
            } else {
                $image = $_POST['existing_image'];
            }
            if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
                $uploadedImages = [];
                foreach ($_FILES['images']['name'] as $key => $name2) {
                    if ($_FILES['images']['error'][$key] == 0) {
                        try {
                            $file = [
                                'name'     => $_FILES['images']['name'][$key],
                                'tmp_name' => $_FILES['images']['tmp_name'][$key],
                                'size'     => $_FILES['images']['size'][$key],
                                'error'    => $_FILES['images']['error'][$key],
                            ];
                            $uploadedImages[] = $this->uploadImage($file);
                        } catch (Exception $e) { }
                    }
                }
                if (!empty($uploadedImages)) {
                    $this->productModel->addProductImages($id, $uploadedImages);
                }
            }
            $edit = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);
            if ($edit) header('Location: ' . BASE_URL . '/Product');
            else echo "Lỗi khi lưu sản phẩm.";
        }
    }
    public function delete($id) {
        if (!SessionHelper::isAdmin()) {
            header('Location: ' . BASE_URL . '/Product');
            exit;
        }
        if ($this->productModel->deleteProduct($id)) header('Location: ' . BASE_URL . '/Product');
        else echo "Lỗi khi xóa sản phẩm.";
    }
    public function addToCart($id) {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/account/login');
            exit;
        }
        $product = $this->productModel->getProductById($id);
        if (!$product) { echo "Không tìm thấy sản phẩm."; return; }
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
                'image'    => $product->image
            ];
        }
        header('Location: ' . BASE_URL . '/Product/cart');
    }
    public function cart() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }
    public function removeFromCart($id) {
        if (isset($_SESSION['cart'][$id])) unset($_SESSION['cart'][$id]);
        header('Location: ' . BASE_URL . '/Product/cart');
    }
    public function checkout() {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/account/login');
            exit;
        }
        include 'app/views/product/checkout.php';
    }
    public function processCheckout() {
        if (!SessionHelper::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/account/login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống."; return;
            }
            $this->db->beginTransaction();
            try {
                $stmt = $this->db->prepare("INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $stmt = $this->db->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)");
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':price', $item['price']);
                    $stmt->execute();
                }
                unset($_SESSION['cart']);
                $this->db->commit();
                header('Location: ' . BASE_URL . '/Product/orderConfirmation');
            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Lỗi: " . $e->getMessage();
            }
        }
    }
    public function orderConfirmation() {
        include 'app/views/product/orderConfirmation.php';
    }
    private function uploadImage($file) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ["jpg","jpeg","png","gif","webp"])) {
            throw new Exception("Chỉ cho phép JPG, PNG, GIF, WEBP.");
        }
        if ($file["size"] > 10 * 1024 * 1024) throw new Exception("Hình ảnh quá lớn.");
        $newName = time() . '_' . basename($file["name"]);
        $target_file = $target_dir . $newName;
        if (!move_uploaded_file($file["tmp_name"], $target_file)) throw new Exception("Lỗi khi tải lên.");
        return $target_file;
    }
}
?>