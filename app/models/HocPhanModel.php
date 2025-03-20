<?php

include 'app/config/database.php';

class HocPhanModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM HocPhan');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaHP)
    {
        $stmt = $this->db->prepare('SELECT * FROM HocPhan WHERE MaHP = ?');
        $stmt->execute([$MaHP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('
            INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) 
            VALUES (?, ?, ?)
        ');
        return $stmt->execute([
            $data['MaHP'],
            $data['TenHP'],
            $data['SoTinChi']
        ]);
    }

    public function update($MaHP, $data)
    {
        $stmt = $this->db->prepare('
            UPDATE HocPhan 
            SET TenHP = ?, SoTinChi = ? 
            WHERE MaHP = ?
        ');
        return $stmt->execute([
            $data['TenHP'],
            $data['SoTinChi'],
            $MaHP
        ]);
    }

    public function delete($MaHP)
    {
        $stmt = $this->db->prepare('DELETE FROM HocPhan WHERE MaHP = ?');
        return $stmt->execute([$MaHP]);
    }

    public function saveToDatabase($maSV, $dangKyList)
    {
        $stmt = $this->db->prepare('
            INSERT INTO DangKy (NgayDK, MaSV) 
            VALUES (CURDATE(), ?)
        ');
        $dangKy = $stmt->execute([
            $maSV
        ]);

        $stmt = $this->db->prepare("INSERT INTO chitietdangky (MaDK, MaHP) VALUES (:MaDK, :MaHP)");

        foreach ($dangKyList as $maHP) {
            $stmt->execute([
                'MaHP' => $maHP
            ]);
        }

        
    }
}
