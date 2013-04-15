<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>IPF Community - Paramètre</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("bloc_php/appel_css.php"); ?>	

    </head>

    <body onload="var timer = setInterval('horloge()', 1000)">
        <?php include("bloc_php/menu.php"); ?>
        <div id="parametre">
            
            <div id="identiter">
                <h3>Param&#232;tre du compte:</h3></br><!--modifier par camille le 21/11/2012-->
                <br>
                    <b>Nom d'utilisateur: </b><?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . ' ' ?> <br>
                        <b>Adresse mail: </b><?php echo $_SESSION['mail'] ?> <br>
                            <?php
                            if ($_SESSION['level'] == 2) {
                                echo "<b> Adresse mail personnelle: </b>" . $_SESSION['mail_perso'] . " <br>";
                            }
                            ?>
                            <b>Classe: </b><?php echo $_SESSION['classe']; ?><br>
                                </div>
                                <div id="parametre_form">
                                    <form method="post" action="mail_groupe.php">
                                        
<?php

if ($_SESSION['level'] == 2) {
    echo "<h3>News letter:</h3><br>";
    echo "<b> Votre mail est: </b>" . $_SESSION['mail_perso'] . " <br>";
    echo ' <p>Ajouter votre adresse personnelle si vous voulez recevoir les messages des groupes que vous cochez:</p>
                                                    <p>				
                                                        <input type="checkbox" name="GENERALE" value="1" />G&#233;n&#233;ral 
                                                        <input type="checkbox" name="PROFESSEUR" value="1" />Professeur 
                                                        <input type="checkbox" name="ADMINISTRATION" value="1" />Administration 
                                                        <input type="checkbox" name="ELEVE" value="1" />El&#233;ves 
                                                        
                                                    </p><br>
                                                        <b>Votre e-mail personnel: </b><input type="email" name="email_perso" /><br>
                                                            <input type="submit" name="form_email" />
                                                            </form><br>';
}
?>   
                                            <form method="post" action="changement_pwd.php">
                                                <h3>Changer de mot de passe:</h3><br>
                                                    <input type="password" name="OldPwd" /><b>Ancien mot de passe</b><br>
                                                        <input type="password" name="NewPwd" /><b>Nouveau mot de passe</b><br>		
                                                            <input type="password" name="ConfirmPwd" /><b>Confirm&#233;</b><br>			
                                                                <input type="reset" name="Annulé" /><input type="submit" name="Confirmé" />		
                                                                </form>
                                                                </div>
                                                                </div>
                                                                <div id="monhorloge"> &nbsp; </div>
<?php include("bloc_php/mention_legal.php"); ?>
                                                                </body>

                                                                </html>
                                                                <!--Ce document a été réaliser en octobre 2012. 
                                                                Dans le cadre d'un projet dans l'école iris, 
                                                                par camille pire, maxime maréchal et jean-marie pujade.-->
