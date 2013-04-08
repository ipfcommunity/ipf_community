<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//FR"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>IPF Community</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <?php include("bloc_php/appel_css.php"); ?>
        
        <!--script javascript-->
        <script type="text/javascript" >

            function premiere_connexion()
            {
                alert("Bonjour c'est votre première connexion? \nDemander à l'administrateur votre adresse mail et votre mot de passe.");

            }

        </script>

    </head>
   
    <body>
                    <?php
        session_start();
          $erreur_connexion = $_SESSION['erreur_connexion'];
                if ($erreur_connexion == 1) {
                   echo"<SCRIPT type='text/javascript'>  alert('Email ou mot de passe incorrect');</script>";
                   $_SESSION['erreur_connexion'] = NULL;
                }
                ?>
        
       <div id="barre_" alt="barre_" title="barre_">
	<ul id="ul_barre">&nbsp;</ul>
	</div>
<div id="barre_couleur">&nbsp;</div>
    	<div id="barre_couleur2">&nbsp;</div>
        <h1>IPF Community</h1>
              <img src="image/logo-ipf.jpg" alt="IRIS" id="ipf_logo"/>
                <div id="text_connexion">

                    <p>Bonjour et bienvenue sur le site communautaire du groupe ipf. Il regroupe les école IRIS, EPH et ETS.
                    </p><br>
                        <p>3 écoles, 16000 parcours, une vocation.

                            Depuis ses débuts, en 1936, le Groupe IPF n'a eu de cesse d'accompagner les passions, révéler les ambitions et promouvoir les talents de chacun.
                            Former à l'excellence, professionnaliser, individualiser les parcours, telles sont les finalités fondamentales de notre action.

                            Nous voulons armer nos élèves de solides compétences, les rendre ouverts au monde, réactifs aux signes d'innovation et de mutation.
                        </p>

                   <div id="img_connexion">
                        
                                <a href="http://www.ecole-europeenne.com/"id="logo1"target="blank" title="ETS">
                                        <img src="image/logo-ets.png" alt="ETS" /></a><!--Modification apportée par Jean-Marie le 20/11/2012 à 14h27 -->

                                <a href="http://www.leph.fr/"id="logo2" target="blank" title="EPH">
                                        <img src="image/logo-eph.png" alt="EPH" /></a><!--Modification apportée par Jean-Marie le 20/11/2012 à 14h27 -->

                                <a href="http://www.irisformation.com/"id="logo3" target="blank" title="IRIS">
                                        <img src="image/logo-iris.png" alt="IRIS" /></a><!--Modification apportée par Jean-Marie le 20/11/2012 à 14h27 -->
                               <!--Modification apportée par Jean-Marie le 20/11/2012 à 14h27 -->
                       	 <!--Modification apportée par Jean-Marie le 20/11/2012 à 14h27 -->

                    </div>

               



                <!--formulaire de connexion-->
                <form id="form_connexion" action="login.php" method="post">
                    <span>E-mail: </span><input type="email" name="E-mail" maxlength="90" />
                    <span>Mot de passe: </span>	<input type="password" name="password" maxlength="90" /></br>
                    <input  type="reset" name="Annuler" value="Annuler"/>
                    <input  type="submit" name="Connecter" value="Connecter" />

                    <button class="button2" name="premiereConexion" type="button" 
                            onclick="premiere_connexion()"><span>Première connexion cliquez ici.</span></button>
                </form>
                <?php
          
          $_SESSION['erreur_connexion'] = null;
               
                ?>
            </div> 
            
        
         
        <?php include("bloc_php/mention_legal.php"); ?>
         
    </body>

</html>
<!--Ce document a été réalisé en octobre 2012.
Dans le cadre d'un projet dans l'école iris,
par camille pire, maxime maréchal et jean-marie pujade.-->
