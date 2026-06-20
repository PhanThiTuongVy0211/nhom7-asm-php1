<h1>Quản lý User</h1>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
    </tr>

    <?php foreach($users as $user) : ?>

    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
    </tr>

    <?php endforeach; ?>

</table>