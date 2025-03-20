<?php
class AuthController
{

    private $hocPhanModel;
    private $studentModel;

    public function __construct()
    {
        $this->hocPhanModel = new HocPhanModel();
        $this->studentModel = new StudentModel();

        if (!isset($_SESSION['dang_ky_hoc_phan'])) {
            $_SESSION['dang_ky_hoc_phan'] = [];
        }
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaSV'])) {

            $student = $this->studentModel->getById($_POST['MaSV']);

            if (!$student) {
                $_SESSION['error'] = "MSSV không hợp lệ";
            } else {

                $_SESSION['user_id'] = $_POST['MaSV'];
                $_SESSION['success'] = "Đăng nhập thành công!";
                header('Location: index.php');
                exit;
            }
        }


        require_once 'app/views/auth/login.php';
    }

    public function logout(): void
    {
        
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
