<!DOCTYPE html>
<html>

<head>
    <title>Viên sinh</title>
    <?php require_once 'app/views/shares/header.php'; ?>
</head>

<body>
    <div class="container d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách sinh viên</h1>
        <a href="index.php?controller=student&action=add" class="btn btn-primary">Thêm sinh viên</a>
    </div>

    <div class="table-responsive container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Ngành</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['MaSV']; ?></td>
                        <td>
                            <?php if ($student['Hinh']): ?>
                                <img src="<?php echo htmlspecialchars($student['Hinh']); ?>"
                                    alt="<?php echo htmlspecialchars($student['HoTen']); ?>" style="max-width: 50px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($student['HoTen']); ?></td>
                        <td><?php echo htmlspecialchars($student['GioiTinh']); ?></td>
                        <td><?php echo htmlspecialchars($student['NgaySinh']); ?></td>
                        <td><?php echo htmlspecialchars($student['ten_nganh'] ?? 'Khong co nganh'); ?></td>
                        <td>
                            <div class="btn-group gap-2" role="group">
                                <a href="index.php?controller=student&action=edit&id=<?php echo $student['MaSV']; ?>" class="btn btn-sm btn-primary">Sửa</a>
                                <a href="index.php?controller=student&action=show&id=<?php echo $student['MaSV']; ?>" class="btn btn-sm btn-info">Xem chi tiết</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $student['MaSV']; ?>">
                                    Xóa
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $student['MaSV']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Xác nhận xóa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc muốn xóa
                                            "<?php echo htmlspecialchars($student['HoTen']); ?>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <a href="index.php?controller=student&action=delete&id=<?php echo $student['MaSV']; ?>"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php require_once 'app/views/shares/footer.php'; ?>
</body>

</html>
