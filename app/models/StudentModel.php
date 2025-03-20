<?php

require_once 'app/config/database.php';


class StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT p.*, c.TenNganh as ten_nganh 
            FROM sinhvien p 
            LEFT JOIN NganhHoc c ON p.MaNganh = c.MaNganh
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaSV)
    {
        $stmt = $this->db->prepare('
            SELECT p.*, c.TenNganh as ten_nganh 
            FROM sinhvien p 
            LEFT JOIN NganhHoc c ON p.MaNganh = c.MaNganh
            WHERE p.MaSV = ?
        ');
        $stmt->execute([$MaSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('
            INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES (?, ?, ?, ?, ?, ?)
        ');
        return $stmt->execute([
            $data['MaSV'],
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'] ?? null,
            $data['MaNganh']
        ]);
    }

    public function update($MaSV, $data)
    {
        $stmt = $this->db->prepare('
            UPDATE sinhvien 
            SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? 
            WHERE MaSV = ?
        ');
        return $stmt->execute([
            $data['HoTen'],
            $data['GioiTinh'],
            $data['NgaySinh'],
            $data['Hinh'] ?? null,
            $data['MaNganh'],
            $MaSV
        ]);
    }

    public function delete($MaSV)
    {
        $stmt = $this->db->prepare('
            DELETE FROM sinhvien 
            WHERE MaSV = ?
        ');
        return $stmt->execute([$MaSV]);
    }
}
