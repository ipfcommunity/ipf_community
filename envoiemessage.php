<?php

//recuperation des donnees
session_start();

try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

    	$_SESSION['envoimessage_erreur'] = $erreur1 =NULL;
    
// requéte pour optenir l'id maximum
    $requete_id = "select MAX(ID_MESSAGE) as id_max from MESSAGE";
    $reponse_id = $bdd->query($requete_id);
    $donnee_id = $reponse_id->fetch(PDO::FETCH_ASSOC);
    $id_message = $donnee_id['id_max'] + 1;

//optenir la date
    $requete_date = "select NOW() as date";
    $reponse_date = $bdd->query($requete_date);
    $donnee_date = $reponse_date->fetch(PDO::FETCH_ASSOC);
    $date_message = $donnee_date['date'];

//preparation des donnees du formulaire
    //expediteur
    $id_expediteur = $_SESSION['id'];
    //message
	
	// Sécurité contre les injections SQL
	if (get_magic_quotes_gpc()) {
    $message= stripslashes(nl2br($_POST['message']));
} else {
    $message = nl2br($_POST['message']);
}

 
	
	
    
if (get_magic_quotes_gpc()) {
    $destinataires= stripslashes($_POST['destinataire']);
} else {
    $destinataires = $_POST['destinataire'];
}



        
        $test_dest = substr($destinataires, -1);
        if ($test_dest != ";")
        {
            $destinataires = $destinataires.";";
        }
 // Fin sécurité contre les injections SQL   

 
//decoupage de la chaine des destinataire
    $destinataire = explode(";", $destinataires );
    $count = 0;

