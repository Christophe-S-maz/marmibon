<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

        $host = 'localhost';
        $dbname = 'recette_ch';
        $username = 'root';
        $password = '';

        try {

            // Connexion à la base de données avec PDO
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8"; // DSN
            $pdo = new PDO($dsn, $username, $password);
            
            // Configuration des attributs PDO
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    ?>
</body>
</html>
