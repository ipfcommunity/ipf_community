<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>IPF Community - Partage</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("bloc_php/appel_css.php"); ?>	

    </head>

    <body onload="var timer = setInterval('horloge()', 1000)">
        <?php include("bloc_php/menu.php"); ?>
        <div id="corp_centre">
            
<!--upload des fichier vrac-->
            <div id="upload_fichier_partage">
                <h3>Upload:</h3><br>
                <form method="post" action="upload.php" enctype="multipart/form-data">
                    <label id="fichier_level" for="mon_fichier">Fichier ( max. 50 Mo) :</label><br />
                    <input type="hidden" name="MAX_FILE_SIZE" value="50485760" />
                    <input type="file" name="fichier_partage" id="fichier_parcourir" /><br />
                    <label id="fichier_level" for="description">Titre de vôtre fichier (max. 32 caractères) :</label><br />
                    <textarea name="description" id="fichier_description"></textarea><br />
                    <input id='bouton_upload' type="submit" name="submit" value="Envoyer" />
                </form>                
            </div>

                <?php
//test erreur ajout de fichier
                $erreur_upload = $_SESSION['partage_erreur'];
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
//affichage des fichier vrac               
                if ($_SESSION['level'] == 2) {
                    try {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

                        $requete = "select * from vrac order by date_depot desc";
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
                }
                
                ?>
        </div>

        <div id="monhorloge"> &nbsp; </div>
        <?php include("bloc_php/mention_legal.php"); ?>
    </body>

</html>
<!--Ce document a été réaliser en octobre 2012. 
Dans le cadre d'un projet dans l'école iris, 
par camille pire, maxime maréchal et jean-marie pujade.-->
