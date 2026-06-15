<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');
require_once('app/utils/JWTHandler.php');

class AccountController {
    private $accountModel;
    private $db;
    private $jwtHandler;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    public function register() {
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $errors = [];
            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullName!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp";
            if (!in_array($role, ['admin', 'user'])) $role = 'user';
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                
                $result = $this->accountModel->save($username, $fullName, $password, $role);
                if ($result) {
                    header('Location: http://127.0.0.1:8888/DOHOANGDANH/account/login');
                    exit;
                }
            }
        }
    }

    public function logout() {
        SessionHelper::start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: http://127.0.0.1:8888/DOHOANGDANH/Product');
        exit;
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                SessionHelper::start();
                if (!isset($_SESSION['username'])) {
                    $_SESSION['username'] = $account->username;
                    $_SESSION['role'] = $account->role;
                }
                header('Location: http://127.0.0.1:8888/DOHOANGDANH/Product');
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
                include_once 'app/views/account/login.php';
                exit;
            }
        }
    }

   public function apiLogin() {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';
    $user = $this->accountModel->getAccountByUsername($username);
    if ($user && password_verify($password, $user->password)) {
        // Set session
        SessionHelper::start();
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;
        // Tạo JWT token
        $token = $this->jwtHandler->encode(['id' => $user->id, 'username' => $user->username]);
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Invalid credentials']);
    }
}
}
?>