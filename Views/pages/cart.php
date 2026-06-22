<table class="table">
    <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($cartProducts)): ?>
            <?php foreach ($cartProducts as $item): ?>
                <tr>
                    <td><img src="assets/images/<?php echo $item['image']; ?>" width="80"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</td>
                    <td>
                        <form action="index.php?pages=cap-nhat-gio-hang" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"
                                style="width:60px;">
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                        </form>
                    </td>
                    <td>
                        <?php
                        $subtotal = $item['price'] * $item['quantity'];
                        echo number_format($subtotal, 0, ',', '.');
                        ?>đ
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Giỏ hàng trống!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if (!empty($cartProducts)): ?>
    <div style="text-align: right; margin-top: 20px;">
        <a href="index.php?pages=thanh-toan" class="btn btn-success">Tiến hành thanh toán</a>
    </div>
<?php endif; ?>