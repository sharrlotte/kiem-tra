<!DOCTYPE html>
<html>

<head>
    <title>Sinh viên</title>
    <?php require_once 'app/views/shares/header.php'; ?>
</head>

<body>
    <div class="container">
        <h1>Sinh viên</h1>
        <div>
            <p><strong>MaSV:</strong> <?php echo $student['MaSV']; ?></p>
            <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($student['HoTen']); ?></p>
            <p><strong>Giới tính:</strong> <?php echo htmlspecialchars($student['GioiTinh']); ?></p>
            <p><strong>Ngày sinh:</strong> <?php echo htmlspecialchars($student['NgaySinh']); ?></p>
            <p><strong>Tên ngành:</strong> <?php echo htmlspecialchars($student['ten_nganh']);
            ?></p>
            <?php if (!empty($student['Hinh'])): ?>
                <p><strong>Ảnh:</strong></p>
                <img src="<?php echo htmlspecialchars($student['Hinh']); ?>" alt="Product Image" style="max-width: 300px;">
            <?php endif; ?>
        </div>
        <a class="btn btn-primary mt-2" href="index.php?controller=student&action=index">Quay lại</a>
    </div>
    <?php require_once 'app/views/shares/footer.php'; ?>
</body>

</html>
