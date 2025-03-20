<?php
require_once 'app/models/HocPhanModel.php';

$hocPhanModel = new HocPhanModel();
$hocPhanList = $hocPhanModel->getAll();

// Tính tổng số học phần và tổng số tín chỉ
$totalCourses = count($hocPhanList);
$totalCredits = array_sum(array_column($hocPhanList, 'SoTinChi'));
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <?php require_once 'app/views/shares/header.php'; ?>

</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Danh sách Học Phần</h2>

        <!-- Hiển thị tổng số học phần và tổng số tín chỉ -->
        <div class="alert alert-info">
            <strong>Tổng số học phần:</strong> <?php echo $totalCourses; ?> |
            <strong>Tổng số tín chỉ:</strong> <?php echo $totalCredits; ?>
        </div>

        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hocPhanList as $hocPhan) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
                        <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
                        <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
                        <td>
                            <form method="POST" action="index.php?controller=dangky&action=add">
                                <input type="hidden" name="MaHP" value="<?php echo htmlspecialchars($hocPhan['MaHP']); ?>">
                                <button type="submit" class="btn btn-success">Đăng Ký</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary mt-3">Quay Lại</a>
    </div>
</body>

</html>
