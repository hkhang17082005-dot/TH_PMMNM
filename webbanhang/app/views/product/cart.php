<?php include 'app/views/shares/header.php'; ?>
<h2 class="text-white fw-bold mb-4"><i class="bi bi-cart me-2"></i>Giỏ hàng</h2>
<?php if (!empty($cart)): ?>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card bg-transparent shadow-sm border border-secondary" style="border-radius:16px">
            <div class="card-body p-0">
                <?php $total = 0; foreach ($cart as $id => $item): $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                <div class="d-flex align-items-center gap-3 p-3 border-bottom border-secondary text-white">
                    <?php if (!empty($item['image'])): ?>
                    <img src="http://localhost:8080/webbanhang/<?php echo $item['image']; ?>" style="width:80px;height:80px;object-fit:cover;border-radius:10px; border: 1px solid #333;">
                    <?php else: ?>
                    <div style="width:80px;height:80px;background-color:#111;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;border: 1px solid #333;">🛍️</div>
                    <?php endif; ?>
                    <div class="flex-fill">
                        <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                        <p class="text-secondary small mb-1"><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ x <?php echo $item['quantity']; ?></p>
                        <p class="fw-bold mb-0 text-light"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</p>
                    </div>
                    <a href="http://localhost:8080/webbanhang/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-sm btn-outline-secondary text-white"><i class="bi bi-trash"></i></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-transparent shadow-sm border border-secondary text-white" style="border-radius:16px">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Tổng đơn hàng</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary">Tạm tính</span>
                    <span class="fw-bold text-light"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                </div>
                <hr style="border-color: #444;">
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold">Tổng cộng</span>
                    <span class="fw-bold fs-5 text-white"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                </div>
                <a href="http://localhost:8080/webbanhang/Product/checkout" class="btn btn-light w-100 rounded-3 fw-bold text-dark"><i class="bi bi-credit-card me-2"></i>Thanh toán</a>
                <a href="http://localhost:8080/webbanhang/Product" class="btn btn-outline-secondary w-100 rounded-3 mt-3 text-white">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="text-center py-5 bg-transparent border border-secondary rounded-4 shadow-sm">
    <div style="font-size:4rem; filter: grayscale(100%);">🛒</div>
    <h5 class="mt-3 text-secondary">Giỏ hàng trống!</h5>
    <a href="http://localhost:8080/webbanhang/Product" class="btn btn-light text-dark fw-bold rounded-pill mt-3 px-4 shadow-sm">Mua sắm ngay</a>
</div>
<?php endif; ?>
<?php include 'app/views/shares/footer.php'; ?>