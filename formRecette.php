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
$sqlQuery = "SELECT id_categorie, nomCategorie FROM categorie";
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
        <h1>Créer une recette</h1>
        
        <form action="traitement.php" method="post" enctype="multipart/form-data"> <!-- Ajout de enctype pour les fichiers -->
            <p>
                <label>
                    Photo :
                    <input type="file" accept="image/*, text/*" name="file" required/>
                </label>
            </p>
            <p>
                <label>
                    Catégorie :
                    <select name="categorie" id="category-select" required>
                        <option value="">--Choisissez une catégorie--</option>
                        <?php foreach ($recipes as $recipe) : ?>
                            <option value="<?= $recipe['id_categorie'] ?>"><?= htmlspecialchars($recipe['nomCategorie']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </p>
            <p>
                <label>
                    Nom du plat :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Temps de préparation :
                    <input type="number" name="temps" value="1" min=1 required>
                </label>
            </p>
            <p>
                <label>
                    Ingrédients :
                    <textarea rows="2" cols="25"></textarea>
                </label>
            </p>
            <p>
                <label>
                    Instructions :
                    <textarea rows="2" cols="25"></textarea>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Enregistrer la recette">
            </p>
        </form>
    </div>
</body>
</html>
