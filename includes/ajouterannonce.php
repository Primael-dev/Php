<?php
require_once 'vericonnect.php';

// 1. Vérifie si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 2. Sécuriser les champs texte
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);

    // 3. Gérer l’image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $tmp = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // 4. Vérifie que l’extension est autorisée
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed)) {
            die("Extension non autorisée");
        }

        // 5. Génère un nom unique et le chemin de destination
        $newName = uniqid('img_', true) . '.' . $ext;
        $destination = 'uploads/' . $newName;

        // 6. Déplace le fichier
        if (!move_uploaded_file($tmp, $destination)) {
            die("Erreur lors de l'upload de l'image");
        }

        // 7. Insertion en base de données
        $sql = "INSERT INTO annonces (titre, description, image) VALUES (:titre, :description, :image)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':image' => $newName
        ]);

       header('Location: ../affichageannonce.php');
        exit();

    } else {
        echo "Aucune image reçue ou erreur d'upload.";
    }
}
?>
