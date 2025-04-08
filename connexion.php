<?php
function getConnexion()
{
    try {
        $maDb_connexion = new PDO("mysql:host=localhost;port=3306;dbname=PHP_TP", "root", "0000");
        //remplacer les infos de la DB avec votre.
        $maDb_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connexion success";
        return $maDb_connexion;
    } catch (PDOException $e) {
        // echo "connexion echec";
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>