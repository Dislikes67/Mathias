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
echo '<table border="1">
    <thead>
        <tr>
            <th>Catégorie</th>
            <th>Nom de la recette</th>
            <th>Temps de préparation</th>
        </tr>
    </thead>
    <tbody>';

foreach ($recipes as $recipe) {
    echo '<tr>
    <td>' . ($recipe['nomCategorie']) . '</td>
        <td>' . ($recipe['nomRecette']) . '</td>
        <td>' . ($recipe['tempsPreparation']) . ' minutes</td>
    </tr>';
}

echo '</tbody>
</table>';
?>

