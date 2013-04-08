<?php
session_start();
//connection a la base.
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
$id_commentaire_supprimer = $_POST['id_commentaire'];    
//supression des commentaires
    
 $bdd->query("delete from commentaire where ID_COM = " . $id_commentaire_supprimer);   
 header('location: /lesiteprojectcamille/acceuil.php');
?>
