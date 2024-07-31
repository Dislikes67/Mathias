<?php

//Vérifie si le paramètre id est défini dans l'URL (via $_GET).
//Si c'est le cas, il est assigné à la variable $id_recipe.
if (isset($_GET['id'])) {
    $id_recipe = $_GET['id'];

    try {
        //On se connecte à MySQL
        $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recette_mathias;charset=utf8',
        'root',
        '',
        //configure PDO pour lancer une exception en cas d'erreur.
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );

} catch (Exception $e)
    
    {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = "SELECT
                    id_recette,
                    nomRecette,
                    instructions,               
                    tempsPreparation,
                    nomCategorie
                FROM 
                     recette 
                INNER JOIN 
                     categorie ON recette.id_categorie = categorie.id_categorie
                WHERE
                    recette.id_recette = :id_recette";

//Prépare la requête SQL pour l'exécution avec PDO.
$recipesStatement = $mysqlClient->prepare($sqlQuery);

//Exécute la requête préparée en remplaçant le paramètre :id_recette par la valeur de $id_recipe.
$recipesStatement->execute(["id_recette" => $id_recipe]);

//Récupère le résultat de la requête sous forme de tableau associatif.
$recipe = $recipesStatement->fetch();

    $sqlIngredients = "SELECT
                            nomIngredient,
                            quantite
                        FROM
                            ingredient
                        INNER JOIN
                            contenir ON ingredient.id_ingredient = contenir.id_ingredient
                        WHERE
                            contenir.id_recette = :id_recette";

    $ingredientsStatement = $mysqlClient->prepare($sqlIngredients);
    $ingredientsStatement->execute(["id_recette" => $id_recipe]);

    $ingredients = $ingredientsStatement->fetchAll();

}
                                                

?>


<h1><?= $recipe["nomRecette"] ?></h1>












