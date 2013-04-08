<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>IPF Community - Acceuil</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("bloc_php/appel_css.php"); ?>

    </head>

    <!--paramétrage du body pour l'horloge javascript-->
    <body onload="var timer = setInterval('horloge()', 1000);">    
        <?php include("bloc_php/menu.php"); ?>

        <!-- Cette partie va chercher tout les fichiers partager dans la table vrac-->        
        
                <?php
                $erreur_envoi = $_SESSION['envoimessage_erreur'];
                if ($erreur_envoi == 1) {
                   echo"<SCRIPT type='text/javascript'>  alert('Destinataire incorrect');</script>";
                   $_SESSION['envoimessage_erreur'] = NULL;
                }
                
                
                if ($_SESSION['level'] == 2) {
                    try {
                        echo "<div id='menu_partage'>
            <h3>Fichier:</h3>	<br>";
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

                        $requete = "select * from vrac order by date_depot desc";
                        $reponse = $bdd->query($requete);
						$nombre = 0;
                        echo"<ul>";
                        while ($donnees = $reponse->fetch() and $nombre < 17) {
                            echo"<li><img src='image/point.png' />&nbsp;<a href='" . $donnees['LIEN_FICHIER'] .  "' id='a_partage' target='blank'>" . $donnees ['DESCRIPTION'] . "</a></li>";
                        $nombre ++;
						}
                        echo"</ul>        </div>
                        ";
                    }//fin try
                    catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                }
                ?>

        <!-- apelle de la function javascript de l'horloge-->
        <div id="monhorloge"> &nbsp; </div>

        <!--apelle de la function php qui affiche les messages-->
        <div id="corp_centre">
            <div id="mur_message">
                <?php include("affichermessage.php"); ?>
            </div>
            
            
            <!--le formulaire pour envoié des messages-->            
            <div id="envoie_message">
                <form name='envoyer'action="envoiemessage.php" method="post">
                    <div id="message_interieur">
                        <div id="div_destina">
                            <span>Choisir un groupe de diffusions:</span>
                            <span>   </span><span id="destina"> El&#232;ves</span>
                            <span>   </span><span id="destina"> Professeurs</span>
                            <span>   </span><span id="destina"> Administration</span>
                            <span>   </span><span id="destina"> G&#233;n&#233;ral</span><br>

                            <span onclick="" id="a_envoyer">A:</span>
                            <input type="text" name="destinataire" id="input_envoyer"/><br>
                        </div>
                        <div id="envoyer_bas">
                            <span>Message:</span><br>
                            <textarea name="message"></textarea>	<br>
                        </div>

                        <div id="bouton">			
                            <input type="reset" name="annuler" value="Annuler" />
                            <input type="submit" name="envoyer" value="Envoyer" />
                        </div>
                     </div>
                 </form>
            </div><!--Fin envoie message-->
            
        </div>



     <div id="menu_droite">
