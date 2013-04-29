<?php

try {
//connection a la base.
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
    
    $user_destinataire = $_SESSION['id'];
    
    $count =0;
//donnée sur la date actuelle
    $requete_curdate = "select year(curdate()) as year_cur, month(curdate()) as month_cur, day(curdate()) as day_cur";
    $reponse_curdate = $bdd->query($requete_curdate);
    $donnee_curdate = $reponse_curdate->fetch(PDO::FETCH_ASSOC);
    
    $administrateur = $_SESSION['level'];
    //requete sql pour optenir les messages
        $requete_message = "select ID_MESSAGE,ID_USER,
                year(DATE_ENVOIE) as annee_mes, 
                month(DATE_ENVOIE) as mois_mes, 
                day(DATE_ENVOIE) as jour_mes,
                hour(DATE_ENVOIE) as heure_mes,
                MINUTE(DATE_ENVOIE) as minute_mes,
                CONTENU
                from message 
                where ID_USER_DEST = '$user_destinataire' or ID_USER = '$user_destinataire' or '$administrateur' = 1 group by ID_MESSAGE order by DATE_ENVOIE DESC";
        $reponse_message = $bdd->query($requete_message);
        while ($donnees_message = $reponse_message->fetch() and $count < 30) {
            
            //mise en forme de la date
        if ($donnees_message['annee_mes'] == $donnee_curdate['year_cur'] and $donnees_message['mois_mes'] == $donnee_curdate['month_cur'] 
                and $donnees_message['jour_mes'] == $donnee_curdate['day_cur']) {

            $date = $donnees_message['heure_mes'] . "h" . $donnees_message['minute_mes'];
        } else {
            $date = $donnees_message['jour_mes'] . "/" . $donnees_message['mois_mes'] . "/" . $donnees_message['annee_mes'];
        }
//requéte sql pour connaitre le nom de l'expediteur et son niveau.                
        $id_expediteur = $donnees_message['ID_USER'];
        $requete_expediteur = "select concat(PRENOM_USER,' ',NOM_USER) as nom, NB_LEVEL from IPF_USER where ID_USER ='$id_expediteur'";
        $reponse_expediteur = $bdd->query($requete_expediteur);
        $reponse_exp = $reponse_expediteur->fetch(PDO::FETCH_ASSOC);

// test pour connaitre le niveau de droit de l'expediteur.                                        
        $level = "test";
        switch ($reponse_exp['NB_LEVEL']) {
            case 1 : $level = "<img src='image/administrateur.png' alt='Administrateur' /><br>";
                break;
            case 2 : $level = "<img src='image/etudiant.png' alt='Eleve' /><br>";
                break;
            case 3 : $level = "<img src='image/prof.png' alt='PROFESSEUR' /><br>";
                break;
            case 4 : $level = "<img src='image/administration.png' alt='Administration' /><br>";
                break;
            default: echo'erreur';
                break;
        }// fin switch
        
        //écriture du message.                                        
        echo "<div id='message'><div id = 'coordonnee_message'>" . $reponse_exp['nom'] . " > ";

        $id_message = $donnees_message['ID_MESSAGE'];
        $requete_destinataire2 = "select ID_USER_DEST from MESSAGE where id_message = '$id_message'";
        $reponse_destinataire2 = $bdd->query($requete_destinataire2);

        while ($donnees_destinataire2 = $reponse_destinataire2->fetch()) {
//test avant ecriture des destinataire
            
                $destinataire_id = $donnees_destinataire2['ID_USER_DEST'];
                $requete_destina = "select concat(PRENOM_USER,' ',NOM_USER) as nom from IPF_USER where ID_USER ='$destinataire_id'";
                $reponse_destina = $bdd->query($requete_destina);
                $reponse_nom = $reponse_destina->fetch(PDO::FETCH_ASSOC);
                echo $reponse_nom['nom'] . ", ";
            
        }//fin while
        
                $requete_nbcom= "select count(ID_COM) as count from COMMENTAIRE where ID_MESSAGE = '$id_message'";
                $reponse_nbcom = $bdd->query($requete_nbcom);
                $reponse_nbcom2 = $reponse_nbcom->fetch(PDO::FETCH_ASSOC);
                $nb_com = $reponse_nbcom2['count'];
               
        
              echo"<div id ='date_message'>"; 
 //bouton de supression
                if ($id_expediteur == $_SESSION['id'] or $_SESSION['level']==1) {
    

                                echo " <form method='post' action='bloc_php/supprimer_message.php' id='supprimer'>
                                        <input type='hidden' name='id_message' value='$id_message' />
                                        <input id='bouton_cour' type='submit' name='submit' value='Supprimer' />
                                        </form>";
              
                }
              
              
              echo $date . "</div></div>";
        echo "<div id = 'image_message'>" . $level . "</div>";
        echo "<div id = 'contenu_message'> " . nl2br($donnees_message['CONTENU']) . "</div><div id = 'commentaire_message'>
            <a href='javascript:return(true)' onclick='javascript:deplie(\"$id_message\")' id='commentaire_message_a'>Commentaire ( $nb_com )</a>
                <div id='$id_message'style='height: 0px; overflow:hidden; line-height: 0px'><br>";
        
        
//afficher les commentaires
        $requete_commentaire = "select ID_USER,DATE_ENVOIE,CONTENU_COMMENTAIRE,ID_COM,
                                        year(DATE_ENVOIE) as annee_com, 
                                        month(DATE_ENVOIE) as mois_com, 
                                        day(DATE_ENVOIE) as jour_com,
                                        hour(DATE_ENVOIE) as heure_com,
                                        MINUTE(DATE_ENVOIE) as minute_com
                                        from COMMENTAIRE where ID_MESSAGE = '$id_message' order by DATE_ENVOIE ASC";
        $reponse_commentaire = $bdd->query($requete_commentaire);
        while ($donnees_commentaire = $reponse_commentaire->fetch()) {
            
          //mise en forme de la date
        if ($donnees_commentaire['annee_com'] == $donnee_curdate['year_cur'] and $donnees_commentaire['mois_com'] == $donnee_curdate['month_cur'] 
                and $donnees_commentaire['jour_com'] == $donnee_curdate['day_cur']) {

            $date_com = $donnees_commentaire['heure_com'] . "h" . $donnees_commentaire['minute_com'];
        } else {
            $date_com = $donnees_commentaire['jour_com'] . "/" . $donnees_commentaire['mois_com'] . "/" . $donnees_commentaire['annee_com'];
        }// fin if
        // format expediteur
        $id_expediteur_com = $donnees_commentaire['ID_USER'];
        $requete_expediteur_com = "select concat(PRENOM_USER,' ',NOM_USER) as nom, NB_LEVEL from IPF_USER where ID_USER ='$id_expediteur_com'";
        $reponse_expediteur_com = $bdd->query($requete_expediteur_com);
        $reponse_exp_com = $reponse_expediteur_com->fetch(PDO::FETCH_ASSOC);
        
        //message
        $message_com = nl2br($donnees_commentaire['CONTENU_COMMENTAIRE']);
         $id_commentaire = $donnees_commentaire['ID_COM'];
        echo "<div id='commentaire'><div id='coordonnee_commentaire'>".$reponse_exp_com['nom']."<div id='date_commentaire'>";
        
//suprimé commentaire        
        if ($id_expediteur_com == $_SESSION['id'] or $_SESSION['level']==1) {
                               

                                echo " <form method='post' action='bloc_php/supprimer_commentaire.php' id='supprimer'>
                                        <input type='hidden' name='id_commentaire' value='$id_commentaire' />
                                        <input id='bouton_cour' type='submit' name='submit' value='Supprimer' />
                                        </form>";
              
                }
        
        echo  $date_com.
                "</div></div><div id='message_com'>".$message_com."</div></div>";
        
            
        }// fin while commantaire
        
        
       echo "<form action='envoiecommentaire.php' method='post'>
                <textarea name='commentaire'id='commentaire_message_textarea'></textarea>
                <input type='hidden' name='id_message' value='$id_message'/>
                <input type='submit' name='envoyer' value='Envoyer' />
                <input type='reset' name='annuler' value='Annuler' /><br>&nbsp;
                
            </form>
                </div></div></div>";
        $count++;    
        }// fin while message
    echo "<div id='vide_message'>&nbsp;</div>";
    }//fin try
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>