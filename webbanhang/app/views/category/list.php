<?php include 'app/views/shares/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white fw-bold"><i class="bi bi-tags me-2"></i>Danh sách danh mục</h2>
    <a href="http://localhost:8080/webbanhang/Category/add" class="btn btn-light text-dark rounded-pill fw-bold shadow-sm"><i class="bi bi-plus-circle-fill me-1"></i>Thêm danh mục</a>
</div>
<div class="table-responsive">
    <table class="table table-dark table-hover align-middle shadow-sm" style="border-radius:12px;overflow:hidden; border: 1px solid #333;">
        <thead style="background-color: #000000;">
            <tr><th>ID</th><th>Tên danh mục</th><th>Mô tả</th><th>Thao tác</th></tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr style="border-color: #333;">
            <td><span class="badge border border-secondary text-secondary">#<?php echo $cat->id; ?></span></td>
            <td class="fw-bold text-white"><?php echo htmlspecialchars($cat->name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td class="text-secondary"><?php echo htmlspecialchars($cat->description, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="http://localhost:8080/webbanhang/Category/edit/<?php echo $cat->id; ?>" class="btn btn-sm btn-outline-light me-1"><i class="bi bi-pencil"></i> Sửa</a>
                <a href="http://localhost:8080/webbanhang/Category/delete/<?php echo $cat->id; ?>" onclick="return confirm('Xóa danh mục này?')" class="btn btn-sm btn-outline-secondary text-white"><i class="bi bi-trash"></i> Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'app/views/shares/footer.php'; ?>