<?php

include 'app/config/database.php';

class DangKyModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT d.*, s.HoTen AS ten_sinh_vien 
            FROM DangKy d 
            LEFT JOIN SinhVien s ON d.MaSV = s.MaSV
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaDK)
    {
        $stmt = $this->db->prepare('
            SELECT d.*, s.HoTen AS ten_sinh_vien 
            FROM DangKy d 
            LEFT JOIN SinhVien s ON d.MaSV = s.MaSV
            WHERE d.MaDK = ?
        ');
        $stmt->execute([$MaDK]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('
            INSERT INTO DangKy (NgayDK, MaSV) 
            VALUES (?, ?)
        ');
        return $stmt->execute([
            $data['NgayDK'],
            $data['MaSV']
        ]);
    }

    public function update($MaDK, $data)
    {
        $stmt = $this->db->prepare('
            UPDATE DangKy 
            SET NgayDK = ?, MaSV = ? 
            WHERE MaDK = ?
        ');
        return $stmt->execute([
            $data['NgayDK'],
            $data['MaSV'],
            $MaDK
        ]);
    }

    public function delete($MaDK)
    {
        $stmt = $this->db->prepare('DELETE FROM DangKy WHERE MaDK = ?');
        return $stmt->execute([$MaDK]);
    }
}
