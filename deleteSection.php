<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once "SectionDB.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?page=sections&mode=admin");
    exit;
}

$sectionDB = new SectionDB();
$sectionDB->deleteSection($id);
header("Location: index.php?page=sections&mode=admin");
exit;
?>