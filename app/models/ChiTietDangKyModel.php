<?php

include 'app/config/database.php';

class ChiTietDangKyModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT ctdk.*, dk.NgayDK, sv.HoTen AS ten_sinh_vien, hp.TenHP AS ten_hoc_phan
            FROM ChiTietDangKy ctdk
            LEFT JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
            LEFT JOIN SinhVien sv ON dk.MaSV = sv.MaSV
            LEFT JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaDK, $MaHP)
    {
        $stmt = $this->db->prepare('
            SELECT ctdk.*, dk.NgayDK, sv.HoTen AS ten_sinh_vien, hp.TenHP AS ten_hoc_phan
            FROM ChiTietDangKy ctdk
            LEFT JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
            LEFT JOIN SinhVien sv ON dk.MaSV = sv.MaSV
            LEFT JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
            WHERE ctdk.MaDK = ? AND ctdk.MaHP = ?
        ');
        $stmt->execute([$MaDK, $MaHP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('
            INSERT INTO ChiTietDangKy (MaDK, MaHP) 
            VALUES (?, ?)
        ');
        return $stmt->execute([
            $data['MaDK'],
            $data['MaHP']
        ]);
    }

    public function delete($MaDK, $MaHP)
    {
        $stmt = $this->db->prepare('DELETE FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?');
        return $stmt->execute([$MaDK, $MaHP]);
    }
}
