<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//FR'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='fr' lang='fr'>

    <head>
        <title>IPF Community - Partage</title>
        <meta http-equiv='content-type' content='text/html;charset=utf-8' />
        <?php include('bloc_php/appel_css.php'); ?>	

    </head>

    <body onload='var timer = setInterval('horloge()', 1000)'>
        <?php include('bloc_php/menu.php'); ?>
        <div id='corp_centre'>
            <?php
            try {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
                  //vache à lait
// section                    
                    echo    "<div id='bloc_admin'>
                            <h3>Ajout section</h3></br>
                            <br>
                            <form method='post' action = 'insert.php'>
                                   
                                   <b>Nom de la section (SIO, MUC, etc): </b><input type='text' name='section_nom' />
                                   <b>Type de diplome (BAC, BTS, etc): </b><input type='text' name='section_type' /></br>
                                   <b>Specialité (SLAM, SISR, etc): </b><input type='text' name='section_option' />
                                   
                                   <input type='hidden' name='type_insert' value='section'/>
                                   <input type='reset' name='Annulé' /><input type='submit' name='Confirmé' />		
                            </form>
                            <form method='post' action = 'afficher_existant.php' target ='_blank'>
                                   <input type='hidden' name='type_insert' value='section'/>
                                   <input type='submit' name='existant' value ='Afficher les sections existantes'/>		
                            </form>
                            </div>";
 //classe                           
                   echo    "<div id='bloc_admin'>
                            <h3>Ajout classe</h3></br>
                            <br>
                            
                                <form method='post' action = 'insert.php'>
                                   
                                   
                                   <b>ID de la section: </b><select name='section_classe><option value ='null'>Choisir</option>";
                   
                                    $requete_classe = "select ID_SECTION, concat(NOM_SECTION,' ',SPECIALITER) as nom_section  from SECTION";
                                    $reponse_classe = $bdd->query($requete_classe);
                                    while($donnees_classe = $reponse_classe -> fetch()){
                                        $id=$donnees_classe['ID_SECTION'];
                                        $nom_section = $donnees_classe['nom_section'];
                                        echo "<option value='$id'>$nom_section</option>";
                                    }
                                   
                                   echo"</select>
                                   <b>Nom de la classe (sio2devlm, sio1A, etc): </b><input type='text' name='classe_nom' />
                                   
                                   <input type='hidden' name='type_insert' value='classe'/>
                                   <input type='reset' name='Annulé' /><input type='submit' name='Confirmé' />		
                                </form>
                                <form method='post' action = 'afficher_existant.php' target ='_blank'>
                                   <input type='hidden' name='type_insert' value='classe'/>
                                   <input type='submit' name='existant' value ='Afficher les classes existantes'/>		
                                </form>
                                
                            </div>";         
 //Matiere                 
                  echo    "<div id='bloc_admin'>
                            <h3>Ajout Matière</h3></br>
                            <br>
                            
                                    <form method='post' action = 'insert.php'>
                                   
                                   <b>Nom de la matière (francais,E6, etc): </b><input type='text' name='matiere_nom' />
                                   
                                   
                                   <input type='hidden' name='type_insert' value='matiere'/>
                                   <input type='reset' name='Annulé' /><input type='submit' name='Confirmé' />		
                            </form>
                            <form method='post' action = 'afficher_existant.php' target ='_blank'>
                                   <input type='hidden' name='type_insert' value='matiere'/>
                                   <input type='submit' name='existant' value ='Afficher les sections existantes'/>		
                            </form>
                            
                            </div>";
  // utilisateur                
                   echo    "<div id='bloc_admin'>
                            <h3>Ajout utilisateur</h3></br>
                            <br>
                            
                            </div>";
   //salle                
                   echo    "<div id='bloc_admin'>
                            <h3>Ajout salle de cours</h3></br>
                            <br>
                            
                            </div>";
   //enseigne                
                   echo    "<div id='bloc_admin'>
                            <h3>Ajout heure de cours</h3></br>
                            <br>
                            
                            </div>";
                   
                }//fin try
            catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                }   
            ?>
            </div>
        <div id='monhorloge'> &nbsp; </div>
        <?php include('bloc_php/mention_legal.php'); ?>
    </body>

</html>
<!--Ce document a été réaliser en octobre 2012. 
Dans le cadre d'un projet dans l'école iris, 
par camille pire, maxime maréchal et jean-marie pujade.-->
