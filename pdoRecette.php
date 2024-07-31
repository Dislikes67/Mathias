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
$sqlQuery = "SELECT id_recette, nom_recette, tempsPreparation, nom_Categorie
     FROM recette
     INNER JOIN categorie ON recette.id_categorie = categorie.id_categorie";

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
        <td>' . ($recipe['nomCategorie']) . '</td>
         <td><a href="detailRecette.php?id= '. $recipe['id_recette'].'">' . ($recipe['nom_recette']) . '</a></td>
        <td>' . ($recipe['tempsPreparation']) . ' minutes</td>
    </tr>';
}

echo '</tbody>
</table>';
?>

