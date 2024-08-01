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
                    nomCategorie,
                    imageRecette
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
                            quantite,
                            unite
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la recette</title>
</head>
<body>

<?php if ($recipe): ?>
    <h1><?= ($recipe["nomRecette"]) ?></h1>
    <p><strong>Type de recette :</strong> <?= ($recipe["nomCategorie"]) ?></p>
    <p><strong>Temps de préparation :</strong> <?= ($recipe["tempsPreparation"]) ?> minutes</p>
    <p><strong>Instructions :</strong> <?= nl2br($recipe["instructions"]) ?></p>

<?php if (!empty($recipe["imageRecette"])): ?>
    <p><img src="<?= ($recipe["imageRecette"]) ?>" alt="<?= ($recipe["nomRecette"]) ?>" style="max-width: 30%; height: auto;"></p>
<?php endif; ?>

    <h2>Ingrédients :</h2>
    <ul>
        <?php foreach ($ingredients as $ingredient) : ?>
            <li><?= ($ingredient["nomIngredient"]) ?> - <?= ($ingredient["quantite"]) ?> <?= ($ingredient["unite"])?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>