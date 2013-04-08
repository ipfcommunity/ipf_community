<?php
session_start();
try {

$_SESSION['changement_pwd'] = $changement_pwd=NULL;

$new_pass=$_POST["NewPwd"];
$new_pass_conf=$_POST["ConfirmPwd"];
$pass_old=$_POST["OldPwd"];

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);


// on compare si le nouveau passe correspond à la confirmation
if ($new_pass == $new_pass_conf)
{  
    $login = $_SESSION['id'] ;
    $requete_pwdactu = "SELECT mdp FROM ipf_user WHERE id_user = ' $login '";
    $reponse_pwdactu = $bdd->query($requete_pwdactu);
    $donnee_pwdactu = $reponse_pwdactu->fetch(PDO::FETCH_ASSOC);
    
         $requete_pwdold = "SELECT md5('$pass_old') as old";
         $reponse_pwdold = $bdd->query($requete_pwdold);
         $donnee_pwdold = $reponse_pwdold->fetch(PDO::FETCH_ASSOC);
      //on vérifie si les anciens mots de passe sont identique
    if ($donnee_pwdactu['mdp'] == $donnee_pwdold['old'])
    {
         
        //si oui on update le nouveau mot de passe dans la bdd
   $bdd->exec("update ipf_user SET MDP = password('$new_pass') WHERE id_user=' $login ' ");
             
        echo "mot de passe change cher $login "; 
    }
    else
    {
        echo "Ancien mot de passe non valide";
    }
}
else
{
    echo "Mot de passe de confirmation incorrect";
}

}



catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
flush();
?>