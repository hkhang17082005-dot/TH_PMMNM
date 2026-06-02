<?php require_once 'app/helpers/SessionHelper.php'; ?>
<!DOCTYPE html>
<html lang="vi" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #0a0a0a; color: #e0e0e0; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar { background-color: #000000; border-bottom: 1px solid #333; }
        .navbar-brand { color: #fff !important; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        .nav-link { color: #ccc !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover { color: #fff !important; opacity: 1; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        .cart-badge { background: #ffffff; color: #000000; border-radius: 50px; padding: .1rem .5rem; font-size: .75rem; font-weight: bold; }
        .nav-user { background: #1a1a1a; border-radius: 50px; padding: .3rem 1rem; font-size: .9rem; border: 1px solid #444; color: #fff; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand" href="http://localhost:8080/webbanhang/Product"><i class="bi bi-shop me-2"></i>ShopAdmin</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto gap-2 align-items-center">
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/Product"><i class="bi bi-box-seam me-1"></i>Sản phẩm</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/Category/list"><i class="bi bi-tags me-1"></i>Danh mục</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/Product/cart">
                <i class="bi bi-cart me-1"></i>Giỏ hàng
                <?php if (!empty($_SESSION['cart'])): ?>
                <span class="cart-badge"><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?></span>
                <?php endif; ?>
            </a></li>
            <?php if (SessionHelper::isLoggedIn()): ?>
            <li class="nav-item">
                <span class="nav-link nav-user"><i class="bi bi-person-circle me-1"></i><?php echo $_SESSION['username']; ?>
                <?php if (SessionHelper::isAdmin()): ?><span class="badge bg-light text-dark ms-1">Admin</span><?php endif; ?>
                </span>
            </li>
            <?php if (SessionHelper::isAdmin()): ?>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/Product/add"><i class="bi bi-plus-circle me-1"></i>Thêm mới</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/account/logout"><i class="bi bi-box-arrow-right me-1"></i>Đăng xuất</a></li>
            <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/account/login"><i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/webbanhang/account/register"><i class="bi bi-person-plus me-1"></i>Đăng ký</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container mt-4">