<!-- partie ou l'on affiche les racourcis vers les fichiers de cour -->	
<?php
                if ($_SESSION['level'] == 2 or $_SESSION['level'] == 3) {
                    try {
                        
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

                        echo "<div id='menu_cour'>
                            <h3>Cours:</h3>";
                        if ($_SESSION['level'] == 2) {
// pour les éléves
                          
                // recherche des matiéres de l'éléve
                               $id_classe = $_SESSION['idclasse'];
                               $requete_matiere= "select m.ID_MATIERE , m.NOM_MATIERE from ENSEIGNE e, MATIERE m where e.ID_MATIERE = m.ID_MATIERE and e.ID_CLASSE = '$id_classe'";
                               $reponse_matiere = $bdd->query($requete_matiere);
                               while ($donnees_matiere = $reponse_matiere->fetch()) {
                                   $idmatiere = $donnees_matiere['ID_MATIERE'];
                                   $count = 0;
                                    echo "<h4>".$donnees_matiere['NOM_MATIERE']."</h4>";
                                        echo "<h5>Cours</h5>";
                                                    $requete_cour= "select DESCRIPTION, LIEN_FICHIER from cour_exercice 
                                                                    where id_classe = '$id_classe' and id_matiere = '$idmatiere' and cour_exercice = 0 order by date_depot desc";
                                                    $reponse_cour = $bdd->query($requete_cour);
                                                    while ($donnees_cour = $reponse_cour->fetch()and $count < 2) {
                                                            $description_fichier = $donnees_cour['DESCRIPTION'];
                                                            $lien_fichier = $donnees_cour['LIEN_FICHIER'];
                                                            
                                                            echo "<a href='".$lien_fichier."' target='blank'>".$description_fichier."</a></br>";
                                                            $count++;
                                                    }
                                        echo "<h5>Exercices</h5>";
                                        $count = 0;
                                                    $requete_cour= "select DESCRIPTION, LIEN_FICHIER from cour_exercice 
                                                                    where id_classe = '$id_classe' and id_matiere = '$idmatiere' and cour_exercice = 1 order by date_depot desc";
                                                    $reponse_cour = $bdd->query($requete_cour);
                                                    while ($donnees_cour = $reponse_cour->fetch()and $count < 2) {
                                                            $description_fichier = $donnees_cour['DESCRIPTION'];
                                                            $lien_fichier = $donnees_cour['LIEN_FICHIER'];
                                                            
                                                            echo "<a href='".$lien_fichier."' target='blank'>".$description_fichier."</a></br>";
                                                            $count++;
                                                    }            
                           }
                        }  else {
                            
// pour les professeurs
                             
                // recherche des classe du prof
                               $id_prof = $_SESSION['id'];
                               $requete_matiere= "select e.ID_CLASSE, e.ID_MATIERE, c.NOM_CLASSE from ENSEIGNE e,CLASSE c where e.ID_CLASSE = c.ID_CLASSE and e.ID_USER = '$id_prof'";
                               $reponse_matiere = $bdd->query($requete_matiere);
                               while ($donnees_matiere = $reponse_matiere->fetch()) {
                                   
                               
                                   $idmatiere = $donnees_matiere['ID_MATIERE'];
                                   $id_classe = $donnees_matiere['ID_CLASSE'];
                                   $count = 0;
                                    echo "<h4>".$donnees_matiere['NOM_CLASSE']."</h4>";
                                        echo "<h5>Cours</h5>";
                                                    $requete_cour= "select DESCRIPTION, LIEN_FICHIER from cour_exercice 
                                                                    where id_classe = '$id_classe' and id_matiere = '$idmatiere' and cour_exercice = 0 order by date_depot desc";
                                                    $reponse_cour = $bdd->query($requete_cour);
                                                    while ($donnees_cour = $reponse_cour->fetch()and $count < 2) {
                                                            $description_fichier = $donnees_cour['DESCRIPTION'];
                                                            $lien_fichier = $donnees_cour['LIEN_FICHIER'];
                                                            
                                                            echo "<a href='".$lien_fichier."' target='blank'>".$description_fichier."</a></br>";
                                                            $count++;
                                                    }
                                        echo "<h5>Exercices</h5>";
                                        $count = 0;
                                                    $requete_cour= "select DESCRIPTION, LIEN_FICHIER from cour_exercice 
                                                                    where id_classe = '$id_classe' and id_matiere = '$idmatiere' and cour_exercice = 1 order by date_depot desc";
                                                    $reponse_cour = $bdd->query($requete_cour);
                                                    while ($donnees_cour = $reponse_cour->fetch()and $count < 2) {
                                                            $description_fichier = $donnees_cour['DESCRIPTION'];
                                                            $lien_fichier = $donnees_cour['LIEN_FICHIER'];
                                                            
                                                            echo "<a href='".$lien_fichier."' target='blank'>".$description_fichier."</a></br>";
                                                            $count++;
                                                    }      
                        }
                        echo"</div>";
                        }
                    }//fin try
                    catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                }
                ?>
     </div>

<!-- appelle de la fonction php qui affiche les evenements a venir-->
<!-- <div id="menu_agenda">
<h3>Agenda:</h3>
                      
<?php
//include("bloc_php/agenda_function.php"); 
//echo "</br><h4>Aujourdhui</h4>";
//agenda(0);
//echo "</br><h4>Demain</h4>";
// agenda(1);
?>
                                                         
</div>-->
</div>
<!-- apelle de la mention légal-->
<?php include("bloc_php/mention_legal.php"); ?>
</body>

</html>


