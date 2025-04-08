<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once "StudentDB.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $studentDB = new StudentDB();
    $studentDB->deleteEtudiant($id);
}

header("Location: admin.php");
exit;