//boucle pour tester chaque destinataire
    while (!empty($destinataire[$count])) {


//test sur les groupes de diffusions
// groupe en fonction de general
        if ($destinataire[$count] == "general") {//test sur le groupe de diffusion general (numero: 1)
            $requete_general = "select ID_USER from IPF_USER where ID_USER != '$id_expediteur'";
            $reponse_general = $bdd->query($requete_general);
            while ($donnees_general = $reponse_general->fetch()) {
                $destinataire_final = $donnees_general['ID_USER'];
                
                
                //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
            }
       //fonction envoie mail automatique
         //   $requete_general_mail = "select MAIL_PERSO from ELEVE where GENERALE  = 1";
         //  $reponse_general_mail = $bdd->query($requete_general_mail);
         //   while ($donnees_general_mail = $reponse_general_mail->fetch()) {
         //          
         //   }
            
            
            // groupe en fonction de eleve de la classe                
        } elseif ($destinataire[$count] == "eleve" && $_SESSION['level'] == 2) { // test sur le groupe eleve ce qui donne accés a la classe (numero : 2)
            $classe_eleve = $_SESSION['idclasse'];
            $requete_eleve = "select ID_USER from ELEVE where ID_CLASSE = '$classe_eleve' and ID_USER != '$id_expediteur'";
            $reponse_eleve = $bdd->query($requete_eleve);
            while ($donnees_eleve = $reponse_eleve->fetch()) {

                $destinataire_final = $donnees_eleve['ID_USER'];
                
                
                
                 //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
            }
    
//groupe en fonction du professeur        
    } elseif ($destinataire[$count] == "professeur") { // test sur le groupe professeur ce qui donne accés au professeur de la classe (numero : 3)
                        //pour les eleve qui écrive a leurs PROFESSEURs
                        if ($_SESSION['level'] == 2) {// test eleve
                                    $classe_prof_eleve = $_SESSION['idclasse'];
                                    $requete_prof_eleve = "select ID_USER from ENSEIGNE where ID_CLASSE = '$classe_prof_eleve' and ID_USER != '$id_expediteur'";
                                    $reponse_prof_eleve = $bdd->query($requete_prof_eleve);
                                    while ($donnees_prof_eleve = $reponse_prof_eleve->fetch()) {

                                        $destinataire_final = $donnees_prof_eleve['ID_USER'];
                                        
                                        
                  //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
                            }
                            // pour les autres(professeur, adminsitration,administrateur que les eléves au professeur
                        }
                        else{

                                    $requete_prof = "select ID_USER from ENSEIGNE where ID_USER != '$id_expediteur'";
                                    $reponse_prof = $bdd->query($requete_prof);
                                    while ($donnees_prof = $reponse_prof->fetch()) {

                                        $destinataire_final = $donnees_prof['ID_USER'];
                                         //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
                            }
                // groupe de diffusion a l'administration
                        }
    } elseif ($destinataire[$count] == "administration") {// test sur le groupe administration ce qui donne accés a l'administration (numero : 4)
        $requete_prof = "select ID_USER from ADMINISTRATION where ID_USER != '$id_expediteur'";
        $reponse_prof = $bdd->query($requete_prof);
        while ($donnees_prof = $reponse_prof->fetch()) {

            $destinataire_final = $donnees_prof['ID_USER'];
             //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
        }
    } else {
     
        // envoyer a un utilisateur nommé          
//decoupage nom prenom du destinataire
        $destinataire_decomposition = explode(" ", $destinataire[$count], 2);

// recherche du destinataire dans la table IPF_USER           
        $requete_test_destinataire1 = "select ID_USER from IPF_USER where
                NOM_USER='$destinataire_decomposition[0]' and PRENOM_USER = '$destinataire_decomposition[1]' and ID_USER != '$id_expediteur'";
        $reponse_test_destinataire1 = $bdd->query($requete_test_destinataire1);
        $donnee_test_destinataire1 = $reponse_test_destinataire1->fetch(PDO::FETCH_ASSOC);

        $requete_test_destinataire2 = "select ID_USER from IPF_USER where
                NOM_USER='$destinataire_decomposition[1]' and PRENOM_USER = '$destinataire_decomposition[0]' and ID_USER != '$id_expediteur'";
        $reponse_test_destinataire2 = $bdd->query($requete_test_destinataire2);
        $donnee_test_destinataire2 = $reponse_test_destinataire2->fetch(PDO::FETCH_ASSOC);

//test sur l'existance du destinataire
        if ($donnee_test_destinataire1['ID_USER'] != FALSE) {
//insertion utilisateur
            $destinataire_final = $donnee_test_destinataire1['ID_USER'];
             //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));

        } elseif ($donnee_test_destinataire2['ID_USER'] != FALSE) {

            $destinataire_final = $donnee_test_destinataire2['ID_USER'];
             //insertion du message          
                 $requete_insert_message = " insert into MESSAGE values(:DATE_ENVOIE,:ID_USER, :ID_USER_DEST,:ID_MESSAGE,:CONTENU)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'DATE_ENVOIE' => $date_message,
                        'ID_USER' => $id_expediteur,
                        'ID_USER_DEST' => $destinataire_final,
                        'ID_MESSAGE' => $id_message,
                        'CONTENU' => $message));
        } else {
            $erreur1 = 1;
//supression du message si il y a un utilistaeur qui n'existe pas.

            $bdd->query("delete from MESSAGE where ID_MESSAGE = " . $id_message);
        }// fin if user
    }// fin de si groupe de difussion

    $count++;
    }//fin while
 //fin try
}catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$_SESSION['envoimessage_erreur'] = $erreur1;
header('location: acceuil.php');


// groupe en fonction du nom de la classe        
//       $requete_classe_test = "select ID_CLASSE,NOM_CLASSE from CLASSE";
//     $reponse_classe_test = $bdd->query($requete_classe_test);
//   while ($donnees_classe_test = $reponse_classe_test->fetch()) { 
//            elseif ($destinataire[$count] == $donnees_classe_test['NOM_CLASSE']) {
//            $classe_eleve = $donnees_classe_test['ID_CLASSE'];
//            $requete_eleve = "select ID_USER from ELEVE where ID_CLASSE = '$classe_eleve' and ID_USER != '$id_expediteur'";
//            $reponse_eleve = $bdd->query($requete_eleve);
//            while ($donnees_eleve = $reponse_eleve->fetch()) {
//
//                $destinataire_final = $donnees_eleve['ID_USER'];
//                include("insertion_message.php");
//            }
//        }
//        }
?>  
        
      
        
        