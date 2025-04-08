<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}


require_once "StudentDB.php";
$studentDB = new StudentDB();

require_once "connexion.php";
$pdo = getConnexion();
$sections = $pdo->query("SELECT designation FROM section")->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section = $_POST['section'];
    $photo = $_POST['photo'];

    $studentDB->addEtudiant($name, $birthday, $section, $photo);
    header("Location: index.php?page=etudiants&mode=admin");

    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Étudiant</title>
    <link rel="stylesheet" href="ajouterEtudiant.css">
</head>

<body>
    <div class="form-container">
        <h2>Ajouter un nouvel étudiant</h2>
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="name" required>

            <label>Date de naissance :</label>
            <input type="date" name="birthday" required>

            <label>Section :</label>
            <select name="section" required>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= htmlspecialchars($section['designation']) ?>">
                        <?= htmlspecialchars(strtoupper($section['designation'])) ?>
                    </option>
                <?php endforeach; ?>
            </select>


            <label>URL de la photo :</label>
            <input type="text" name="photo" required>

            <button type="submit">Ajouter</button>
        </form>
    </div>
</body>

</html>