<?php

if(isset($_GET['id'])) {
    $id_recipe = $_GET['id'];

    //Sanitize and validate inputs
    $file = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $nb = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
}
    // Récupération des recettes pour le menu déroulant
$sqlQuery = "SELECT id_recette, nomRecette FROM recette";
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette</title>
</head>
<body>
    <div class="container">
        <h1>Rechercher une recette</h1>
        
        <form action="traitement.php" method="post"> <!--Le formulaire est envoyé en utilisant la requête HTML POST qui ne le stocke pas dans l'url à l'inverse de la méthode GET -->
            <p>
                <label>
                    Photo :
                    <input type="file" accept="image/*, text/*" name="file"/>
                </label>
            </p>
            <p>
                <label>
                    Recette :
                <label for="recipe-select"></label>

                    <select name="recette" id="recipe-select">
                    <option value="">--Choisissez une recette--</option>
                    </select>
                </label>
            </p>
            <p>
                <label>
                    Nombre de personnes :
                    <input type="number" name="nb" value="1" min=1 required>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Afficher la recette">
            </p>
        </form>
    </div>
</body>
</html>