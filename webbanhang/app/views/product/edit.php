<?php include 'app/views/shares/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-7">
    <div class="card bg-transparent shadow-sm border border-secondary" style="border-radius:20px; overflow:hidden;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Sửa sản phẩm <span class="badge border border-secondary text-light ms-1">#<?php echo $product->id; ?></span></h4>
        </div>
        <div class="card-body p-4 text-white">
            <form method="POST" action="http://localhost:8080/webbanhang/Product/update" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                <div class="mb-3"><label class="form-label text-secondary small text-uppercase fw-bold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control bg-dark text-white border-secondary rounded-3" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required></div>
                <div class="mb-3"><label class="form-label text-secondary small text-uppercase fw-bold">Mô tả</label>
                <textarea name="description" class="form-control bg-dark text-white border-secondary rounded-3" rows="3" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea></div>
                <div class="mb-3"><label class="form-label text-secondary small text-uppercase fw-bold">Giá (VNĐ)</label>
                <input type="number" name="price" class="form-control bg-dark text-white border-secondary rounded-3" value="<?php echo $product->price; ?>" step="1" min="1" required></div>
                <div class="mb-3"><label class="form-label text-secondary small text-uppercase fw-bold">Danh mục</label>
                <select name="category_id" class="form-select bg-dark text-white border-secondary rounded-3" required>
                <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat->id; ?>" <?php echo $cat->id==$product->category_id?'selected':''; ?>><?php echo htmlspecialchars($cat->name, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php endforeach; ?></select></div>
                <div class="mb-3"><label class="form-label text-secondary small text-uppercase fw-bold">Ảnh chính</label>
                <?php if (!empty($product->image)): ?><img src="http://localhost:8080/webbanhang/<?php echo $product->image; ?>" class="d-block mb-3 rounded-3 border border-secondary" style="max-width:120px"><?php endif; ?>
                <input type="file" name="image" class="form-control bg-dark text-white border-secondary rounded-3" accept="image/*"></div>
                <div class="mb-4"><label class="form-label text-secondary small text-uppercase fw-bold">Ảnh phụ mới</label>
                <input type="file" name="images[]" class="form-control bg-dark text-white border-secondary rounded-3" accept="image/*" multiple>
                <div class="text-secondary small mt-1">Giữ Ctrl để chọn nhiều ảnh</div></div>
                <div class="d-flex gap-2">
                    <a href="http://localhost:8080/webbanhang/Product" class="btn btn-outline-secondary text-white rounded-3 py-2 flex-fill">Hủy</a>
                    <button type="submit" class="btn btn-light text-dark rounded-3 py-2 flex-fill fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div></div>
<?php include 'app/views/shares/footer.php'; ?>