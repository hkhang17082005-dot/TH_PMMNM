<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card bg-transparent shadow-sm" style="border-radius:20px; overflow:hidden; border: 1px solid #333;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới</h4>
        </div>
        <div class="card-body p-4 text-white">
            <form method="POST" action="http://localhost:8080/webbanhang/Category/save">
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Tên danh mục</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập tên danh mục..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Mô tả</label>
                    <textarea name="description" class="form-control bg-dark text-white border-secondary rounded-3" rows="3" placeholder="Nhập mô tả..."></textarea>
                </div>
                <button type="submit" class="btn btn-light text-dark w-100 rounded-3 py-2 fw-bold shadow-sm"><i class="bi bi-plus-circle-fill me-2"></i>Thêm danh mục</button>
                <a href="http://localhost:8080/webbanhang/Category/list" class="btn btn-outline-secondary text-white w-100 rounded-3 py-2 mt-3">Quay lại</a>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>