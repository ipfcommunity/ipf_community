<?php
session_start();
//connection a la base.
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
$id_message_supprimer = $_POST['id_message'];    
//supression des commentaires
    
 $bdd->query("delete from commentaire where ID_MESSAGE = " . $id_message_supprimer);   
    
// supression du message    

$bdd->query("delete from MESSAGE where ID_MESSAGE = " . $id_message_supprimer);
header('location: /lesiteprojectcamille/acceuil.php');
?>
