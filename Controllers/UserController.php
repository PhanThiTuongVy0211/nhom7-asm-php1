<?php

class UserController {

    // đăng nhập
    public function login() {

        require "Views/pages/login.php";
    }

    // đăng ký
    public function register() {

        require "Views/pages/register.php";
    }

    // hồ sơ
    public function profile() {

        require "Views/pages/profile.php";
    }

    // quên mật khẩu
    public function forgotPassword() {

        require "Views/pages/forgot-password.php";
    }

}