<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card bg-transparent shadow-sm" style="border-radius:20px; overflow:hidden; border: 1px solid #333;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Đăng ký tài khoản</h4>
        </div>
        <div class="card-body p-4 text-white">
            <?php if (isset($errors) && count($errors) > 0): ?>
            <div class="alert alert-dark border-secondary text-white rounded-3">
                <ul class="mb-0"><?php foreach ($errors as $err): ?><li><?php echo $err; ?></li><?php endforeach; ?></ul>
            </div>
            <?php endif; ?>
            <form method="POST" action="http://localhost:8080/webbanhang/account/save">
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Username</label>
                    <input type="text" name="username" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập username..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Họ tên</label>
                    <input type="text" name="fullname" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập họ tên..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập mật khẩu..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Xác nhận mật khẩu</label>
                    <input type="password" name="confirmpassword" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập lại mật khẩu..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Vai trò</label>
                    <select name="role" class="form-select bg-dark text-white border-secondary rounded-3">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-light text-dark w-100 rounded-3 py-2 fw-bold shadow-sm">
                    <i class="bi bi-person-check-fill me-2"></i>Đăng ký
                </button>
                <div class="text-center mt-3">
                    <span class="text-secondary small">Đã có tài khoản? </span>
                    <a href="http://localhost:8080/webbanhang/account/login" class="text-white fw-bold small text-decoration-underline">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>