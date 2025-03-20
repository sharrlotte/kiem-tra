<!DOCTYPE html>
<html>

<head>
    <title>Thêm Sinh Viên</title>
    <?php require_once 'app/views/shares/header.php'; ?>
</head>

<body>
    <h1 class="container mb-4">Thêm Sinh Viên Mới</h1>
    <form method="POST" enctype="multipart/form-data" class="mb-4 container overflow-auto">
        <div class="mb-3">
            <label class="form-label">Mã số sinh viên:</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Họ và Tên:</label>
            <input type="text" name="HoTen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-control" required>
                <option value="">Chọn Giới Tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Khoa:</label>
            <select name="MaNganh" class="form-control" required>
                <option value="">Chọn Khoa</option>
                <?php
                $facultyModel = new FacultyModel();
                $faculties = $facultyModel->getAll();
                if ($faculties) {
                    foreach ($faculties as $faculty) {
                        echo '<option value="' . $faculty['MaNganh'] . '">' .
                            htmlspecialchars($faculty['TenNganh']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Hình Ảnh:</label>
            <input type="file" name="Hinh" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
        <a href="index.php?controller=student&action=index" class="btn btn-secondary">Hủy</a>
    </form>
    <?php require_once 'app/views/shares/footer.php'; ?>
</body>

</html>
