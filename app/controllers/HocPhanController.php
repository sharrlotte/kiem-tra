<?php
class HocPhanController
{
    private $hocPhanModel;

    public function __construct()
    {
        $this->hocPhanModel = new HocPhanModel();
    }

    public function index()
    {
        $hocPhans = $this->hocPhanModel->getAll();
        require_once 'app/views/hocphan/list.php';
    }

    public function detail()
    {
        if (!isset($_GET['MaHP'])) {
            $_SESSION['error'] = "Không tìm thấy học phần!";
            header("Location: index.php?controller=hocphan&action=index");
            exit;
        }

        $maHP = $_GET['MaHP'];
        $hocPhan = $this->hocPhanModel->getById($maHP);

        if (!$hocPhan) {
            $_SESSION['error'] = "Học phần không tồn tại!";
            header("Location: index.php?controller=hocphan&action=index");
            exit;
        }

        require_once 'app/views/hocphan/detail.php';
    }


}
