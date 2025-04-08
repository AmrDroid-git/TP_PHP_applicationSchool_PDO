<?php
session_start();

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$isAdmin = isset($_SESSION['admin']);
$mode = ($isAdmin && ($_GET['mode'] ?? '') === 'admin') ? 'admin' : 'readonly';
$page = $_GET['page'] ?? 'home';

require_once "connexion.php";
require_once "Repository.php";

$pdo = getConnexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BD_STUDENTS</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
</head>

<body>
    <div class="navbar">
        <a href="index.php?page=home&mode=<?= $mode ?>">Home</a>
        <a href="index.php?page=etudiants&mode=<?= $mode ?>">Liste des étudiants</a>
        <a href="index.php?page=sections&mode=<?= $mode ?>">Liste des sections</a>
        <?php if ($isAdmin): ?>
            <?php if ($mode === 'admin'): ?>
                <a href="index.php?page=etudiants&mode=readonly">Revenir en mode ReadOnly</a>
            <?php else: ?>
                <a href="index.php?page=etudiants&mode=admin">Passer en mode Admin</a>
            <?php endif; ?>
        <?php endif; ?>
        <a href="logout.php">Se déconnecter</a>
    </div>

    <div class="containerTableau">
        <?php if ($page === 'home'): ?>
            <h2>Bienvenue dans notre application</h2>
            <?php if ($mode === 'admin'): ?>
                <h3>ADMIN</h3><?php endif; ?>

        <?php elseif ($page === 'etudiants'): ?>
            <?php
            $studentRepo = new Repository("student");
            $filterName = $_GET['filter_name'] ?? '';
            if ($filterName) {
                $stmt = $pdo->prepare("SELECT * FROM student WHERE name LIKE ?");
                $stmt->execute(["$filterName%"]);
                $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $etudiants = $studentRepo->findAll();
            }
            ?>
            <h2>Liste des étudiants</h2>
            <?php if ($mode === 'admin'): ?>
                <a href="ajouterEtudiant.php" class="add-btn">Ajouter un étudiant</a>
            <?php endif; ?>

            <form method="GET" style="margin-bottom: 20px;">
                <input type="hidden" name="page" value="etudiants">
                <input type="hidden" name="mode" value="<?= $mode ?>">
                <input type="text" name="filter_name" placeholder="Filtrer par nom"
                    value="<?= htmlspecialchars($filterName) ?>">
                <button type="submit">Filtrer</button>
            </form>

            <table id="studentsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Détails</th>
                        <?php if ($mode === 'admin'): ?>
                            <th>Actions</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etudiants as $etudiant): ?>
                        <tr>
                            <td><?= $etudiant['id'] ?></td>
                            <td><img src="<?= $etudiant['photo'] ?>" class="photoTable"></td>
                            <td><?= $etudiant['name'] ?></td>
                            <td><?= $etudiant['birthday'] ?></td>
                            <td><a href="detailEtudiant.php?id=<?= $etudiant['id'] ?>&mode=<?= $mode ?>">Détails</a></td>
                            <?php if ($mode === 'admin'): ?>
                                <td>
                                    <a href="modifierEtudiant.php?id=<?= $etudiant['id'] ?>">✏️</a>
                                    <a href="supprimerEtudiant.php?id=<?= $etudiant['id'] ?>"
                                        onclick="return confirm('Supprimer cet étudiant ?');">🗑️</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php elseif ($page === 'sections'): ?>
            <?php
            $sectionRepo = new Repository("section");
            $sections = $sectionRepo->findAll();
            ?>
            <h2>Liste des sections</h2>
            <?php if ($mode === 'admin'): ?>
                <a href="ajouterSection.php" class="add-btn">Ajouter une section</a>
            <?php endif; ?>

            <table id="sectionsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Désignation</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sections as $section): ?>
                        <tr>
                            <td><?= $section['id'] ?></td>
                            <td><?= $section['designation'] ?></td>
                            <td><?= $section['description'] ?></td>
                            <td>
                                <a href="sectionStudents.php?section=<?= $section['designation'] ?>">📋</a>
                                <?php if ($mode === 'admin'): ?>
                                    <a href="modifierSection.php?id=<?= $section['id'] ?>">✏️</a>
                                    <a href="deleteSection.php?id=<?= $section['id'] ?>"
                                        onclick="return confirm('Supprimer cette section ?');">🗑️</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>

    <script>
        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#studentsTable')) {
                $('#studentsTable').DataTable().destroy();
            }
            if ($.fn.DataTable.isDataTable('#sectionsTable')) {
                $('#sectionsTable').DataTable().destroy();
            }
            $('#studentsTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf']
            });
            $('#sectionsTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf']
            });
        });
    </script>

</body>

</html>