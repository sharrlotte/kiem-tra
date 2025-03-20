<?php

require_once 'app/config/database.php';

class FacultyModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM NganhHoc');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($MaNganh)
    {
        $stmt = $this->db->prepare('SELECT * FROM NganhHoc WHERE MaNganh = ?');
        $stmt->execute([$MaNganh]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('INSERT INTO NganhHoc (TenNganh) VALUES (?, ?)');
        return $stmt->execute([$data['TenNganh']]);
    }

    public function update($MaNganh, $data)
    {
        $stmt = $this->db->prepare('UPDATE NganhHoc SET TenNganh = ?, description = ? WHERE MaNganh = ?');
        return $stmt->execute([$data['TenNganh'], $MaNganh]);
    }
}
