<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="logo"><img src="assets/image/logo.png"></div>

    <form action="index.php" method="get">
        <label>Nom de la recette : </label>
        <input type="text" name = "nomRecette">

        <br><br>

        <p>Filtres :</p>

        <label>Repas : </label>
        <select name ="repas" id = "repasSelect">
            <option value="">Choisissez un repas</option>
            <option value="Petit déjeuner">Petit déjeuner</option>
            <option value="déjeuner">déjeuner</option>
            <option value="diner">diner</option>
            <option value="souper">souper</option>
            <option value="gouter">gouter</option>
            <option value="brunch">brunch</option>
            <option value="apéritif dinatoire">apéritif dinatoire</option>
        </select>
    
        <label style="margin-left: 20px;">Régime Alimentaire</label>
        <select name ="regime alimentaire" id = "regimeSelect">
            <option value="">Choisissez un régime alimentaire</option>
            <option value="omnivore">Aucune restriction</option>
            <option value="vegetarien">vegetarien</option>
        </select>

        <br><br>

        <input type="submit" name="valider" value = "Recherche">
    </form>

    <?php
        require("requetePDO.php");

        if(isset($_GET['repas']) && !empty($_GET['repas'])){

            $nom = $_GET['repas'];

            $sql = "SELECT recettes.nom, recettes.note FROM recettes JOIN repas ON recettes.id_repas = repas.id_repas WHERE repas.nom = '$nom'" ;

            $stmt = $pdo->query($sql);

            if($stmt->rowCount()>0){
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Nom de la recette : " . $row['nom'] . " - Note  : " . $row['note']."/10 <br>";
                }
            }

        }

        if(isset($_GET['regime alimentaire']) && !empty($_GET['regime alimentaire'])){

            $nom = $_GET['regime alimentaire'];

            $sql = "SELECT recettes.nom, recettes.note FROM recettes JOIN repas ON recettes.id_repas = repas.id_repas WHERE repas.nom = '$nom'" ;

            $stmt = $pdo->query($sql);

            if($stmt->rowCount()>0){
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Nom de la recette : " . $row['nom'] . " - Note  : " . $row['note']."/10 <br>";
                }
            }

        }

        // $sql = "SELECT * FROM ingredients";

        // $stmt = $pdo->query($sql);

        // if($stmt->rowCount()>0){
        //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //         echo "ID de l'ingrédient: " . $row['id_ingredient'] . " - Nom de l'ingrédient : " . $row['nom']."<br>";
        //     }
        // } else {
        //     echo "0 résultats";
        // }      

    ?> 
</body>
</html>