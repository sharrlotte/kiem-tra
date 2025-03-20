<?php
if (!isset($hocPhan)) {
    echo "<div class='alert alert-danger'>Không tìm thấy học phần!</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Chi Tiết Học Phần</h2>

        <table class="table table-bordered">
            <tr>
                <th>Mã Học Phần</th>
                <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
            </tr>
            <tr>
                <th>Tên Học Phần</th>
                <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
            </tr>
            <tr>
                <th>Số Tín Chỉ</th>
                <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
            </tr>
            <tr>
                <th>Mô Tả</th>
                <td><?php echo nl2br(htmlspecialchars($hocPhan['MoTa'] ?? 'Không có mô tả')); ?></td>
            </tr>
        </table>

        <a href="index.php?controller=dangky&action=list" class="btn btn-secondary">Quay Lại</a>
    </div>
</body>

</html>
