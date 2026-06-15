<?php include 'app/views/shares/header.php'; ?>

<?php
// Tính tổng tiền
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

// ===== THAY THÔNG TIN CỦA BẠN Ở ĐÂY =====
$bank_id      = "VCB";           // MB, VCB, TCB, ACB, VPB...
$account_no   = "1025356645";   // Số tài khoản của bạn
$account_name = "DO HOANG DANH"; // Tên tài khoản
// ==========================================

$order_code  = 'DH' . strtoupper(uniqid());
$description = "Thanh toan " . $order_code;
$qr_url      = "https://img.vietqr.io/image/{$bank_id}-{$account_no}-compact2.png"
             . "?amount={$total}"
             . "&addInfo=" . urlencode($description)
             . "&accountName=" . urlencode($account_name);
?>

<div class="row justify-content-center"><div class="col-md-10">
<div class="row g-3">

    <!-- FORM THANH TOÁN -->
    <div class="col-md-7">
        <div class="card border-0 shadow" style="border-radius:20px;overflow:hidden">
            <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:1.5rem 2rem">
                <h4 class="text-white mb-0 fw-bold">
                    <i class="bi bi-credit-card me-2"></i>Thông tin đặt hàng
                </h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="http://127.0.0.1:8888/DOHOANGDANH/Product/processCheckout" id="checkoutForm">
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Họ tên</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Nhập họ tên..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control rounded-3" placeholder="Nhập số điện thoại..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase fw-bold">Địa chỉ</label>
                        <textarea name="address" class="form-control rounded-3" rows="3" placeholder="Nhập địa chỉ giao hàng..." required></textarea>
                    </div>
                    <input type="hidden" name="payment_method" id="paymentMethod" value="cod">
                    <input type="hidden" name="order_code" value="<?php echo $order_code; ?>">

                    <div class="mb-4">
                        <label class="form-label text-muted small text-uppercase fw-bold">Phương thức thanh toán</label>
                        <div class="d-flex gap-2">
                            <div id="btnCod" class="form-check border rounded-3 p-3 flex-fill active-payment" 
                                 style="cursor:pointer;border-color:#667eea!important" 
                                 onclick="selectPayment('cod',this)">
                                <input class="form-check-input" type="radio" name="payment" value="cod" id="cod" checked>
                                <label class="form-check-label fw-bold" for="cod">
                                    <i class="bi bi-cash me-1"></i>Tiền mặt (COD)
                                </label>
                            </div>
                            <div id="btnQr" class="form-check border rounded-3 p-3 flex-fill" 
                                 style="cursor:pointer" 
                                 onclick="selectPayment('qr',this)">
                                <input class="form-check-input" type="radio" name="payment" value="qr" id="qr">
                                <label class="form-check-label fw-bold" for="qr">
                                    <i class="bi bi-qr-code me-1"></i>Chuyển khoản QR
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
                        <i class="bi bi-check-circle-fill me-2"></i>Xác nhận đặt hàng
                    </button>
                    <a href="http://127.0.0.1:8888/DOHOANGDANH/Product/cart" 
                       class="btn btn-light w-100 rounded-3 py-2 mt-2">← Quay lại giỏ hàng</a>
                </form>
            </div>
        </div>
    </div>

    <!-- QR THANH TOÁN -->
    <div class="col-md-5">
        <div class="card border-0 shadow" style="border-radius:20px;overflow:hidden">
            <div style="background:linear-gradient(135deg,#ae2d68,#d82d8b);padding:1.5rem 2rem">
                <h5 class="text-white mb-0 fw-bold">
                    <i class="bi bi-qr-code me-2"></i>Thanh toán QR
                </h5>
            </div>
            <div class="card-body p-4 text-center">

                <!-- COD Section -->
                <div id="codSection">
                    <div style="font-size:4rem">💵</div>
                    <p class="text-muted mt-2">Thanh toán khi nhận hàng</p>
                    <p class="fw-bold fs-5" style="color:#667eea">
                        <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
                    </p>
                </div>

                <!-- QR Section -->
                <div id="qrSection" style="display:none">
                    <img id="qrImage" src="<?php echo $qr_url; ?>" 
                         class="img-fluid rounded-3 mb-3" style="max-width:220px">
                    <div class="bg-light rounded-3 p-3 text-start mb-3">
                        <p class="mb-1 small"><strong>Ngân hàng:</strong> <?php echo $bank_id; ?>Bank</p>
                        <p class="mb-1 small"><strong>Số TK:</strong> <?php echo $account_no; ?></p>
                        <p class="mb-1 small"><strong>Tên TK:</strong> <?php echo $account_name; ?></p>
                        <p class="mb-1 small"><strong>Số tiền:</strong> 
                            <span class="text-danger fw-bold">
                                <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
                            </span>
                        </p>
                        <p class="mb-0 small"><strong>Nội dung:</strong> <?php echo $description; ?></p>
                    </div>
                    <div class="alert alert-warning small py-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Quét mã QR rồi nhấn <strong>Xác nhận đặt hàng</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div></div>

<script>
function selectPayment(type, el) {
    // Reset border
    document.querySelectorAll('.form-check').forEach(e => e.style.borderColor = '');
    el.style.borderColor = '#667eea';

    // Cập nhật hidden input
    document.getElementById('paymentMethod').value = type;

    if (type === 'qr') {
        document.getElementById('qrSection').style.display = 'block';
        document.getElementById('codSection').style.display = 'none';
    } else {
        document.getElementById('qrSection').style.display = 'none';
        document.getElementById('codSection').style.display = 'block';
    }
}
</script>

<?php include 'app/views/shares/footer.php'; ?>
