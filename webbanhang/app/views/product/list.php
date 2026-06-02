<?php
require_once 'app/helpers/SessionHelper.php';
include 'app/views/shares/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-white"><i class="bi bi-box-seam me-2"></i>Danh sách sản phẩm</h2>
    <?php if (SessionHelper::isAdmin()): ?>
    <a href="http://localhost:8080/webbanhang/Product/add" class="btn btn-light text-dark rounded-pill fw-bold shadow-sm"><i class="bi bi-plus-circle-fill me-1"></i>Thêm mới</a>
    <?php endif; ?>
</div>
<div class="row g-4">
<?php foreach ($products as $product): ?>
<div class="col-md-6 col-lg-4">
    <div class="card h-100 bg-transparent" style="border: 1px solid #333; border-radius: 12px; overflow: hidden; transition: 0.3s;" onmouseover="this.style.borderColor='#777'; this.style.transform='translateY(-5px)'" onmouseout="this.style.borderColor='#333'; this.style.transform='translateY(0)'">
        <?php if (!empty($product->image)): ?>
        <img src="http://localhost:8080/webbanhang/<?php echo $product->image; ?>" class="card-img-top" style="height:180px;object-fit:cover; border-bottom: 1px solid #222;">
        <?php else: ?>
        <div style="height:180px;background-color:#111;display:flex;align-items:center;justify-content:center;font-size:3rem; border-bottom: 1px solid #222; color:#555;">🛍️</div>
        <?php endif; ?>
        <div class="card-body d-flex flex-column">
            <div class="mb-2">
                <span class="badge border border-secondary text-secondary">#<?php echo $product->id; ?></span>
            </div>
            <h5 class="fw-bold text-white"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="text-secondary small mb-3"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="fw-bold fs-5 text-white mt-auto"><?php echo number_format($product->price, 0, ',', '.'); ?> <small class="text-secondary fw-normal fs-6">VNĐ</small></p>
            <div class="mb-3">
                <span class="badge bg-dark border border-secondary text-light"><i class="bi bi-tag me-1"></i><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="http://localhost:8080/webbanhang/Product/show/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-light"><i class="bi bi-eye"></i></a>
                <?php if (SessionHelper::isAdmin()): ?>
                <a href="http://localhost:8080/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-secondary text-white"><i class="bi bi-pencil"></i></a>
                <a href="http://localhost:8080/webbanhang/Product/delete/<?php echo $product->id; ?>" onclick="return confirm('Xóa sản phẩm này?')" class="btn btn-sm btn-outline-secondary text-white"><i class="bi bi-trash"></i></a>
                <?php endif; ?>
                <a href="http://localhost:8080/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-sm btn-light text-dark fw-bold flex-fill"><i class="bi bi-cart-plus me-1"></i>Thêm vào giỏ</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php include 'app/views/shares/footer.php'; ?>