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
           
               try {    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
                        $test;
                        $type = $_POST['type_insert'];
        //si section
                        if ($type == 'section') {
                                    $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_SECTION</td>
                                            <td id='affiche_td_titre'>NOM_SECTION</td>
                                            <td id='affiche_td_titre'>DIPLOME</td>
                                            <td id='affiche_td_titre'>SPECIALITE</td>
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_SECTION']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_SECTION']."</td>
                                                            <td id='affiche_td'>".$donnees['DIPLOME']."</td>
                                                            <td id='affiche_td'>".$donnees['SPECIALITER']."</td>
                                                         </tr>";
                                            }
                                    echo"</table>";
                        }
       // si classe    
                        elseif ($type == 'classe') {
                            
                             $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_CLASSE</td>
                                            <td id='affiche_td_titre'>ID_SECTION</td>
                                            <td id='affiche_td_titre'>NOM_CLASSE</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_CLASSE']."</td>
                                                            <td id='affiche_td'>".$donnees['ID_SECTION']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_CLASSE']."</td>
                                                         </tr>";
                                            }
                                    echo"</table>";
                                    
                        }
       // si matiere    
                        elseif ($type == 'matiere') {
                            
                             $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_MATIERE</td>
                                            <td id='affiche_td_titre'>NOM_MATIERE</td>
                                            
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_MATIERE']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_MATIERE']."</td>
                                                         </tr>";
                                            }
                                    echo"</table>";
                                    
                        }
      // si user   
                        elseif ($type == 'user') {
              //administrateur              
                             $requete = "select * from IPF_USER where NB_LEVEL = 1 ";
                                    $reponse = $bdd->query($requete);
                                    echo"<br><h3>Administrateurs</h3><br>
                                        <table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_USER</td>
                                            <td id='affiche_td_titre'>NB_LEVEL</td>
                                            <td id='affiche_td_titre'>NOM_USER</td>
                                            <td id='affiche_td_titre'>PRENOM_USER</td>
                                            <td id='affiche_td_titre'>MAIL_ECOLE</td>
                                            <td id='affiche_td_titre'>MOT_DE_PASSE (MDP md5)</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['NB_LEVEL']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['PRENOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['MAIL_ECOLE']."</td>
                                                            <td id='affiche_td'>".$donnees['MDP']."</td>
                                                         </tr>";
                                            }
                                    echo"</table><br>";
                 //eleve                   
                                $requete = "select * from IPF_USER where NB_LEVEL = 2";
                                    $reponse = $bdd->query($requete);
                                    echo"<br><h3>Elèves</h3><br>
                                        <table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_USER</td>
                                            <td id='affiche_td_titre'>NB_LEVEL</td>
                                            <td id='affiche_td_titre'>NOM_USER</td>
                                            <td id='affiche_td_titre'>PRENOM_USER</td>
                                            <td id='affiche_td_titre'>MAIL_ECOLE</td>
                                            <td id='affiche_td_titre'>MOT_DE_PASSE (MDP md5)</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['NB_LEVEL']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['PRENOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['MAIL_ECOLE']."</td>
                                                            <td id='affiche_td'>".$donnees['MDP']."</td>
                                                         </tr>";
                                            }
                                    echo"</table><br>"; 
                   //proffesseur
                                    $requete = "select * from IPF_USER where NB_LEVEL = 3";
                                    $reponse = $bdd->query($requete);
                                    echo"<br><h3>Professeurs</h3><br>
                                        <table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_USER</td>
                                            <td id='affiche_td_titre'>NB_LEVEL</td>
                                            <td id='affiche_td_titre'>NOM_USER</td>
                                            <td id='affiche_td_titre'>PRENOM_USER</td>
                                            <td id='affiche_td_titre'>MAIL_ECOLE</td>
                                            <td id='affiche_td_titre'>MOT_DE_PASSE (MDP md5)</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['NB_LEVEL']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['PRENOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['MAIL_ECOLE']."</td>
                                                            <td id='affiche_td'>".$donnees['MDP']."</td>
                                                         </tr>";
                                            }
                                    echo"</table><br>";
                     //administration
                                    $requete = "select * from IPF_USER where NB_LEVEL = 4";
                                    $reponse = $bdd->query($requete);
                                    echo"<br><h3>Administration</h3><br>
                                        <table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_USER</td>
                                            <td id='affiche_td_titre'>NB_LEVEL</td>
                                            <td id='affiche_td_titre'>NOM_USER</td>
                                            <td id='affiche_td_titre'>PRENOM_USER</td>
                                            <td id='affiche_td_titre'>MAIL_ECOLE</td>
                                            <td id='affiche_td_titre'>MOT_DE_PASSE (MDP md5)</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['NB_LEVEL']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['PRENOM_USER']."</td>
                                                            <td id='affiche_td'>".$donnees['MAIL_ECOLE']."</td>
                                                            <td id='affiche_td'>".$donnees['MDP']."</td>
                                                         </tr>";
                                            }
                                    echo"</table><br>";
                                    
                        }// fin user  
                        
            // si salle    
                        elseif ($type == 'salle') {
                            
                             $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='affiche_table'>
                                        <tr>
                                            <td id='affiche_td_titre'>ID_SALLE</td>
                                            <td id='affiche_td_titre'>NOM_SALLE</td>
                                            <td id='affiche_td_titre'>BATIMENT</td>
                                            <td id='affiche_td_titre'>NUM_SALLE</td>
                                            
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='affiche_td'>".$donnees['ID_SALLE']."</td>
                                                            <td id='affiche_td'>".$donnees['NOM_SALLE']."</td>
                                                            <td id='affiche_td'>".$donnees['BATIMENT']."</td>
                                                            <td id='affiche_td'>".$donnees['NUM_SALLE']."</td>    
                                                         </tr>";
                                            }
                                    echo"</table>";
                                    
                        }            
                        
                        
                   
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
