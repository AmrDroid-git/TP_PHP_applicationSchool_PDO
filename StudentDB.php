<?php
require_once "connexion.php";

class StudentDB
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getConnexion();
    }

    public function addEtudiant($name, $birthday, $section, $photo)
    {
        $stmt = $this->pdo->prepare("INSERT INTO student (name, birthday, section, photo) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $birthday, $section, $photo]);
    }

    public function updateEtudiant($id, $name, $birthday, $section, $photo)
    {
        $stmt = $this->pdo->prepare("UPDATE student SET name = ?, birthday = ?, section = ?, photo = ? WHERE id = ?");
        return $stmt->execute([$name, $birthday, $section, $photo, $id]);
    }

    public function deleteEtudiant($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM student WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>