<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once "connexion.php";
require_once "SectionDB.php";

$pdo = getConnexion();
$sectionDB = new SectionDB();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?page=sections");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM section WHERE id = ?");
$stmt->execute([$id]);
$section = $stmt->fetch();

if (!$section) {
    echo "Section introuvable.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $designation = $_POST['designation'];
    $description = $_POST['description'];

    $pdo->prepare("UPDATE section SET designation = ?, description = ? WHERE id = ?")
        ->execute([$designation, $description, $id]);

    header("Location: index.php?page=sections&mode=admin");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Section</title>
    <link rel="stylesheet" href="modifierSection.css">
</head>

<body>
    <div class="form-container">
        <h2>Modifier une section</h2>
        <form method="POST">
            <label>Désignation :</label>
            <input type="text" name="designation" value="<?= $section['designation'] ?>" required>

            <label>Description :</label>
            <textarea name="description" rows="4" required><?= $section['description'] ?></textarea>

            <button type="submit">Modifier</button>
        </form>
    </div>
</body>

</html>