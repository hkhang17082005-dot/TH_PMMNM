<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-5">
    <div class="card bg-transparent shadow-sm" style="border-radius:20px; overflow:hidden; border: 1px solid #333;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập</h4>
        </div>
        <div class="card-body p-4 text-white">
            <?php if (isset($error)): ?>
            <div class="alert alert-dark border-secondary text-white rounded-3"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="http://localhost:8080/webbanhang/account/checkLogin">
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Username</label>
                    <input type="text" name="username" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập username..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập mật khẩu..." required>
                </div>
                <button type="submit" class="btn btn-light text-dark w-100 rounded-3 py-2 fw-bold shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                </button>
                <div class="text-center mt-3">
                    <span class="text-secondary small">Chưa có tài khoản? </span>
                    <a href="http://localhost:8080/webbanhang/account/register" class="text-white fw-bold small text-decoration-underline">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>