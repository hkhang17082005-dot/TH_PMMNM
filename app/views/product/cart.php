<?php include 'app/views/shares/header.php'; ?>
<h2 style="color:#667eea;font-weight:700" class="mb-3"><i class="bi bi-cart me-2"></i>Giỏ hàng</h2>
<?php if (!empty($cart)): ?>
<div class="row g-3">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
            <div class="card-body p-0">
                <?php $total = 0; foreach ($cart as $id => $item): $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                    <?php if (!empty($item['image'])): ?>
                    <img src="http://127.0.0.1:8888/DOHOANGDANH/<?php echo $item['image']; ?>" style="width:80px;height:80px;object-fit:cover;border-radius:10px">
                    <?php else: ?>
                    <div style="width:80px;height:80px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">🛍️</div>
                    <?php endif; ?>
                    <div class="flex-fill">
                        <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h6>
                        <p class="text-muted small mb-1"><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ x <?php echo $item['quantity']; ?></p>
                        <p class="fw-bold mb-0" style="color:#667eea"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</p>
                    </div>
                    <a href="http://127.0.0.1:8888/DOHOANGDANH/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Tổng đơn hàng</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tạm tính</span>
                    <span class="fw-bold" style="color:#667eea"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Tổng cộng</span>
                    <span class="fw-bold fs-5" style="color:#667eea"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                </div>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Product/checkout" class="btn btn-primary w-100 rounded-3 fw-bold"><i class="bi bi-credit-card me-2"></i>Thanh toán</a>
                <a href="http://127.0.0.1:8888/DOHOANGDANH/Product" class="btn btn-light w-100 rounded-3 mt-2">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="text-center py-5 bg-white rounded-4 shadow-sm">
    <div style="font-size:4rem">🛒</div>
    <h5 class="mt-3 text-muted">Giỏ hàng trống!</h5>
    <a href="http://127.0.0.1:8888/DOHOANGDANH/Product" class="btn btn-primary rounded-pill mt-2">Mua sắm ngay</a>
</div>
<?php endif; ?>
<?php include 'app/views/shares/footer.php'; ?>
