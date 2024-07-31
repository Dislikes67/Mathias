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
                    id_recette
                    instructions,
                    temps_preparation,
                    quantite
                FROM 
                     recette 
                INNER JOIN 
                     categorie ON id_categorie = id_categorie
                INNER JOIN 
                     contenir ON id_recette = id_recette
                INNER JOIN 
                     ingredient ON id_ingredient = id_ingredient";