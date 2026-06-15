<?php require_once 'app/helpers/SessionHelper.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:linear-gradient(135deg,#f0f4ff,#fef9ff); min-height:100vh; font-family:'Segoe UI',sans-serif; }
        .navbar { background:linear-gradient(90deg,#667eea,#764ba2); box-shadow:0 4px 15px rgba(102,126,234,.35); }
        .navbar-brand, .nav-link { color:#fff!important; font-weight:600; }
        .nav-link:hover { opacity:.8; }
        .cart-badge { background:#e94560; color:#fff; border-radius:50px; padding:.1rem .5rem; font-size:.75rem; }
        .nav-user { background:rgba(255,255,255,.2); border-radius:50px; padding:.3rem 1rem; font-size:.9rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand" href="http://127.0.0.1:8888/DOHOANGDANH/Product"><i class="bi bi-shop me-2"></i>ShopAdmin</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto gap-2 align-items-center">
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/Product"><i class="bi bi-box-seam me-1"></i>Sản phẩm</a></li>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/Category/list"><i class="bi bi-tags me-1"></i>Danh mục</a></li>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/Product/apiFrontend">🛠️ API Frontend</a></li>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/Product/cart">
                <i class="bi bi-cart me-1"></i>Giỏ hàng
                <?php if (!empty($_SESSION['cart'])): ?>
                <span class="cart-badge"><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?></span>
                <?php endif; ?>
            </a></li>
            <?php if (SessionHelper::isLoggedIn()): ?>
            <li class="nav-item">
                <span class="nav-link nav-user"><i class="bi bi-person-circle me-1"></i><?php echo $_SESSION['username']; ?>
                <?php if (SessionHelper::isAdmin()): ?><span class="badge bg-warning text-dark ms-1">Admin</span><?php endif; ?>
                </span>
            </li>
            <?php if (SessionHelper::isAdmin()): ?>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/Product/add"><i class="bi bi-plus-circle me-1"></i>Thêm mới</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/account/logout"><i class="bi bi-box-arrow-right me-1"></i>Đăng xuất</a></li>
            <?php else: ?>
            <li class="nav-item" id="nav-login"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/account/login"><i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập</a></li>
            <li class="nav-item"><a class="nav-link" href="http://127.0.0.1:8888/DOHOANGDANH/account/register"><i class="bi bi-person-plus me-1"></i>Đăng ký</a></li>
            <?php endif; ?>
            <li class="nav-item" id="nav-logout" style="display:none;"><a class="nav-link" href="#" onclick="jwtLogout()"><i class="bi bi-box-arrow-right me-1"></i>Đăng xuất JWT</a></li>
        </ul>
    </div>
</nav>
<div class="container mt-4">

<script>
function jwtLogout() {
    localStorage.removeItem('jwtToken');
    location.href = '/DOHOANGDANH/account/login';
}
document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('jwtToken');
    if (token) {
        document.getElementById('nav-logout').style.display = 'block';
    }
});
</script>