<?php

// Kiểm tra nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Bạn cần đăng nhập để xem danh sách học phần đã đăng ký!";
    header('Location: index.php?controller=auth&action=login');
    exit;
}

// Lấy danh sách học phần đã đăng ký từ session
$dangKyList = $_SESSION['dang_ky_hoc_phan'] ?? [];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Học Phần Đã Đăng Ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <?php require_once 'app/views/shares/header.php'; ?>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Danh sách Học Phần Đã Đăng Ký</h2>

        <!-- Hiển thị thông báo nếu có -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($dangKyList)) : ?>
            <div class="alert alert-warning">Bạn chưa đăng ký học phần nào.</div>
        <?php else : ?>
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
                    <?php foreach ($dangKyList as $hocPhan) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hocPhan['MaHP']); ?></td>
                            <td><?php echo htmlspecialchars($hocPhan['TenHP']); ?></td>
                            <td><?php echo htmlspecialchars($hocPhan['SoTinChi']); ?></td>
                            <td>
                                <!-- Nút xem chi tiết -->
                                <a href="index.php?controller=hocphan&action=detail&MaHP=<?php echo htmlspecialchars($hocPhan['MaHP']); ?>" class="btn btn-info">
                                    Xem Chi Tiết
                                </a>

                                <!-- Nút xóa -->
                                <form method="POST" action="index.php?controller=dangky&action=delete" style="display: inline-block;">
                                    <input type="hidden" name="MaHP" value="<?php echo htmlspecialchars($hocPhan['MaHP']); ?>">
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Thông tin sinh viên -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                Thông Tin Sinh Viên
            </div>
            <div class="card-body">
                <p><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($sinhVien['MaSV']); ?></p>
                <p><strong>Họ Tên:</strong> <?php echo htmlspecialchars($sinhVien['HoTen']); ?></p>
                <p><strong>Giới tính:</strong> <?php echo htmlspecialchars($sinhVien['GioiTinh']); ?></p>
                <p><strong>Ngày sinh:</strong> <?php echo htmlspecialchars($sinhVien['NgaySinh']); ?></p>
                <p><strong>Tên ngành:</strong> <?php echo htmlspecialchars($sinhVien['ten_nganh']);
                                                ?></p>
                <?php if (!empty($sinhVien['Hinh'])): ?>
                    <p><strong>Ảnh:</strong></p>
                    <img src="<?php echo htmlspecialchars($sinhVien['Hinh']); ?>" alt="Product Image" style="max-width: 300px;">
                <?php endif; ?>

            </div>
        </div>

        <!-- Nút Xóa Toàn Bộ Học Phần -->
        <form method="POST" action="index.php?controller=dangky&action=clear" class="mt-3">
            <button type="submit" class="btn btn-danger">Xóa Toàn Bộ Học Phần</button>
        </form>

        <!-- Nút Sao Lưu Tất Cả Học Phần vào CSDL -->
        <form method="POST" action="index.php?controller=dangky&action=backup" class="mt-2">
            <button type="submit" class="btn btn-primary">Sao Lưu Tất Cả vào Cơ Sở Dữ Liệu</button>
        </form>

        <a href="index.php?controller=hocphan&action=index" class="btn btn-secondary mt-3">Quay Lại Danh Sách Học Phần</a>
    </div>
</body>

</html>
