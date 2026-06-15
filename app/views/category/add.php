<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card border-0 shadow" style="border-radius:20px;overflow:hidden">
        <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="http://127.0.0.1:8888/DOHOANGDANH/Category/save">
                <div class="mb-3"><label class="form-label text-muted small text-uppercase fw-bold">Tên danh mục</label>
                <input type="text" name="name" class="form-control rounded-3" placeholder="Nhập tên danh mục..." required></div>
                <div class="mb-4"><label class="form-label text-muted small text-uppercase fw-bold">Mô tả</label>
                <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Nhập mô tả..."></textarea></div>
                <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold"><i class="bi bi-plus-circle-fill me-2"></i>Thêm danh mục</button>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Category/list" class="btn btn-light w-100 rounded-3 py-2 mt-2">Quay lại</a>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>
