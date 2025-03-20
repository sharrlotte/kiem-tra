<!DOCTYPE html>
<html>

<head>
    <title>Chỉnh sửa sinh viên</title>
    <?php require_once 'app/views/shares/header.php'; ?>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Chỉnh sửa sinh viên</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Họ và Tên:</label>
                                <input type="text" class="form-control" name="HoTen"
                                    value="<?php echo htmlspecialchars($student['HoTen']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giới tính:</label>
                                <select class="form-select" name="GioiTinh" required>
                                    <option value="Nam" <?php echo ($student['GioiTinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                    <option value="Nữ" <?php echo ($student['GioiTinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày sinh:</label>
                                <input type="date" class="form-control" name="NgaySinh"
                                    value="<?php echo htmlspecialchars($student['NgaySinh']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngành học:</label>
                                <select class="form-select" name="MaNganh" required>
                                    <?php foreach ($faculties as $faculty): ?>
                                        <option value="<?php echo $faculty['MaNganh']; ?>" <?php echo ($student['MaNganh'] == $faculty['MaNganh']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($faculty['TenNganh']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ảnh:</label>
                                <?php if (!empty($student['Hinh'])): ?>
                                    <div class="mb-2">
                                        <img src="<?php echo htmlspecialchars($student['Hinh']); ?>" class="img-thumbnail"
                                            style="max-height: 150px;" alt="Ảnh sinh viên hiện tại">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="Hinh" accept="image/*">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="javascript:history.back()" class="btn btn-secondary me-md-2">Hủy</a>
                                <button type="submit" class="btn btn-primary">Cập nhật sinh viên</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'app/views/shares/footer.php'; ?>
</body>

</html>
