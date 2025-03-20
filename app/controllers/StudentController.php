<?php
class StudentController
{
    private $studentModel;
    private $facultyModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->facultyModel = new FacultyModel();
    }

    public function index()
    {
        $students = $this->studentModel->getAll();
        require_once 'app/views/student/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'MaSV' => $_POST['MaSV'] ?? '',
                'HoTen' => $_POST['HoTen'] ?? '',
                'GioiTinh' => $_POST['GioiTinh'] ?? '',
                'NgaySinh' => $_POST['NgaySinh'] ?? '',
                'MaNganh' => $_POST['MaNganh'] ?? null
            ];

            // Xử lý tải ảnh lên
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['Hinh']['name']);

                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $uploadFile)) {
                    $data['Hinh'] = $uploadFile;
                }
            }

            $this->studentModel->create($data);
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        $faculties = $this->facultyModel->getAll();
        require_once 'app/views/student/add.php';
    }

    public function show($id)
    {
        $student = $this->studentModel->getById($id);
        require_once 'app/views/student/show.php';
    }

    public function edit($id)
    {
        $student = $this->studentModel->getById($id);
        $faculties = $this->facultyModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'HoTen' => $_POST['HoTen'] ?? '',
                'GioiTinh' => $_POST['GioiTinh'] ?? '',
                'NgaySinh' => $_POST['NgaySinh'] ?? '',
                'MaNganh' => $_POST['MaNganh'] ?? null
            ];

            // Xử lý tải ảnh lên
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['Hinh']['name']);

                if (move_uploaded_file($_FILES['Hinh']['tmp_name'], $uploadFile)) {
                    $data['Hinh'] = $uploadFile;
                }
            }

            $this->studentModel->update($id, $data);
            header('Location: index.php?controller=student&action=index');
            exit;
        }

        require_once 'app/views/student/edit.php';
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=student');
            exit;
        }

        $id = $_GET['id'];
        
        if ($this->studentModel->delete($id)) {
            $_SESSION['success'] = "Xóa sinh viên thành công.";
        } else {
            $_SESSION['error'] = "Xóa sinh viên thất bại.";
        }

        header('Location: index.php?controller=student');
        exit;
    }
}
