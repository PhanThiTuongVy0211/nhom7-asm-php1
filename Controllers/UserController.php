<?php

class UserController
{
    private $db;

    public function __construct($databaseConnection)
    {
        $this->db = $databaseConnection;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['email' => $email, 'password' => $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                header("Location: index.php?action=cart"); 
                exit();
            } else {
                echo "Sai email hoặc mật khẩu bán hàng!";
            }
        }
    }
}