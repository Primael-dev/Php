<?php 
try {
    $bdd = new PDO('mysql:host=localhost;dbname=tasks;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}
if( isset($_GET["id"]) )
{
    if(!empty($_GET["id"]))
    {
        $id = strip_tags($_GET["id"]);
        $req = $bdd->prepare("DELETE FROM Users WHERE id=:id");
        $stmt = $req->execute(['id'=> $id]);
        
        $email = $_GET['email'];
        if($stmt)
        {
            header("Location: ../users.php?email=$email");
        }
        else{
            echo "Erreur!";
        }
    }else{
        header("Location: ../users.php?email=$email");
    }
}else{
    header("Location: ../users.php?email=$email");
}
?>