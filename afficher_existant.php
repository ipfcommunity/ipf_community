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
                                    echo"<table id='partage_table'>
                                        <tr>
                                            <td id='partage_td_titre'>ID_SECTION</td>
                                            <td id='partage_td_titre'>NOM_SECTION</td>
                                            <td id='partage_td_titre'>DIPLOME</td>
                                            <td id='partage_td_titre'>SPECIALITE</td>
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='partage_td'>".$donnees['ID_SECTION']."</td>
                                                            <td id='partage_td'>".$donnees['NOM_SECTION']."</td>
                                                            <td id='partage_td'>".$donnees['DIPLOME']."</td>
                                                            <td id='partage_td'>".$donnees['SPECIALITER']."</td>
                                                         </tr>";
                                            }
                                    echo"</table>";
                        }
       // si classe    
                        elseif ($type == 'classe') {
                            
                             $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='partage_table'>
                                        <tr>
                                            <td id='partage_td_titre'>ID_CLASSE</td>
                                            <td id='partage_td_titre'>ID_SECTION</td>
                                            <td id='partage_td_titre'>NOM_CLASSE</td>
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='partage_td'>".$donnees['ID_CLASSE']."</td>
                                                            <td id='partage_td'>".$donnees['ID_SECTION']."</td>
                                                            <td id='partage_td'>".$donnees['NOM_CLASSE']."</td>
                                                         </tr>";
                                            }
                                    echo"</table>";
                                    
                        }
       // si matiere    
                        elseif ($type == 'matiere') {
                            
                             $requete = "select * from ".$type;
                                    $reponse = $bdd->query($requete);
                                    echo"<table id='partage_table'>
                                        <tr>
                                            <td id='partage_td_titre'>ID_MATIERE</td>
                                            <td id='partage_td_titre'>NOM_MATIERE</td>
                                            
                                            
                                        </tr>";

                                    while($donnees = $reponse -> fetch())
                                            {
                                                    echo"<tr>
                                                            <td id='partage_td'>".$donnees['ID_MATIERE']."</td>
                                                            <td id='partage_td'>".$donnees['NOM_MATIERE']."</td>
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
