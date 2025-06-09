<?php
session_start(); // Corrigé ici
require_once('vericonnect.php');

if (isset($_POST['floating_email']) && isset($_POST['floating_password'])) {
    if (!empty($_POST['email'])) {
        $email = strip_tags($_POST['floating_email']);
        $mot_de_passe = $_POST['floating_password'];

        // Correction de la requête SQL
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe (vérifie bien que le champ s'appelle "password")=
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $user["email"];
            header("Location: affichageannonce.php");
            exit(); // Toujours sécuriser avec exit après un header
        } else {
            echo "Identifiants invalides !";
        }
    }
}
?>
