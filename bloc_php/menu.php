
<!--Début du menu du site.-->
	
<div id="menu_all" >
	<div id="menu" alt="menu" title="menu">
		<ul id="ul_menu">
			<li id="li_menu"><a href="./acceuil.php" alt="lien vers l'acceuil" title="lien vers l'acceuil">Accueil</a></li>
                        <?php
                        session_start();
                        if ($_SESSION['level']==2 or $_SESSION['level']==3){
                            echo "<li id='li_menu'><a href='./cour.php' alt='lien vers les cours et les exercices' title='lien vers les cours et les exercices'>Cours</a></li>";
                            if ($_SESSION['level']==2){
                                echo "<li id='li_menu'><a href='./partage.php' alt='lien vers le partage étudiant' title='lien vers le partage étudiant'>Partage</a></li>";
                            }
                        }
                        ?>
			<li id="li_menu"><a href="./parametre.php" alt="lien vers les paramètres utilisateurs" title="lien vers les paramétres utilisateurs">Param&#232;tre</a></li>
                        <li id="li_user"><a href="./logout.php" alt="retour à la page de connexion" title="retour à la page de connexion"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom'].' ' ?> (D&eacute;connexion)</a></li>
                        <?php
                        if ($_SESSION['level']==1){
                            echo "<li id='li_menu'><a href='./administration.php' alt='Page d'administration' title='Page d'administration'>Administration</a></li>";
                            
                        }
                        ?>
                </ul>
	</div>
<div id="menu_couleur">&nbsp;</div>
    	<div id="menu_couleur2">&nbsp;</div>
</div>
<!--<li id="li_menu"><a href="./agenda.php" alt="lien vers l'agenda" title="lien vers l'agenda">Agenda</a></li>-->