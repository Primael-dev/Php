<?php
try {
 $bdd = new PDO('mysql:host=localhost;dbname=tasks;charset=utf8',
'root', '');
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo "Erreur de connexion : " . $e->getMessage();
}


if (
    isset($_POST["floating_first_name"]) &&
    isset($_POST["floating_last_name"]) &&
    isset($_POST["floating_email"]) &&
    isset($_POST["floating_password"]) &&
    isset($_POST["repeat_password"])
) {
    if ($_POST["floating_password"] != $_POST["repeat_password"]) {
        echo "<p>Erreur : les mots de passe ne correspondent pas !</p><a href='../register.php'>Retour</a>";
        exit();
    }

    $nom = strip_tags($_POST["floating_first_name"]);
    $prenom = strip_tags($_POST["floating_last_name"]);
    $email = strip_tags($_POST["floating_email"]);
    $mot_de_passe = password_hash($_POST['floating_password'], PASSWORD_DEFAULT);
    $date = date("Y-m-d");

    try {
        $req = $bdd->prepare("INSERT INTO Users(nom, prenom, email, mot_de_passe, date) VALUES(:nom, :prenom, :email, :mot_de_passe, :date)");
        $req->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "mot_de_passe" => $mot_de_passe,
            "date" => $date
        ]);

        header("Location: ../users.php?email=$email");
        exit();
    } catch (PDOException $e) {
        echo "Erreur BDD : " . $e->getMessage();
        exit();
    }
} else {
    header("Location: ../users.php");
    exit();
}
