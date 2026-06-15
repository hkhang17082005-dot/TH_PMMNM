<?php include 'app/views/shares/header.php'; ?>
 
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
 
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
 
  body {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #f0f2f5;
    color: #1a1a2e;
  }
 
  .page-wrapper {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
  }
 
  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
  }
 
  .page-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1a1a2e;
  }
 
  .page-header h1 span {
    color: #4f46e5;
  }
 
  /* FORM CARD */
  .form-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px 32px;
    margin-bottom: 30px;
    box-shadow: 0 2px 16px rgba(79,70,229,0.08);
    border: 1px solid #e8e8f0;
  }
 
  .form-card h2 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #4f46e5;
    display: flex;
    align-items: center;
    gap: 8px;
  }
 
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
 
  .form-grid .full {
    grid-column: 1 / -1;
  }
 
  .form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
 
  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e0e0ef;
    border-radius: 10px;
    font-family: inherit;
    font-size: 0.95rem;
    color: #1a1a2e;
    background: #fafaff;
    transition: border-color 0.2s;
    outline: none;
  }
 
  .form-group input:focus,
  .form-group textarea:focus {
    border-color: #4f46e5;
    background: #fff;
  }
 
  .form-group textarea { resize: vertical; min-height: 80px; }
 
  #product-id { display: none; }
 
  .btn-row {
    display: flex;
    gap: 10px;
    margin-top: 20px;
  }
 
  .btn {
    padding: 10px 24px;
    border: none;
    border-radius: 10px;
    font-family: inherit;
    font-size: 0.92rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s;
  }
 
  .btn-primary {
    background: #4f46e5;
    color: #fff;
  }
  .btn-primary:hover { background: #3730a3; transform: translateY(-1px); }
 
  .btn-secondary {
    background: #f0f2f5;
    color: #555;
  }
  .btn-secondary:hover { background: #e0e0ef; }
 
  /* PRODUCT LIST */
  .list-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }
 
  .list-header h2 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1a1a2e;
  }
 
  .badge {
    background: #ede9fe;
    color: #4f46e5;
    border-radius: 20px;
    padding: 3px 12px;
    font-size: 0.82rem;
    font-weight: 600;
  }
 
  .product-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(79,70,229,0.07);
  }
 
  .product-table thead {
    background: #4f46e5;
    color: #fff;
  }
 
  .product-table thead th {
    padding: 14px 16px;
    text-align: left;
    font-size: 0.82rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }
 
  .product-table tbody tr {
    border-bottom: 1px solid #f0f0f8;
    transition: background 0.15s;
  }
 
  .product-table tbody tr:last-child { border-bottom: none; }
  .product-table tbody tr:hover { background: #fafaff; }
 
  .product-table td {
    padding: 14px 16px;
    font-size: 0.92rem;
    vertical-align: middle;
  }
 
  .product-name { font-weight: 600; color: #1a1a2e; }
  .product-desc { color: #888; font-size: 0.85rem; max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .product-price { font-weight: 700; color: #4f46e5; }
  .product-cat { background: #ede9fe; color: #4f46e5; padding: 3px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
 
  .action-btn {
    padding: 6px 14px;
    border: none;
    border-radius: 8px;
    font-family: inherit;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s;
    margin-right: 5px;
  }
 
  .btn-edit { background: #fef3c7; color: #d97706; }
  .btn-edit:hover { background: #fde68a; }
 
  .btn-delete { background: #fee2e2; color: #dc2626; }
  .btn-delete:hover { background: #fecaca; }
 
  /* TOAST */
  #toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    padding: 14px 24px;
    border-radius: 12px;
    font-size: 0.92rem;
    font-weight: 600;
    color: #fff;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s;
    z-index: 9999;
    pointer-events: none;
  }
 
  #toast.show { opacity: 1; transform: translateY(0); }
  #toast.success { background: #10b981; }
  #toast.error { background: #ef4444; }
 
  .loading { text-align: center; padding: 40px; color: #888; font-size: 0.95rem; }
</style>
 
<div class="page-wrapper">
 
  <div class="page-header">
    <h1>Quản lý <span>Sản phẩm</span></h1>
  </div>
 
  <!-- FORM -->
  <div class="form-card">
    <h2 id="form-title">➕ Thêm sản phẩm mới</h2>
    <input type="hidden" id="product-id">
    <div class="form-grid">
      <div class="form-group">
        <label>Tên sản phẩm</label>
        <input type="text" id="product-name" placeholder="VD: Laptop Dell XPS">
      </div>
      <div class="form-group">
        <label>Giá (VNĐ)</label>
        <input type="number" id="product-price" placeholder="VD: 25000000" step="0.01">
      </div>
      <div class="form-group full">
        <label>Mô tả</label>
        <textarea id="product-desc" placeholder="Mô tả sản phẩm..."></textarea>
      </div>
      <div class="form-group">
        <label>Category ID</label>
        <input type="number" id="product-category" placeholder="VD: 1">
      </div>
    </div>
    <div class="btn-row">
      <button class="btn btn-primary" id="btn-save">💾 Lưu sản phẩm</button>
      <button class="btn btn-secondary" id="btn-cancel" style="display:none">✕ Hủy</button>
    </div>
  </div>
 
  <!-- LIST -->
  <div>
    <div class="list-header">
      <h2>Danh sách sản phẩm</h2>
      <span class="badge" id="product-count">0 sản phẩm</span>
    </div>
    <table class="product-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên sản phẩm</th>
          <th>Mô tả</th>
          <th>Giá</th>
          <th>Danh mục</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody id="product-list">
        <tr><td colspan="6" class="loading">Đang tải...</td></tr>
      </tbody>
    </table>
  </div>
 
</div>
 
<div id="toast"></div>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
const API_URL = '/DOHOANGDANH/api/Product';
const token = localStorage.getItem('jwtToken') || '';
function showToast(msg, type = 'success') {
  const $t = $('#toast');
  $t.text(msg).removeClass('success error').addClass(type + ' show');
  setTimeout(() => $t.removeClass('show'), 2800);
}
 
function loadProducts() {
 $.ajax({
    url: API_URL,
    method: 'GET',
    headers: { 'Authorization': 'Bearer ' + token },
    success: function(data) {
        $('#product-count').text(data.length + ' sản phẩm');
        const rows = data.map(p => `
            <tr>
                <td>#${p.id}</td>
                <td class="product-name">${p.name}</td>
                <td class="product-desc">${p.description}</td>
                <td class="product-price">${Number(p.price).toLocaleString('vi-VN')}đ</td>
                <td><span class="product-cat">${p.category_name || p.category_id}</span></td>
                <td>
                    <button class="action-btn btn-edit" onclick="editProduct(${p.id})">✏️ Sửa</button>
                    <button class="action-btn btn-delete" onclick="deleteProduct(${p.id})">🗑️ Xóa</button>
                </td>
            </tr>
        `).join('');
        $('#product-list').html(rows || '<tr><td colspan="6" class="loading">Không có sản phẩm</td></tr>');
    }
});
}
 
// SAVE (POST hoặc PUT)
$('#btn-save').click(function() {
  const id = $('#product-id').val();
  const payload = {
    name: $('#product-name').val(),
    description: $('#product-desc').val(),
    price: $('#product-price').val(),
    category_id: $('#product-category').val()
  };
 
  if (!payload.name || !payload.price) {
    showToast('Vui lòng nhập đầy đủ thông tin!', 'error');
    return;
  }
 
  if (id) {
    // PUT
    $.ajax({
      url: API_URL + '/' + id,
      method: 'PUT',
      contentType: 'application/json',
      headers: { 'Authorization': 'Bearer ' + token },
      data: JSON.stringify(payload),
      success: function() {
        showToast('Cập nhật thành công!');
        resetForm();
        loadProducts();
      },
      error: function() { showToast('Cập nhật thất bại!', 'error'); }
    });
  } else {
    // POST
    $.ajax({
      url: API_URL,
      method: 'POST',
      headers: { 'Authorization': 'Bearer ' + token },
      contentType: 'application/json',
      data: JSON.stringify(payload),
      success: function() {
        showToast('Thêm sản phẩm thành công!');
        resetForm();
        loadProducts();
      },
      error: function() { showToast('Thêm thất bại!', 'error'); }
    });
  }
});
 
// EDIT
function editProduct(id) {
    $.ajax({
        url: API_URL + '/' + id,
        method: 'GET',
        headers: { 'Authorization': 'Bearer ' + token },
        success: function(p) {
            $('#product-id').val(p.id);
            $('#product-name').val(p.name);
            $('#product-desc').val(p.description);
            $('#product-price').val(p.price);
            $('#product-category').val(p.category_id);
            $('#form-title').text('✏️ Chỉnh sửa sản phẩm #' + id);
            $('#btn-save').text('💾 Cập nhật');
            $('#btn-cancel').show();
            $('html, body').animate({ scrollTop: 0 }, 300);
        }
    });
}

 
// DELETE
function deleteProduct(id) {
  if (!confirm('Xóa sản phẩm #' + id + '?')) return;
  $.ajax({
    url: API_URL + '/' + id,
    method: 'DELETE',
    success: function() {
      showToast('Đã xóa sản phẩm!');
      loadProducts();
    },
    error: function() { showToast('Xóa thất bại!', 'error'); }
  });
}
 
// CANCEL
$('#btn-cancel').click(resetForm);
 
function resetForm() {
  $('#product-id, #product-name, #product-desc, #product-price, #product-category').val('');
  $('#form-title').text('➕ Thêm sản phẩm mới');
  $('#btn-save').text('💾 Lưu sản phẩm');
  $('#btn-cancel').hide();
}
 
loadProducts();
</script>
 
<?php include 'app/views/shares/footer.php'; ?>