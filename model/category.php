<?php
require_once "../connect/connect.php";

class Category extends connect
{

    public function listCategory()
    {
        $sql = 'SELECT * FROM categories';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($name, $image, $status, $description)
    {
        $sql = 'INSERT INTO categories (name,image,status,description) VALUES (?,?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $image, $status, $description]);
    }

    public function update($id,$name, $image, $status, $description)
    {
        $sql = 'UPDATE categories SET name=?,image=?,status=?,description=? WHERE cate_id=?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $image, $status, $description, $id]);
    }
    public function getCategoryByID()
    {
        $sql = 'SELECT * FROM categories WHERE cate_id=?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$_GET['id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql = 'DELETE FROM categories WHERE cate_id=?';
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$_GET['id']]);
    }
}
