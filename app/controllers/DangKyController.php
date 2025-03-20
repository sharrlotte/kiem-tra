<?php

require_once 'app/models/HocPhanModel.php';

class DangKyController
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

    
    public function index()
    {
        $sinhVien = $this->studentModel->getById($_SESSION['user_id']);
        $hocPhansDangKy = $_SESSION['dang_ky_hoc_phan'];
        require_once 'app/views/dangky/list.php';
    }

    
    public function register()
    {
        $hocPhans = $this->hocPhanModel->getAll();
        require_once 'app/views/dangky/register.php';
    }

    

    
    public function add()
    {
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaHP'])) {
            $maHP = $_POST['MaHP'];

            
            $hocPhan = $this->hocPhanModel->getById($maHP);

            if ($hocPhan) {
                
                if (!isset($_SESSION['dang_ky_hoc_phan'][$maHP])) {
                    $_SESSION['dang_ky_hoc_phan'][$maHP] = $hocPhan;
                    $_SESSION['success'] = "Đăng ký học phần thành công!";
                } else {
                    $_SESSION['error'] = "Học phần này đã được đăng ký!";
                }
            }
        }

        header('Location: index.php?controller=dangky&action=index');
        exit;
    }

     public function clear()
    {
        
        unset($_SESSION['dang_ky_hoc_phan']);
        $_SESSION['success'] = "Đã xóa toàn bộ học phần!";
        header("Location: index.php?controller=dangky&action=index");
        exit;
    }

    
    public function delete()
    {
        if (isset($_POST['MaHP'])) {
            $maHP = $_POST['MaHP'];

            if (isset($_SESSION['dang_ky_hoc_phan'][$maHP])) {
                unset($_SESSION['dang_ky_hoc_phan'][$maHP]);
                $_SESSION['success'] = "Xóa học phần thành công!";
            } else {
                $_SESSION['error'] = "Học phần không tồn tại trong danh sách đăng ký!";
            }
        }

        header('Location: index.php?controller=dangky&action=index');
        exit;
    }

    

    public function backup()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        if (!isset($_SESSION['dang_ky_hoc_phan']) || empty($_SESSION['dang_ky_hoc_phan'])) {
            $_SESSION['error'] = "Không có học phần nào để sao lưu!";
            header("Location: index.php?controller=dangky&action=list");
            exit;
        }

        $maSV = $_SESSION['user_id'];
        $dangKyList = $_SESSION['dang_ky_hoc_phan'];

        $this->hocPhanModel->saveToDatabase($maSV, $dangKyList);

        unset($_SESSION['dang_ky_hoc_phan']);
        $_SESSION['success'] = "Đã sao lưu thành công vào cơ sở dữ liệu!";
        header("Location: index.php?controller=dangky&action=list");
        exit;
    }
}
