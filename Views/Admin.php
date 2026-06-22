<div style="margin-top: 30px; padding: 20px; border: 1px solid #ff69b4; border-radius: 5px;">
    <h2>Admin Module - Quản lý đơn hàng thời trang & Thanh toán</h2>
    <table border="1" cellpadding="10" cellspacing="0"
        style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead style="background-color: #f5f5f5;">
            <tr>
                <th>Mã Đơn</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái thanh toán</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong>#<?php echo $order['id']; ?></strong></td>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                        <td><span style="font-weight: bold;"><?php echo number_format($order['total_price'], 0, ',', '.'); ?>
                                đ</span></td>
                        <td>
                            <?php if ($order['status'] == 'Đã thanh toán'): ?>
                                <span style="color: green; background: #e6f4ea; padding: 3px 8px; border-radius: 3px;">Đã thanh
                                    toán</span>
                            <?php else: ?>
                                <span style="color: red; background: #fce8e6; padding: 3px 8px; border-radius: 3px;">Chưa thanh
                                    toán</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form action="index.php?controller=admin&action=updateOrderStatus" method="POST" style="margin: 0;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <select name="status" style="padding: 5px;">
                                    <option value="Chưa thanh toán" <?php echo $order['status'] == 'Chưa thanh toán' ? 'selected' : ''; ?>>Chưa thanh toán</option>
                                    <option value="Đã thanh toán" <?php echo $order['status'] == 'Đã thanh toán' ? 'selected' : ''; ?>>Đã thanh toán</option>
                                </select>
                                <button type="submit" style="padding: 5px 10px; cursor: pointer;">Lưu</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Chưa nhận được đơn hàng quần áo nào hệ thống.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>