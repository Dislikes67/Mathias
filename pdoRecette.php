<?php

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
//Si tout va bien on peut continuer

//On recupère tout le contenu de la table recette
$sqlQuery = "SELECT id_recipe, recipe_name, preparation_time, category_name
     FROM recipe
     INNER JOIN category ON recipe.id_category = category.id_category";

$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([]);

$recipes = $recipesStatement->fetchAll(); // fetch quand une seule et fetchAll à partir de deux

//Premiere partie du tableau head
echo '<table border="1">
    <thead>
        <tr>
            <th>Catégorie</th>
            <th>Nom de la recette</th>
            <th>Temps de préparation</th>
        </tr>
    </thead>
    <tbody>';
//On affiche chaque recette une à une dans le tableau
foreach ($recipes as $recipe) {
    echo '<tr>
        <td>' . ($recipe['category_name']) . '</td>
         <td><a href="detailRecette.php?id= '. $recipe['id_recipe'].'">' . ($recipe['recipe_name']) . '</a></td>
        <td>' . ($recipe['preparation_time']) . ' minutes</td>
    </tr>';
}

echo '</tbody>
</table>';
?>

