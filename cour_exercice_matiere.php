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
            // recuperation des données
                $id_classe = $_POST['id_classe'];
                $id_matiere = $_POST['id_matiere'];
                $cour_exercice = $_POST['cour_exercice'];
//module d'upload           
           if ($_SESSION['level']==3) {
    echo "<!--upload des fichier cour pour les PROFESSEUR-->
            <div id='upload_fichier_partage'>
                <h3>Upload:</h3><br>
                <form method='post' action='upload_cour.php' enctype='multipart/form-data'>
                    <label id='fichier_level' for='mon_fichier'>Fichier ( max. 50 Mo) :</label><br />
                    <input type='hidden' name='MAX_FILE_SIZE' value='50485760' />
                    
                    <input type='hidden' name='idclasse' value='$id_classe' />
                    <input type='hidden' name='idmatiere' value='$id_matiere' />
                    <input type='hidden' name='cour_exercice' value='$cour_exercice' />
                    
                    <input type='file' name='fichier_partage' id='fichier_parcourir' /><br />
                    <label id='fichier_level' for='description'>Titre de vôtre fichier (max. 32 caractères) :</label><br />
                    <textarea name='description' id='fichier_description'></textarea><br />
                    <input id='bouton_upload' type='submit' name='submit' value='Envoyer' />
                </form>                
            </div>";
           }//fin si test professeur
           if ($cour_exercice == 0) {
               $titre = 'Cour: ';
           }  else {
               $titre = 'Exercice: ';
           }
// titre puis tableau
           echo "<h3>".$titre.$_POST['titre']."</h3>";
           
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

                        $requete = "select * from cour_exercice where ID_CLASSE ='$id_classe' and ID_MATIERE = '$id_matiere' and COUR_EXERCICE = '$cour_exercice' order by date_depot desc";
                        $reponse = $bdd->query($requete);
                        echo"<table id='partage_table'>
                            <tr>
                                <td id='partage_td_titre'>Date</td>
                                <td id='partage_td_titre'>User</td>
                                <td id='partage_td_titre'>Description</td>
                                <td id='partage_td_titre'>Lien</td>
                            </tr>";
                            
                        while($donnees = $reponse -> fetch())
				{
                                        $description = $donnees['DESCRIPTION'];
                                        $lien = $donnees['LIEN_FICHIER'];
                                        $requete1 = "select concat(PRENOM_USER,' ',NOM_USER) as nom from IPF_USER where ID_USER = ".$donnees['ID_USER']."";
                                                $reponse1 = $bdd->query($requete1);
                                                $reponse2 = $reponse1 ->fetch(PDO::FETCH_ASSOC);
                                                    $nom = $reponse2['nom'];
					echo"<tr>
                                                <td id='partage_td'>".$donnees['DATE_DEPOT']."</td>
                                                <td id='partage_td'>".$nom."</td>
                                                <td id='partage_td'>".$description."</td>
                                                <td id='partage_td'><a href='".$lien."' target='blank'>Telecharger</a></td>
                                             </tr>";
				}
                        echo"</table>";
                        
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
