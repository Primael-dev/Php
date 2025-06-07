<?php 

try {
 $bdd = new PDO('mysql:host=localhost;dbname=tasks;charset=utf8',
'root', '');
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo "Erreur de connexion : " . $e->getMessage();
}

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
            $req = $bdd->prepare("SELECT * FROM Users WHERE email = :email");
            $req->execute(['email' => $email]);
            $user = $req->fetch(PDO::FETCH_ASSOC);
            
            //si user n'existe pas
            if( !$user )
            {
                echo $error;
                header("Location: ../connexion.php");
            }else{
                //user existe - ok, verifions mot de passe :
                $est_mdpasse_vrai = password_verify( $password, $user["mot_de_passe"]);

                if( $est_mdpasse_vrai == true )
                {
                    header("Location: ../users.php?email=$email");
                }else{ echo $error; header("Location: ../connexion.php");
                     
                } 

            }
        }catch(PDOException $e){
            echo "<script>alert(\"".$e->getMessage()."\")</script>";
        }

    }else echo "Erreur lors du login! ressayer plustard!";

}else header("Location: ../connexion.php");

?>