<?php
// Connexion à la base de données
try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recette_mathias;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des recettes pour le menu déroulant
$sqlQuery = "SELECT id_recette, nomRecette FROM recette";
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recette</title>
</head>
<body>
    <div class="container">
        <h1>Rechercher une recette</h1>
        
        <form action="traitement.php" method="post" enctype="multipart/form-data"> <!-- Ajout de enctype pour les fichiers -->
            <p>
                <label>
                    Photo :
                    <input type="file" accept="image/*, text/*" name="file" required/>
                </label>
            </p>
            <p>
                <label>
                    Recette :
                    <select name="recette" id="recipe-select" required>
                        <option value="">--Choisissez une recette--</option>
                        <?php foreach ($recipes as $recipe) : ?>
                            <option value="<?= $recipe['id_recette'] ?>"><?= htmlspecialchars($recipe['nomRecette']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>
            <p>
                <label>
                    Nombre de personnes :
                    <input type="number" name="nb" value="1" min="1" required>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Afficher la recette">
            </p>
        </form>
    </div>
</body>
</html>
