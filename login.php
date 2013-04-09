<?php

// fonction

function faire_Session($id, $level, $nom, $prenom, $mail,$classe,$idclasse, $login, $pwd) {
 

    $_SESSION['id'] = $id;
    $_SESSION['level'] = $level;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['mail'] = $mail;
    $_SESSION['classe'] = $classe;
    $_SESSION['idclasse'] = $idclasse;
    $_SESSION['login'] = $login;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['partage_erreur_cour']= NULL;
    $_SESSION['partage_erreur']= NULL;
    $_SESSION['envoimessage_erreur']= NULL; 
    header('location: acceuil.php');
}

// main

try {
    session_start();
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], 'generique', 'iris', $pdo_options);
    
    $_SESSION['erreur_connexion'] = null;
	
//Requête de sécurité contre les injections SQL
	if (get_magic_quotes_gpc()) {
    $test_mail= stripslashes($_POST['E-mail']);
} else {
    $test_mail = $_POST['E-mail'];
}

    $test_mail=mysql_real_escape_string($test_mail);
	
	if (get_magic_quotes_gpc()) {
    $test_pwd= stripslashes($_POST['password']);
} else {
    $test_pwd = $_POST['password'];
}

    $test_pwd=mysql_real_escape_string($test_pwd);
   
 // Fin requête sécurité contre les injections SQL  
   
   
   
    $classe = "";
    
    $requetemd5 = "select md5('$test_pwd') as pwd";
    $reponsemd5 = $bdd->query($requetemd5);
    $donneemd5 = $reponsemd5 ->fetch(PDO::FETCH_ASSOC);
    
    
    $requete = "select * from IPF_USER where mail_ecole ='$test_mail'";
    $reponse1 = $bdd->query($requete);
    $reponse = $reponse1 ->fetch(PDO::FETCH_ASSOC);
    

    if ($reponse['MDP'] == $donneemd5['pwd']) {
        switch ($reponse['NB_LEVEL']) {
            case 1:
                if($reponse['NB_LEVEL'] == 1)
                {
                    $classe = 'Administrateur';
                }
                faire_Session($reponse['ID_USER'], $reponse['NB_LEVEL'], $reponse['NOM_USER'],
                        $reponse['PRENOM_USER'], $reponse['MAIL_ECOLE'], $classe,'NULL',
                        'administrateur', 'iris');
                break;
                
            case 2: $id_user = $reponse['ID_USER'];
                if ($reponse['NB_LEVEL'] == 2)
                        {
                            $requete = "select NOM_CLASSE,ID_CLASSE from classe 
                                        where  ID_CLASSE = ( select ID_CLASSE from eleve where ID_USER = '$id_user' )";
                            $reponse1 = $bdd->query($requete);
                            $reponse2 = $reponse1 ->fetch(PDO::FETCH_ASSOC);
                            $classe = $reponse2['NOM_CLASSE'];
                            $idclasse = $reponse2['ID_CLASSE'];
                          }
                faire_Session($id_user, $reponse['NB_LEVEL'], $reponse['NOM_USER'],
                                $reponse['PRENOM_USER'], $reponse['MAIL_ECOLE'],$classe,$idclasse, 'eleve', 'iris');
                $requete = " select MAIL_PERSO from eleve where ID_USER = '$id_user' ";
                            $reponse1 = $bdd->query($requete);
                            $reponse2 = $reponse1 ->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['mail_perso'] = $reponse2['MAIL_PERSO'];
                break;
                
            case 3: 
                if($reponse['NB_LEVEL'] == 3)
                {
                    $classe = 'Professeur';
                }
                faire_Session($reponse['ID_USER'], $reponse['NB_LEVEL'], $reponse['NOM_USER'],
                                $reponse['PRENOM_USER'], $reponse['MAIL_ECOLE'], $classe,'NULL', 'professeur', 'iris');
                break;
                
            case 4:
                if($reponse['NB_LEVEL'] == 4)
                {
                    $classe = 'ADMINISTRATION';
                }
                faire_Session($reponse['ID_USER'], $reponse['NB_LEVEL'], $reponse['NOM_USER'],
                                $reponse['PRENOM_USER'], $reponse['MAIL_ECOLE'], $classe, 'NULL','ADMINISTRATION', 'iris');
                break;
                
            default: break;
            
        }
    } 
    else {
       $_SESSION['erreur_connexion'] = 1;
        header('location: connexion.php');
    }
}//fin try
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
