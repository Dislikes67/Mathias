<?php

// Recupère l'id avec le $_GET['id'] dans la nouvelle page
if (isset($_GET['id'])) {
    $id_recipe = $_GET['id'];

    try {
        //On se connecte à MySQL
        $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recette_mathias;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}

    catch (Exception $e)
    
    {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}
    $sqlQuery = "SELECT
                    id_recette,
                    instructions,
                    temps_preparation,
                    quantite
                FROM 
                     recette 
                INNER JOIN 
                     categorie ON recette.id_categorie = categorie.id_categorie
                INNER JOIN 
                     contenir ON recette.id_recette = contenir.id_recette
                INNER JOIN 
                     ingredient ON contenir.id_ingredient = ingredient.id_ingredient
                WHERE
                    recette.id_recette =  ";


$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([]);

$recipes = $recipesStatement->fetch();












