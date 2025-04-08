<?php
require_once "connexion.php";

class SectionDB
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getConnexion();
    }

    public function updateDescription($id, $newDescription)
    {
        $stmt = $this->pdo->prepare("UPDATE section SET description = ? WHERE id = ?");
        return $stmt->execute([$newDescription, $id]);
    }

    public function addSection($designation, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO section (designation, description) VALUES (?, ?)");
        return $stmt->execute([$designation, $description]);
    }

    public function deleteSection($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM section WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>