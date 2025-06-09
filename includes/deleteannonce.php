<?php 
require_once 'vericonnect.php';

if (isset($_GET["id"])) {
    if (!empty($_GET["id"])) {
        $id = strip_tags($_GET["id"]);
        try {
            $req = $bdd->prepare("DELETE FROM annonces WHERE id=:id");
            $stmt = $req->execute(['id' => $id]);
            if ($stmt) {
                header("Location: ../affichageannonce.php");
                exit();
            } else {
                echo "Erreur lors de la suppression !";
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
}
?>