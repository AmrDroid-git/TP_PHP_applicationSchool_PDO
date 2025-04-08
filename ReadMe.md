Pour que l'application fonctionne parfaitement dans ta machine:

1. créer la base de données et les tables dans MySQL (en exécutant les requêtes sql des fichiers table_etudians.sql puis table_admins&users.sql).

2. Dans le fichier connexion.php et plus précisement dans la ligne:
   $maDb_connexion = new PDO("mysql:host=localhost;port=3306;dbname=PHP_TP", "root", "0000");
   remplacer les infos de la base de données avec les votres (port, username, password...)

3. Ouvrir cmd et naviguer vers le dossier contenat le projet,
   puis écrire la commande:
   php -S localhost:8000

4. Ouvrir le Browser pour voir le website:
   http://localhost:8000/

🌸MERCI🌸
