<?php
    session_start();
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
   
    $generale = TRUE;
    $administration = TRUE;
    $professeur = TRUE;
    $eleve = TRUE;
    $mail_perso = $_POST['email_perso'];
    $id = $_SESSION['id'];
    
    if($_POST['GENERALE'] == NULL)
    {
        $generale = FALSE;
    }
    if($_POST['ADMINISTRATION'] == NULL)
    {
        $administration = FALSE;
    }
    if($_POST['PROFESSEUR']== NULL)
    {
        $professeur = FALSE;
    }
    if($_POST['ELEVE']== NULL)
    {
        $eleve = FALSE;
    }
    
    if($mail_perso != NULL)
    {
     $requete_update = " UPDATE ELEVE SET MAIL_PERSO= :MAIL_PERSO WHERE ID_USER = :ID";
                            $reponse_update = $bdd->prepare($requete_update);
                            $update = $reponse_update -> execute(array(
                                'MAIL_PERSO' => $mail_perso,
                                'ID' => $id));       
    }
        $requete_update = " UPDATE ELEVE SET GENERALE= :GENERAL , ADMINISTRATION = :ADMINISTRATION, PROFESSEUR = :PROF, ELEVE = :ELEVE WHERE ID_USER = :ID";
                            $reponse_update = $bdd->prepare($requete_update);
                            $update = $reponse_update -> execute(array(
                                'GENERAL' => $generale,
                                'ADMINISTRATION' => $administration,
                                'PROF' => $professeur,
                                'ELEVE' => $eleve,
                                'ID' => $id)); 

    
    header('location: parametre.php');
?>
