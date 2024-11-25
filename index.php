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
        <select name ="regime-alimentaire" id = "regimeSelect">
            <option value="">Choisissez un régime alimentaire</option>
            <option value="omnivore">Aucune restriction</option>
            <option value="vegetarien">vegetarien</option>
        </select>

        <br><br>

        <input type="submit" name="valider" value = "Recherche">
    </form>

    <?php
        require("requetePDO.php");

        if((isset($_GET['repas']) && !empty($_GET['repas'])) && (isset($_GET['regime-alimentaire']) && !empty($_GET['regime-alimentaire']))){

        }
        else{
            if(isset($_GET['repas']) && !empty($_GET['repas'])){

                $nom = $_GET['repas'];

                $sql = "SELECT recettes.nom, recettes.note FROM recettes JOIN repas ON recettes.id_repas = repas.id_repas WHERE repas.nom = '$nom'" ;

                $stmt = $pdo->query($sql);

                if($stmt->rowCount()>0){
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo  $row['nom'] . " - Note  : " . $row['note']."/10 <br>";
                    }
                }

            } else 
                if(isset($_GET['regime-alimentaire']) && !empty($_GET['regime-alimentaire'])){

                $nom = $_GET['regime-alimentaire'];

                if($nom == "omnivore"){
                    $sql = "SELECT recettes.nom, recettes.note
                            FROM recettes
                            ";
                } else {
                    $sql = "SELECT recettes.nom, recettes.note
                            FROM recettes                       
                            WHERE recettes.id_recette NOT IN (
                                                        SELECT recettes.id_recette
                                                        FROM recettes
                                                        JOIN ingredients_recettes
                                                        ON recettes.id_recette = ingredients_recettes.id_recette
                                                        JOIN ingredients
                                                        ON ingredients_recettes.id_ingredient = ingredients.id_ingredient
                                                        JOIN ingredients_regimes
                                                        ON ingredients.id_ingredient = ingredients_regimes.id_ingredient
                                                        JOIN regimes_alimentaire
                                                        ON ingredients_regimes.id_regime = regimes_alimentaire.id_regime
                                                        WHERE regimes_alimentaire.nom IN ('omnivore')
                                                        )   
                            ";
                }

                

                $stmt = $pdo->query($sql);

                if($stmt->rowCount()>0){
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo  $row['nom'] . " - Note  : " . $row['note']."/10 <br>";
                    }
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