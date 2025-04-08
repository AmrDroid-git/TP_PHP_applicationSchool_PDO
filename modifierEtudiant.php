<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once "StudentDB.php";
$studentDB = new StudentDB();

if (!isset($_GET['id'])) {
    echo "ID étudiant manquant.";
    exit;
}

$id = $_GET['id'];
$pdo = getConnexion();
$stmt = $pdo->prepare("SELECT * FROM student WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    echo "Étudiant non trouvé.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section = $_POST['section'];
    $photo = $_POST['photo'];

    $studentDB->updateEtudiant($id, $name, $birthday, $section, $photo);
    header("Location: index.php?page=etudiants&mode=admin");

    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Étudiant</title>
    <link rel="stylesheet" href="modifierEtudiant.css">
</head>

<body>
    <form method="POST">
        <label>Nom:</label>
        <input type="text" name="name" value="<?= $etudiant['name'] ?>" required>

        <label>Birthday:</label>
        <input type="date" name="birthday" value="<?= $etudiant['birthday'] ?>" required>

        <label>Section:</label>
        <select name="section" required>
            <option value="gl" <?= $etudiant['section'] === 'gl' ? 'selected' : '' ?>>GL</option>
            <option value="rt" <?= $etudiant['section'] === 'rt' ? 'selected' : '' ?>>RT</option>
            <option value="imi" <?= $etudiant['section'] === 'imi' ? 'selected' : '' ?>>IMI</option>
            <option value="iia" <?= $etudiant['section'] === 'iia' ? 'selected' : '' ?>>IIA</option>
        </select>


        <label>Photo (URL):</label>
        <input type="text" name="photo" value="<?= $etudiant['photo'] ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>

</html>