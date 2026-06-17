<div class="container mt-5">
    <h2>Giỏ Hàng Thời Trang Của Bạn</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($cartItems)): ?>
                <tr>
                    <td colspan="5" class="text-center">Giỏ hàng đang trống rỗng! Hãy đi mua váy áo nào!</td>
                </tr>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><img src="assets/images/<?= $item['image'] ?>" width="80"></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price']) ?> đ</td>
                        <td>
                            <form action="index.php?action=update_cart" method="POST">
                                <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0"
                                    style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-primary">Sửa</button>
                            </form>
                        </td>
                        <td><?= number_format($item['price'] * $item['quantity']) ?> đ</td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php?action=checkout" class="btn btn-success float-right">Tiến hành thanh toán</a>
</div>