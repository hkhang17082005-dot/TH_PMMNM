<?php include 'app/views/shares/header.php'; ?>

<?php
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

$bank_id      = "VCB";           
$account_no   = "1025356645";   
$account_name = "DO HOANG DANH"; 

$order_code  = 'DH' . strtoupper(uniqid());
$description = "Thanh toan " . $order_code;
$qr_url      = "https://img.vietqr.io/image/{$bank_id}-{$account_no}-compact2.png"
             . "?amount={$total}"
             . "&addInfo=" . urlencode($description)
             . "&accountName=" . urlencode($account_name);
?>

<div class="row justify-content-center"><div class="col-md-10">
<div class="row g-4">

    <div class="col-md-7">
        <div class="card bg-transparent shadow-sm border border-secondary" style="border-radius:20px; overflow:hidden;">
            <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
                <h4 class="text-white mb-0 fw-bold">
                    <i class="bi bi-credit-card me-2"></i>Thông tin đặt hàng
                </h4>
            </div>
            <div class="card-body p-4 text-white">
                <form method="POST" action="http://localhost:8080/webbanhang/Product/processCheckout" id="checkoutForm">
                    <div class="mb-3">
                        <label class="form-label text-secondary small text-uppercase fw-bold">Họ tên</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập họ tên..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small text-uppercase fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control bg-dark text-white border-secondary rounded-3" placeholder="Nhập số điện thoại..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small text-uppercase fw-bold">Địa chỉ</label>
                        <textarea name="address" class="form-control bg-dark text-white border-secondary rounded-3" rows="3" placeholder="Nhập địa chỉ giao hàng..." required></textarea>
                    </div>
                    <input type="hidden" name="payment_method" id="paymentMethod" value="cod">
                    <input type="hidden" name="order_code" value="<?php echo $order_code; ?>">

                    <div class="mb-4">
                        <label class="form-label text-secondary small text-uppercase fw-bold">Phương thức thanh toán</label>
                        <div class="d-flex gap-2">
                            <div id="btnCod" class="form-check border rounded-3 p-3 flex-fill active-payment bg-dark" 
                                 style="cursor:pointer; border-color:#fff!important" 
                                 onclick="selectPayment('cod',this)">
                                <input class="form-check-input bg-secondary border-secondary" type="radio" name="payment" value="cod" id="cod" checked>
                                <label class="form-check-label fw-bold text-white" for="cod">
                                    <i class="bi bi-cash me-1"></i>Tiền mặt (COD)
                                </label>
                            </div>
                            <div id="btnQr" class="form-check border border-secondary rounded-3 p-3 flex-fill bg-dark" 
                                 style="cursor:pointer" 
                                 onclick="selectPayment('qr',this)">
                                <input class="form-check-input bg-secondary border-secondary" type="radio" name="payment" value="qr" id="qr">
                                <label class="form-check-label fw-bold text-white" for="qr">
                                    <i class="bi bi-qr-code me-1"></i>Chuyển khoản QR
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-light text-dark w-100 rounded-3 py-2 fw-bold shadow-sm">
                        <i class="bi bi-check-circle-fill me-2"></i>Xác nhận đặt hàng
                    </button>
                    <a href="http://localhost:8080/webbanhang/Product/cart" 
                       class="btn btn-outline-secondary text-white w-100 rounded-3 py-2 mt-3">← Quay lại giỏ hàng</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card bg-transparent shadow-sm border border-secondary" style="border-radius:20px; overflow:hidden;">
            <div style="background-color: #0a0a0a; border-bottom: 1px solid #333; padding:1.5rem 2rem">
                <h5 class="text-white mb-0 fw-bold">
                    <i class="bi bi-qr-code me-2"></i>Thanh toán QR
                </h5>
            </div>
            <div class="card-body p-4 text-center text-white">

                <div id="codSection">
                    <div style="font-size:4rem; filter: grayscale(100%);">💵</div>
                    <p class="text-secondary mt-2">Thanh toán khi nhận hàng</p>
                    <p class="fw-bold fs-5 text-light">
                        <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
                    </p>
                </div>

                <div id="qrSection" style="display:none">
                    <div class="bg-white p-2 rounded-3 d-inline-block mb-3">
                        <img id="qrImage" src="<?php echo $qr_url; ?>" class="img-fluid rounded-2" style="max-width:200px">
                    </div>
                    <div class="bg-dark border border-secondary rounded-3 p-3 text-start mb-3 text-light">
                        <p class="mb-1 small"><strong>Ngân hàng:</strong> <?php echo $bank_id; ?>Bank</p>
                        <p class="mb-1 small"><strong>Số TK:</strong> <?php echo $account_no; ?></p>
                        <p class="mb-1 small"><strong>Tên TK:</strong> <?php echo $account_name; ?></p>
                        <p class="mb-1 small"><strong>Số tiền:</strong> 
                            <span class="text-white fw-bold border-bottom border-light pb-1">
                                <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
                            </span>
                        </p>
                        <p class="mb-0 small mt-2"><strong>Nội dung:</strong> <span class="text-secondary"><?php echo $description; ?></span></p>
                    </div>
                    <div class="alert alert-dark border-secondary text-light small py-2">
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
    document.querySelectorAll('.form-check').forEach(e => {
        e.style.borderColor = '#495057'; // border-secondary
    });
    el.style.borderColor = '#fff';

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