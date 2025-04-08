<?php
session_start();

if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>



<?php
include "connexion.php";
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=PHP_TP", "root", "0000");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        // Créer session selon le rôle
        if ($user['role'] === 'admin') {
            $_SESSION['admin'] = $user['username'];
        } else {
            $_SESSION['user'] = $user['username'];
        }

        header("Location: index.php");
        exit;
    } else {
        echo "Identifiants invalides. Veuillez réessayer.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Login</button>
    </form>

</body>

</html>