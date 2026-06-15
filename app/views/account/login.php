<?php include 'app/views/shares/header.php'; ?>

<div class="row justify-content-center"><div class="col-md-5">
    <div class="card border-0 shadow" style="border-radius:20px;overflow:hidden">
        <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập</h4>
        </div>
        <div class="card-body p-4">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger rounded-3"><?php echo $error; ?></div>
            <?php endif; ?>
            <form id="login-form">
                <div class="mb-3">
                    <label class="form-label text-muted small text-uppercase fw-bold">Username</label>
                    <input type="text" name="username" class="form-control rounded-3" placeholder="Nhập username...">
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small text-uppercase fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control rounded-3" placeholder="Nhập mật khẩu...">
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                </button>
                <div class="text-center mt-3">
                    <span class="text-muted small">Chưa có tài khoản? </span>
                    <a href="http://127.0.0.1:8888/DOHOANGDANH/account/register" class="text-primary fw-bold small">Đăng ký</a>
                </div>
                <div class="text-center mt-3">
                    <a href="http://127.0.0.1:8888/DOHOANGDANH/oauth/github" class="btn btn-dark me-2">
                        <i class="bi bi-github me-1"></i>Đăng nhập GitHub
                    </a>
                    <a href="http://127.0.0.1:8888/DOHOANGDANH/oauth/facebook" class="btn btn-primary">
                        <i class="bi bi-facebook me-1"></i>Đăng nhập Facebook
                    </a>
                </div>
            </form>
        </div>
    </div>
</div></div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });
    fetch('/DOHOANGDANH/account/apiLogin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            localStorage.setItem('jwtToken', data.token);
            location.href = '/DOHOANGDANH/Product';
        } else {
            alert('Đăng nhập thất bại');
        }
    });
});
</script>   