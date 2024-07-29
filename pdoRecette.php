<?php

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
//Si tout va bien on peut continuer

//On recupère tout le contenu de la table recette
$sqlQuery = "SELECT * FROM recette WHERE author = :author AND is_enabled = :is_enabled";

$recipesStatement = $mysqlClient->prepare('SELECT * FROM recette');

$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

//On affiche chaque recette une à une
foreach ($recipes as $recipe) {
    ?>
        <p><?php echo $recipe ['author']; ?></p>
    <?php
    }
    ?>


