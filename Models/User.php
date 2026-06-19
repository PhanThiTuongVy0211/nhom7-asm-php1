<?php
require_once 'Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Đăng ký tài khoản mới cho khách hàng
    public function register($username, $email, $password, $fullname, $phone, $address)
    {
        // Mã hóa mật khẩu bảo mật
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, email, password, fullname, phone, address, role) 
                VALUES (:username, :email, :password, :fullname, :phone, :address, 'customer')";

        return $this->db->query($sql, [
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'fullname' => $fullname,
            'phone' => $phone,
            'address' => $address
        ]);
    }

    // Đăng nhập hệ thống
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $result = $this->db->query($sql, ['email' => $email]);

        if ($result) {
            $user = $result[0];
            // Kiểm tra mật khẩu khớp với mã hóa hay không
            if (password_verify($password, $user['password'])) {
                return $user; // Trả về thông tin user nếu đúng
            }
        }
        return false; // Sai tài khoản hoặc mật khẩu
    }

    // Lấy thông tin user bằng ID 
    public function getUserById($id)
    {
        $sql = "SELECT id, username, email, fullname, phone, address, role FROM users WHERE id = :id LIMIT 1";
        $result = $this->db->query($sql, ['id' => $id]);
        return $result ? $result[0] : null;
    }
}