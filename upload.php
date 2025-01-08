<?php
// Inclure la configuration
require_once 'config.php';

// Vérifier si un fichier a été uploadé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Vérifier s'il y a des erreurs dans l'upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Obtenir le nom du fichier et générer un chemin unique
        $filename = basename($file['name']);
        $uniqueName = uniqid() . '_' . $filename;
        $targetPath = UPLOAD_DIR . $uniqueName;

        // Déplacer le fichier vers le dossier d'uploads
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Générer le lien de téléchargement
            $downloadLink = BASE_URL . $uniqueName;
            echo $downloadLink;
        } else {
            echo "Erreur : Impossible de déplacer le fichier.";
        }
    } else {
        echo "Erreur : Problème lors de l'upload.";
    }
} else {
    echo "Erreur : Aucun fichier uploadé.";
}
?>
