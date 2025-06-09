<?php 


require_once 'vericonnect.php';

//message d'erreur a mettre si email ou mot de passe n'est pas correct
$error = "mot de passe ou email n'est pas correct!";

//echo("hey");  operation de test

if( isset($_POST["floating_email"]) && isset($_POST["floating_password"] ) )
{
    if( !empty($_POST["floating_email"]) && !empty($_POST["floating_password"]) )
    {
        $email = strip_tags($_POST["floating_email"]);
        $password = $_POST["floating_password"];

        try
        {
            $req = $bdd->prepare("SELECT * FROM users WHERE email = :email");
            $req->execute(['email' => $email]);
            $user = $req->fetch(PDO::FETCH_ASSOC);
            
            //si user n'existe pas
            if( !$user )
            {
                header("Location: ../connexion.php?message=" . urlencode($error));
                exit();
            }else{
                //user existe - ok, verifions mot de passe :
                $est_mdpasse_vrai = password_verify( $password, $user["mot_de_passe"]);

                if( $est_mdpasse_vrai == true )
                {
                    header("Location: ../users.php?email=$email");
                    exit();
                }else{
                    header("Location: ../connexion.php?message=" . urlencode($error));
                    exit();
                }
            }
        }catch(PDOException $e){
            header("Location: ../connexion.php?message=" . urlencode("Erreur serveur : " . $e->getMessage()));
            exit();
        }

    }else{
        header("Location: ../connexion.php?message=" . urlencode("Erreur lors du login! ressayer plustard!"));
        exit();
    }
}else{
    header("Location: ../affichageannonce.php");
    exit();
}
?>