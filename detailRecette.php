<?php

// Recupère l'id avec le $_GET['id'] dans la nouvelle page
if (isset($_GET['id'])) {
    $id_recipe = $_GET['id'];

    try {
        //On se connecte à MySQL
        $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recipes;charset=utf8',
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
    $sqlQuery = "SELECT id_recipe, recipe_name, preparation_time, category_name, instructions
                 FROM recipe
                 INNER JOIN category ON recipe.id_category = category.id_category



}