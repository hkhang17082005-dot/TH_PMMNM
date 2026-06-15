<?php
$productImages = (new ProductModel((new Database())->getConnection()))->getProductImages($product->id);
include 'app/views/shares/header.php';
?>
<div class="row justify-content-center"><div class="col-md-8">
    <div class="card border-0 shadow" style="border-radius:20px;overflow:hidden">
        <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:1.5rem 2rem">
            <h4 class="text-white mb-0 fw-bold"><i class="bi bi-eye me-2"></i>Chi tiết sản phẩm</h4>
        </div>
        <div class="card-body p-4">
            <?php if (!empty($product->image)): ?>
            <img src="http://127.0.0.1:8888/DOHOANGDANH/<?php echo $product->image; ?>" class="w-100 rounded-3 mb-3" style="max-height:300px;object-fit:cover;cursor:pointer" onclick="openLightbox(this.src)">
            <?php endif; ?>
            <?php if (!empty($productImages)): ?>
            <p class="text-muted small text-uppercase fw-bold mb-2"><i class="bi bi-images me-1"></i>Ảnh phụ</p>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <?php foreach ($productImages as $img): ?>
                <img src="http://127.0.0.1:8888/DOHOANGDANH/<?php echo $img->image; ?>" style="width:100px;height:100px;object-fit:cover;border-radius:10px;cursor:pointer;border:2px solid #e2e8f0;transition:.2s" onclick="openLightbox(this.src)" onmouseover="this.style.borderColor='#667eea'" onmouseout="this.style.borderColor='#e2e8f0'">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <table class="table table-borderless">
                <tr><th class="text-muted" width="140">ID</th><td><span class="badge bg-primary">#<?php echo $product->id; ?></span></td></tr>
                <tr><th class="text-muted">Tên</th><td class="fw-bold"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                <tr><th class="text-muted">Mô tả</th><td><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                <tr><th class="text-muted">Giá</th><td class="fw-bold" style="color:#667eea"><?php echo number_format($product->price, 0, ',', '.'); ?> VNĐ</td></tr>
                <tr><th class="text-muted">Danh mục</th><td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span></td></tr>
            </table>
            <div class="d-flex gap-2 mt-3">
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Product" class="btn btn-light rounded-3 flex-fill">← Quay lại</a>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary rounded-3 flex-fill"><i class="bi bi-cart-plus me-1"></i>Thêm vào giỏ</a>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning rounded-3 flex-fill"><i class="bi bi-pencil me-1"></i>Sửa</a>
            </div>
        </div>
    </div>
</div></div>
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:9999;align-items:center;justify-content:center" onclick="closeLightbox()">
    <img id="lightboxImg" src="" style="max-width:90%;max-height:90vh;border-radius:12px">
    <button onclick="closeLightbox()" style="position:absolute;top:1rem;right:1.5rem;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer">✕</button>
</div>
<script>
function openLightbox(src){document.getElementById('lightboxImg').src=src;document.getElementById('lightbox').style.display='flex';}
function closeLightbox(){document.getElementById('lightbox').style.display='none';}
</script>
<?php include 'app/views/shares/footer.php'; ?>
