<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>IPF Community - Cour</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("bloc_php/appel_css.php"); ?>	

    </head>

    <body onload="var timer = setInterval('horloge()', 1000)">
        <?php include("bloc_php/menu.php"); ?>


        <div id="corp_centre">
            <div id="corp_cour">
                
                <?php
             //test erreur ajout de fichier
                $erreur_upload = $_SESSION['partage_erreur_cour'];
                if ($erreur_upload == 1) {
                   echo"<SCRIPT type='text/javascript'>  alert('Erreur lors du transfert');</script>";
                   $_SESSION['partage_erreur'] = NULL;
                }elseif ($erreur_upload == 2) {
                   echo"<SCRIPT type='text/javascript'>  alert('Fichier trop volumineux');</script>";
                   $_SESSION['partage_erreur'] = NULL;
                }elseif ($erreur_upload == 3) {
                   echo"<SCRIPT type='text/javascript'>  alert('Erreur lors du transfert \n Fichier trop volumineux');</script>";
                   $_SESSION['partage_erreur'] = NULL;
                }elseif ($erreur_upload == 4) {
                   echo"<SCRIPT type='text/javascript'>  alert('Extension non valide.');</script>";
                   $_SESSION['partage_erreur'] = NULL;
                }
                try {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
//test si eleve
                    if ($_SESSION['level']==2){
                        
// recherche des matiéres de l'éléve
                        $id_classe = $_SESSION['idclasse'];
                        $tmp = 0;
                        echo "<div id='cour_ligne'>";
                        $requete_matiere= "select m.ID_MATIERE , m.NOM_MATIERE from ENSEIGNE e, MATIERE m where e.ID_MATIERE = m.ID_MATIERE and e.ID_CLASSE = '$id_classe'";
                        $reponse_matiere = $bdd->query($requete_matiere);
                         while ($donnees_matiere = $reponse_matiere->fetch()) {
                             if ($tmp == 4) {
                                 echo "</div><div id='cour_ligne'>";
                                 $tmp =0;
                             }
                             $id_matiere = $donnees_matiere['ID_MATIERE'];
                             $nom_matiere = $donnees_matiere['NOM_MATIERE'];
                             
                             echo "<div id='cour'>
                                 <h3>".$nom_matiere."</h3>
                                     <form method='post' action='cour_exercice_matiere.php'>
                                        <input type='hidden' name='id_matiere' value='$id_matiere' />
                                        <input type='hidden' name='id_classe' value='$id_classe' />
                                        <input type='hidden' name='titre' value='$nom_matiere' /> 
                                        <input type='hidden' name='cour_exercice' value='0' /> 
                                        <input id='bouton_cour' type='submit' name='submit' value='Cours' />
                                    </form>
                                    <form method='post' action='cour_exercice_matiere.php'>
                                        <input type='hidden' name='id_matiere' value='$id_matiere' />
                                        <input type='hidden' name='id_classe' value='$id_classe' />   
                                        <input type='hidden' name='titre' value='$nom_matiere' /> 
                                        <input type='hidden' name='cour_exercice' value='1' />
                                        <input id='bouton_exercice' type='submit' name='submit' value='Exercices' />
                                    </form> </div>";
                           $tmp++;  
                         }//fin while fetch
                        echo "</div>";
                        
                        
                    }//finsi eleve
//test si professeur                  
                    elseif ($_SESSION['level']==3) {
                        $id_prof = $_SESSION['id'];
                        $tmp = 0;
                        echo "<div id='cour_ligne'>";
                        $requete_matiere= "select e.ID_CLASSE, e.ID_MATIERE, c.NOM_CLASSE from ENSEIGNE e,CLASSE c where e.ID_CLASSE = c.ID_CLASSE and e.ID_USER = '$id_prof'";
                        $reponse_matiere = $bdd->query($requete_matiere);
                         while ($donnees_matiere = $reponse_matiere->fetch()) {
                             if ($tmp == 4) {
                                 echo "</div><div id='cour_ligne'>";
                                 $tmp =0;
                             }
                             
                             $id_matiere = $donnees_matiere['ID_MATIERE'];
                             $id_classe = $donnees_matiere['ID_CLASSE'];
                             $nom_classe = $donnees_matiere['NOM_CLASSE'];
                             
                             echo "<div id='cour'>
                                 <h3>".$nom_classe."</h3>
                                     <form method='post' action='cour_exercice_matiere.php'>
                                        <input type='hidden' name='id_matiere' value='$id_matiere' />
                                        <input type='hidden' name='id_classe' value='$id_classe' /> 
                                        <input type='hidden' name='titre' value='$nom_classe' />
                                        <input type='hidden' name='cour_exercice' value='0' />
                                        <input id='bouton_cour' type='submit' name='submit' value='Cours' />
                                    </form>
                                    <form method='post' action='cour_exercice_matiere.php'>
                                        <input type='hidden' name='id_matiere' value='$id_matiere' />
                                        <input type='hidden' name='id_classe' value='$id_classe' />
                                        <input type='hidden' name='titre' value='$nom_classe' />
                                        <input type='hidden' name='cour_exercice' value='1' />
                                        <input id='bouton_exercice' type='submit' name='submit' value='Exercices' />
                                    </form> </div>";
                           $tmp++;  
                         }//fin while fetch
                        echo "</div>";
                        
                        
                    }//finsi prof
                        
                    
                }//fin try
                catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                ?>
  

                
                
                </div>
                 </div>

                 <div id="monhorloge"> &nbsp; </div>
                  <?php include("bloc_php/mention_legal.php"); ?>
                  </body>

                  </html>
                   <!--Ce document a été réalisé en octobre 2012. 
                   Dans le cadre d'un projet dans l'école iris, 
                   par camille pire, maxime maréchal et jean-marie pujade.-->
