



<?php

function agenda($jour) {


    if ($_SESSION['level'] == 2) {
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);


            //requete pour avoir les id et la date de l'evenement
            $sql_agenda = " select ID_EVENEMENT,ID_USER,HOUR(DATE_DEBUT) as heure_evenement, MINUTE(DATE_DEBUT) as minute_evenement from agenda 
                            where day(DATE_DEBUT)= day(CURDATE()+INTERVAL ".$jour." DAY) 
                            and month(DATE_DEBUT) = month(CURDATE()+INTERVAL ".$jour." DAY) 
                            and year(DATE_DEBUT) = year(CURDATE()+INTERVAL ".$jour." DAY) 
                            and ID_CLASSE = " . $_SESSION['idclasse'] . "";
            $reponse_agenda = $bdd->query($sql_agenda);
            
            echo "<table id='acceuil_agenda'>";
            
            while ($donnees_agenda = $reponse_agenda->fetch()) {
                //requete pour avoir le titre et la description de l'événement
                $sql_evenement = "select TITRE , DESCRIPTION from EVENEMENT where ID_EVENEMENT =" . $donnees_agenda['ID_EVENEMENT'];
                $reponse_evenement = $bdd->query($sql_evenement);
                $donnees_evenement = $reponse_evenement->fetch(PDO::FETCH_ASSOC);

                //requete pour avoir le nom du professeur
                $requete_nom = "select concat(PRENOM_USER,' ',NOM_USER) as nom from IPF_USER where ID_USER = " . $donnees_agenda['ID_USER'];
                $reponse_nom = $bdd->query($requete_nom);
                $donnees_nom = $reponse_nom->fetch(PDO::FETCH_ASSOC);

                echo "<tr>
                        <td>". $donnees_agenda['heure_evenement'] . "h" . $donnees_agenda['minute_evenement'] ."</td>
                        <td>" . $donnees_evenement['TITRE'] . "</td>
                        <td>" . $donnees_nom['nom'] . "</td>
                      </tr>";
            }
            
            echo "</table>";
            
        }//fin try
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }//fin if
    elseif ($_SESSION['level'] == 3) {
    
           try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);


            //requete pour avoir les id et la date de l'evenement
            $sql_agenda = " select ID_EVENEMENT,ID_CLASSE,HOUR(DATE_DEBUT) as heure_evenement, MINUTE(DATE_DEBUT) as minute_evenement from agenda 
                            where day(DATE_DEBUT)= day(CURDATE()+INTERVAL ".$jour." DAY) 
                            and month(DATE_DEBUT) = month(CURDATE()+INTERVAL ".$jour." DAY) 
                            and year(DATE_DEBUT) = year(CURDATE()+INTERVAL ".$jour." DAY) 
                            and ID_USER = " . $_SESSION['id'] . "";
            $reponse_agenda = $bdd->query($sql_agenda);
            
            echo "<table id='acceuil_agenda'>";
            
            while ($donnees_agenda = $reponse_agenda->fetch()) {
                //requete pour avoir le titre et la description de l'événement
                $sql_evenement = "select TITRE , DESCRIPTION from EVENEMENT where ID_EVENEMENT =" . $donnees_agenda['ID_EVENEMENT'];
                $reponse_evenement = $bdd->query($sql_evenement);
                $donnees_evenement = $reponse_evenement->fetch(PDO::FETCH_ASSOC);

                //requete pour avoir le nom du professeur
                $requete_nom = "select NOM_CLASSE as nom from CLASSE where ID_CLASSE = " . $donnees_agenda['ID_CLASSE'];
                $reponse_nom = $bdd->query($requete_nom);
                $donnees_nom = $reponse_nom->fetch(PDO::FETCH_ASSOC);

                echo "<tr>
                        <td>". $donnees_agenda['heure_evenement'] . "h" . $donnees_agenda['minute_evenement'] ."</td>
                        <td>" . $donnees_evenement['TITRE'] . "</td>
                        <td>" . $donnees_nom['nom'] . "</td>
                      </tr>";
            }
            
            echo "</table>";
            
        }//fin try
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
}//fin if
    
    
}
?>