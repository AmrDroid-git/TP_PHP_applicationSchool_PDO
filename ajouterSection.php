<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once "SectionDB.php";
$sectionDB = new SectionDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $designation = $_POST['designation'];
    $description = $_POST['description'];

    $sectionDB->addSection($designation, $description);
    header("Location: index.php?page=sections&mode=admin");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Section</title>
    <link rel="stylesheet" href="ajouterSection.css">
</head>

<body>
    <div class="form-container">
        <h2>Ajouter une nouvelle section</h2>
        <form method="POST">
            <label>Désignation :</label>
            <input type="text" name="designation" required>

            <label>Description :</label>
            <textarea name="description" rows="4" required></textarea>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>