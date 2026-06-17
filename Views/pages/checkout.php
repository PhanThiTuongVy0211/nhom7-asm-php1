<div class="container mt-5">
    <h2>Thông Tin Thanh Toán Đơn Hàng</h2>
    <form action="index.php?action=process_checkout" method="POST">
        <div class="form-group">
            <label>Họ và tên khách hàng:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email (Nhận thông báo hóa đơn):</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Địa chỉ nhận hàng váy/áo:</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger btn-block">Xác nhận đặt hàng & Thanh toán ngay</button>
    </form>
</div>