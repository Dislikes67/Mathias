<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitize and validate inputs
    $file = filter_input(INPUT_POST, "file", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nb = filter_input(INPUT_POST, "nb", FILTER_VALIDATE_INT);
    
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

    // Traitement de l'image uploadée
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg', 'txt'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = './uploaded_images/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo "L'image a été téléchargée avec succès.";
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Type de fichier non autorisé.";
        }
    } else {
        echo "Aucune image téléchargée ou une erreur est survenue.";
    }

    // Récupération des détails de la recette sélectionnée
    if (isset($_POST['recette'])) {
        $id_recipe = $_POST['recette'];
        $sqlQuery = "SELECT * FROM recette WHERE id_recette = :id_recette";
        $recipesStatement = $mysqlClient->prepare($sqlQuery);
        $recipesStatement->execute(["id_recette" => $id_recipe]);
        $recipe = $recipesStatement->fetch();

        if ($recipe) {
            echo "<h2>Détails de la recette</h2>";
            echo "<p>Nom de la recette: " . htmlspecialchars($recipe['nomRecette']) . "</p>";
            echo "<p>Instructions: " . nl2br(htmlspecialchars($recipe['instructions'])) . "</p>";
        } else {
            echo "Recette non trouvée.";
        }
    }
} else {
    echo "Formulaire non soumis.";
}
