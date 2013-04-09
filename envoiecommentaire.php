<?php
session_start();
try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

// requéte pour optenir l'id maximum
    $requete_id = "select MAX(ID_COM) as id_max from COMMENTAIRE";
    $reponse_id = $bdd->query($requete_id);
    $donnee_id = $reponse_id->fetch(PDO::FETCH_ASSOC);
    $id_commentaire = $donnee_id['id_max'] + 1;
    
//optenir la date
    $requete_date = "select NOW() as date";
    $reponse_date = $bdd->query($requete_date);
    $donnee_date = $reponse_date->fetch(PDO::FETCH_ASSOC);
    $date_commentaire = $donnee_date['date'];

//preparation des donnees du formulaire
    $expediteur = $_SESSION['id'];
	
// Sécurité contre les injections SQL
	
	if (get_magic_quotes_gpc()) {
    $commentaire= stripslashes($_POST['commentaire']);
} else {
    $commentaire = $_POST['commentaire'];
}

    $commentaire=mysql_real_escape_string($commentaire);
	
	
	if (get_magic_quotes_gpc()) {
    $id_message_commenter= stripslashes($_POST['id_message']);
} else {
   $id_message_commenter = $_POST['id_message'];
}

    $id_message_commenter=mysql_real_escape_string($id_message_commenter);

// Fin sécurité contre les injections SQL
    
     //insertion du message          
                 $requete_insert_com = " insert into COMMENTAIRE values(:ID_USER,:DATE_ENVOIE,:ID_COM,:ID_MESSAGE,:CONTENU_COMMENTAIRE)";
                 $reponse_insert_com = $bdd->prepare($requete_insert_com);
                 $insert_com = $reponse_insert_com -> execute(array(
                        'ID_USER' => $expediteur,
                        'DATE_ENVOIE' => $date_commentaire,
                        'ID_COM' => $id_commentaire,
                        'ID_MESSAGE' => $id_message_commenter,
                        'CONTENU_COMMENTAIRE' => $commentaire));
    
}//fin try
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

header('location: acceuil.php');
?>
