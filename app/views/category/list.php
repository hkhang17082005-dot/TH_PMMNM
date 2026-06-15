<?php include 'app/views/shares/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 style="color:#667eea;font-weight:700"><i class="bi bi-tags me-2"></i>Danh sách danh mục</h2>
    <a href="http://127.0.0.1:8888/DOHOANGDANH/Category/add" class="btn btn-primary rounded-pill"><i class="bi bi-plus-circle-fill me-1"></i>Thêm danh mục</a>
</div>
<div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm" style="border-radius:12px;overflow:hidden">
        <thead style="background:linear-gradient(135deg,#667eea,#764ba2);color:#fff">
            <tr><th>ID</th><th>Tên danh mục</th><th>Mô tả</th><th>Thao tác</th></tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $cat): ?>
        <tr>
            <td><span class="badge bg-primary">#<?php echo $cat->id; ?></span></td>
            <td class="fw-bold"><?php echo htmlspecialchars($cat->name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td class="text-muted"><?php echo htmlspecialchars($cat->description, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Category/edit/<?php echo $cat->id; ?>" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i> Sửa</a>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Category/delete/<?php echo $cat->id; ?>" onclick="return confirm('Xóa danh mục này?')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'app/views/shares/footer.php'; ?>
