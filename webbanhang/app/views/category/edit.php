<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card bg-transparent shadow-sm" style="border-radius:20px; overflow:hidden; border: 1px solid #333;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Sửa danh mục <span class="badge border border-secondary text-light ms-1">#<?php echo $category->id; ?></span></h4>
        </div>
        <div class="card-body p-4 text-white">
            <form method="POST" action="http://localhost:8080/webbanhang/Category/update">
                <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                <div class="mb-3">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Tên danh mục</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-secondary rounded-3" value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-secondary small text-uppercase fw-bold">Mô tả</label>
                    <textarea name="description" class="form-control bg-dark text-white border-secondary rounded-3" rows="3"><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <div class="d-flex gap-2">
                    <a href="http://localhost:8080/webbanhang/Category/list" class="btn btn-outline-secondary text-white rounded-3 py-2 flex-fill">Hủy</a>
                    <button type="submit" class="btn btn-light text-dark rounded-3 py-2 flex-fill fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>