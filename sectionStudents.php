<?php
session_start();
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require_once "connexion.php";
$pdo = getConnexion();

$section = $_GET['section'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM student WHERE section = ?");
$stmt->execute([$section]);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Étudiants de la section <?= htmlspecialchars($section) ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="containerTableau">
        <h2>Les étudiants de la section <?= htmlspecialchars($section) ?></h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Anniversaire</th>
                    <th>Section</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?= $etudiant['id'] ?></td>
                        <td><?= $etudiant['name'] ?></td>
                        <td><?= $etudiant['birthday'] ?></td>
                        <td><?= $etudiant['section'] ?></td>
                        <td><img src="<?= $etudiant['photo'] ?>" class="photoTable"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php?page=sections" class="admin-btn">← Retour à la liste des sections</a>
    </div>
</body>

</html>