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
$sqlQuery = "SELECT nomRecette, tempsPreparation, nomCategorie
     FROM recette
     INNER JOIN categorie ON recette.id_categorie = categorie.id_categorie";

$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([]);

$recipes = $recipesStatement->fetchAll(); // fetch quand une seule et fetchAll à partir de deux

//On affiche chaque recette une à une
foreach ($recipes as $recipe) {
    ?>
    <table border="1">
        <tr>
            <th>Nom de la recette</th>
            <td><?php echo ($recipe['nomRecette']); ?></td>
        </tr>
        <tr>
            <th>Temps de préparation</th>
            <td><?php echo ($recipe['tempsPreparation']); ?> minutes</td>
        </tr>
        <tr>
            <th>Catégorie</th>
            <td><?php echo ($recipe['nomCategorie']); ?></td>
        </tr>
    </table>
    <br>
    <?php
    }
    ?>

