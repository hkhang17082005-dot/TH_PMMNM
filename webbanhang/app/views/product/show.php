<?php
$productImages = (new ProductModel((new Database())->getConnection()))->getProductImages($product->id);
include 'app/views/shares/header.php';
?>
<div class="row justify-content-center"><div class="col-md-8">
    <div class="card bg-transparent shadow-sm" style="border-radius:20px; overflow:hidden; border: 1px solid #333;">
        <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-eye me-2"></i>Chi tiết sản phẩm</h4>
        </div>
        <div class="card-body p-4 text-white">
            <?php if (!empty($product->image)): ?>
            <img src="http://localhost:8080/webbanhang/<?php echo $product->image; ?>" class="w-100 rounded-3 mb-3 border border-secondary" style="max-height:300px;object-fit:cover;cursor:pointer" onclick="openLightbox(this.src)">
            <?php endif; ?>
            <?php if (!empty($productImages)): ?>
            <p class="text-secondary small text-uppercase fw-bold mb-2"><i class="bi bi-images me-1"></i>Ảnh phụ</p>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <?php foreach ($productImages as $img): ?>
                <img src="http://localhost:8080/webbanhang/<?php echo $img->image; ?>" style="width:100px;height:100px;object-fit:cover;border-radius:10px;cursor:pointer;border:2px solid #333;transition:.2s" onclick="openLightbox(this.src)" onmouseover="this.style.borderColor='#fff'" onmouseout="this.style.borderColor='#333'">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <table class="table table-dark table-borderless bg-transparent">
                <tr><th class="text-secondary" width="140">ID</th><td><span class="badge border border-secondary text-secondary">#<?php echo $product->id; ?></span></td></tr>
                <tr><th class="text-secondary">Tên</th><td class="fw-bold text-white"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                <tr><th class="text-secondary">Mô tả</th><td class="text-light"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                <tr><th class="text-secondary">Giá</th><td class="fw-bold fs-5 text-white"><?php echo number_format($product->price, 0, ',', '.'); ?> <small class="text-secondary fw-normal fs-6">VNĐ</small></td></tr>
                <tr><th class="text-secondary">Danh mục</th><td><span class="badge bg-dark border border-secondary text-light"><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span></td></tr>
            </table>
            <div class="d-flex gap-2 mt-3 flex-wrap">
                <a href="http://localhost:8080/webbanhang/Product" class="btn btn-outline-secondary text-white rounded-3 flex-fill">← Quay lại</a>
                <a href="http://localhost:8080/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-light rounded-3 flex-fill"><i class="bi bi-pencil me-1"></i>Sửa</a>
                <a href="http://localhost:8080/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-light text-dark rounded-3 flex-fill fw-bold"><i class="bi bi-cart-plus me-1"></i>Thêm vào giỏ</a>
            </div>
        </div>
    </div>
</div></div>
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.95);z-index:9999;align-items:center;justify-content:center" onclick="closeLightbox()">
    <img id="lightboxImg" src="" style="max-width:90%;max-height:90vh;border-radius:12px; border: 1px solid #444;">
    <button onclick="closeLightbox()" style="position:absolute;top:1rem;right:1.5rem;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer;opacity:0.7" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">✕</button>
</div>
<script>
function openLightbox(src){document.getElementById('lightboxImg').src=src;document.getElementById('lightbox').style.display='flex';}
function closeLightbox(){document.getElementById('lightbox').style.display='none';}
</script>
<?php include 'app/views/shares/footer.php'; ?>