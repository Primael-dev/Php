<?php
require_once 'vericonnect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);

    // Si une nouvelle image a été envoyée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $fileInfo = pathinfo($_FILES['image']['name']);
        $ext = strtolower($fileInfo['extension']);

        if (in_array($ext, $allowed)) {
            $newName = uniqid('img_', true) . "." . $ext;
            $destination = 'uploads/' . $newName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                // Supprimer l'ancienne image
                $stmt = $bdd->prepare("SELECT image FROM annonces WHERE id = ?");
                $stmt->execute([$id]);
                $oldImage = $stmt->fetchColumn();

                if ($oldImage && file_exists('../uploads/' . $oldImage)) {
                    unlink('uploads/' . $oldImage);
                }

                // Mettre à jour avec la nouvelle image
                $stmt = $bdd->prepare("UPDATE annonces SET titre = ?, description = ?, image = ? WHERE id = ?");
                $stmt->execute([$titre, $description, $newName, $id]);

                header('Location: ../affichageannonce.php');
                exit();
            } else {
                echo "Erreur lors du téléchargement de la nouvelle image.";
            }
        } else {
            echo "Extension de fichier non autorisée.";
        }
    } else {
        // Aucune image changée : on ne met à jour que le texte
        $stmt = $bdd->prepare("UPDATE annonces SET titre = ?, description = ? WHERE id = ?");
        $stmt->execute([$titre, $description, $id]);

        header('Location: ../affichageannonce.php');
        exit();
    }
} else {
    echo "Requête non autorisée.";
}
?>
