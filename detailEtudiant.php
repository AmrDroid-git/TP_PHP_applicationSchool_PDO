<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>


<?php
include "connexion.php";
$bdd = getConnexion();


if (!isset($_GET['id'])) {
    echo "Aucun etudiant sélectionné!";
    exit;
}

$id = $_GET['id'];
$statement = $bdd->prepare("SELECT * FROM student WHERE id = ?");
$statement->execute([$id]);
$etudiant = $statement->fetch();

if (!$etudiant) {
    echo "Etudiant n'existe pas!";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student <?= $etudiant['id'] ?></title>
    <link rel="stylesheet" href="details.css">
</head>

<body>
    <div class="container">

        <a href="index.php?page=etudiants&mode=<?= isset($_SESSION['admin']) ? 'admin' : 'readonly' ?>"
            class="back-arrow" title="Retour">
            &#8592; Retour à la liste
        </a>

        <h1>Nom: <?= $etudiant['name'] ?></h1>

        <img src="<?= $etudiant['photo'] ?>" class="photoEtudiant" alt="photo de l'étudiant">

        <h2>Section: <?= $etudiant['section'] ?></h2>
        <h2>Birthday: <?= $etudiant['birthday'] ?></h2>

        <form action="logout.php" method="post" class="logout-btn">
            <button type="submit">Se déconnecter</button>
        </form>
    </div>

</body>


</html>