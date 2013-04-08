<?php
session_start();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

$type = $_POST['type_insert'];
        //si section
                        if ($type == 'section') {
                      // création de l'id
                                            
                              $requete_section = "SELECT max(ID_SECTION) as id FROM SECTION";
                              $reponse_section = $bdd->query($requete_section);
                              $donnee_section = $reponse_section->fetch(PDO::FETCH_ASSOC);
                              $id_section = $donnee_section['id']+1;
                              
                      // recuperation des données
                            $nom_section = strtoupper($_POST['section_nom']);
                            $diplome = strtoupper($_POST['section_diplome']);  
                            $specialiter = strtoupper($_POST['section_option']);
                            
                      //insertion de la section          
                            $requete_insert_section = " insert into SECTION values(:ID_SECTION,:NOM_SECTION, :DIPLOME, :SPECIALITER)";
                            $reponse_insert_section = $bdd->prepare($requete_insert_section);
                            $insert_section = $reponse_insert_section -> execute(array(
                                'ID_SECTION' => $id_section,
                                'NOM_SECTION' => $nom_section,
                                'DIPLOME' => $diplome,
                                'SPECIALITER' => $specialiter));
                            
                        }
        // si classe    
                        elseif ($type == 'classe') {
                      // création de l'id
                                            
                              $requete_classe = "SELECT max(ID_CLASSE) as id FROM CLASSE";
                              $reponse_classe = $bdd->query($requete_classe);
                              $donnee_classe = $reponse_classe->fetch(PDO::FETCH_ASSOC);
                              $id_classe = $donnee_classe['id']+1;
                      // recuperation des données
                            $nom_classe = ucfirst($_POST['classe_nom']);
                            $id_section = $_POST['section_classe'];  
                           
                      //insertion de la classe          
                            $requete_insert_classe = " insert into CLASSE values(:ID_CLASSE, :ID_SECTION, :NOM_CLASSE)";
                            $reponse_insert_classe = $bdd->prepare($requete_insert_classe);
                            $insert_classe = $reponse_insert_classe -> execute(array(
                                'ID_CLASSE' => $id_classe,                                
                                'ID_SECTION' => $id_section,
                                'NOM_CLASSE' => $nom_classe));     
                            
                        }
       // si matiere    
                        elseif ($type == 'matiere') {  
                      // création de l'id
                                            
                              $requete_matiere = "SELECT max(ID_MATIERE) as id FROM MATIERE";
                              $reponse_matiere = $bdd->query($requete_matiere);
                              $donnee_matiere = $reponse_matiere->fetch(PDO::FETCH_ASSOC);
                              $id_matiere = $donnee_matiere['id']+1;
                      // recuperation des données
                            $nom_matiere = ucfirst($_POST['matiere_nom']);
                            
                           
                      //insertion de la matiere          
                            $requete_insert_matiere = " insert into MATIERE values(:ID_MATIERE, :NOM_MATIERE)";
                            $reponse_insert_matiere = $bdd->prepare($requete_insert_matiere);
                            $insert_matiere = $reponse_insert_matiere -> execute(array(
                                'ID_MATIERE' => $id_matiere,
                                'NOM_MATIERE' => $nom_matiere)); 
                            
                        } 
      // si user   
                        elseif ($type == 'user') {  
                        // création de l'id
                                            
                              $requete_user = "SELECT max(ID_USER) as id FROM IPF_USER";
                              $reponse_user = $bdd->query($requete_user);
                              $donnee_user = $reponse_user->fetch(PDO::FETCH_ASSOC);
                              $id_user = $donnee_user['id']+1;
                              
                      // recuperation des données
                            $user_level = $_POST['user_level'];
                            $user_nom = ucfirst($_POST['user_nom']);
                            $user_prenom = ucfirst($_POST['user_prenom']);
                            $user_mail = $_POST['user_mail'];
                            $user_password = $_POST['user_password'];
                            $user_classe = $_POST['user_classe'];
                      
                     // preparation du mot de passe
                                $requete_password = "SELECT md5('$user_password') as pwd";
                                $reponse_password = $bdd->query($requete_password);
                                $donnee_password = $reponse_password->fetch(PDO::FETCH_ASSOC);
                                $user_password_md5 = $donnee_password['pwd'];
                                
                     // date du jour
                                $requete_date = "SELECT curdate() as date";
                                $reponse_date = $bdd->query($requete_date);
                                $donnee_date = $reponse_date->fetch(PDO::FETCH_ASSOC);
                                $inscription_date = $donnee_date['date'];           
                                
                                        if($user_level == 1){

                                            //insertion de l'a matiere'utilisateur          
                                              $requete_insert_user = " insert into ADMINISTRATEUR values(:ID_USER, :NOM_USER, :PRENOM_USER, :MAIL_ECOLE, :MDP)";
                                              $reponse_insert_user = $bdd->prepare($requete_insert_user);
                                              $insert_user = $reponse_insert_user -> execute(array(
                                                  'ID_USER' => $id_user,
                                                  'NOM_USER' => $user_nom,
                                                  'PRENOM_USER' => $user_prenom,
                                                  'MAIL_ECOLE' => $user_mail,
                                                  'MDP' => $user_password));


                                        } elseif ($user_level == 2) {

                                            //insertion de l'a matiere'utilisateur          
                                              $requete_insert_eleve = " insert into ELEVE values(:ID_CLASSE,:ID_USER, :DATE_INSCRIPTION, :MAIL_PERSO,:NOM_USER, :PRENOM_USER, :MAIL_ECOLE, :MDP)";
                                              $reponse_insert_eleve = $bdd->prepare($requete_insert_eleve);
                                              $insert_eleve = $reponse_insert_eleve -> execute(array(                                                 
                                                  'ID_CLASSE' => $user_classe,
                                                  'ID_USER' => $id_user,
                                                  'DATE_INSCRIPTION' => $inscription_date,
                                                  'MAIL_PERSO' => NULL,
                                                  'NOM_USER' => $user_nom,
                                                  'PRENOM_USER' => $user_prenom,
                                                  'MAIL_ECOLE' => $user_mail,
                                                  'MDP' => $user_password_md5));


                                    } elseif ($user_level == 3) {

                                        //insertion de l'a matiere'utilisateur          
                                              $requete_insert_user = " insert into PROFFESSEUR values(:ID_USER, :NOM_USER, :PRENOM_USER, :MAIL_ECOLE, :MDP)";
                                              $reponse_insert_user = $bdd->prepare($requete_insert_user);
                                              $insert_user = $reponse_insert_user -> execute(array(
                                                  'ID_USER' => $id_user,
                                                  'NOM_USER' => $user_nom,
                                                  'PRENOM_USER' => $user_prenom,
                                                  'MAIL_ECOLE' => $user_mail,
                                                  'MDP' => $user_password));


                                    } elseif ($user_level == 4) {

                                        //insertion de l'a matiere'utilisateur          
                                              $requete_insert_user = " insert into MODERATEUR values(:ID_USER, :NOM_USER, :PRENOM_USER, :MAIL_ECOLE, :MDP)";
                                              $reponse_insert_user = $bdd->prepare($requete_insert_user);
                                              $insert_user = $reponse_insert_user -> execute(array(
                                                  'ID_USER' => $id_user,
                                                  'NOM_USER' => $user_nom,
                                                  'PRENOM_USER' => $user_prenom,
                                                  'MAIL_ECOLE' => $user_mail,
                                                  'MDP' => $user_password));


                                    }         
                                
                      
                        } 
     // si salle  
                        elseif ($type == 'salle') {  
                            
                            // création de l'id
                                            
                              $requete_salle = "SELECT max(ID_SALLE) as id FROM SALLE";
                              $reponse_salle = $bdd->query($requete_salle);
                              $donnee_salle = $reponse_salle->fetch(PDO::FETCH_ASSOC);
                              $id_salle = $donnee_salle['id']+1;
                              
                      // recuperation des données
                            $nom_salle = $_POST['salle_nom'];
                            $batiment = ucfirst($_POST['salle_batiment']);
                            $num_salle = $_POST['salle_numero'];
                           
                      //insertion de la salle          
                            $requete_insert_salle = " insert into SALLE values(:ID_SALLE, :NOM_SALLE, :BATIMENT, :NUM_SALLE)";
                            $reponse_insert_salle = $bdd->prepare($requete_insert_salle);
                            $insert_salle = $reponse_insert_salle -> execute(array(
                                'ID_SALLE' => $id_salle,
                                'NOM_SALLE' => $nom_salle,
                                'BATIMENT' => $batiment,
                                'NUM_SALLE' => $num_salle)); 
                            
                        }
    // si cour  
                        elseif ($type == 'cour') {  
                          
                                                      
                      // recuperation des données
                            $cour_classe = $_POST['cour_classe'];
                            $cour_matiere = $_POST['cour_matiere'];
                            $cour_salle = $_POST['cour_salle'];
                            $cour_prof = $_POST['cour_prof'];
                           
                      //insertion de la cour          
                            $requete_insert_cour = " insert into ENSEIGNE values(:ID_CLASSE, :ID_MATIERE, :ID_SALLE, :ID_USER, :DATE_DEBUT, :DATE_FIN)";
                            $reponse_insert_cour = $bdd->prepare($requete_insert_cour);
                            $insert_cour = $reponse_insert_cour -> execute(array(
                                'ID_CLASSE' => $cour_classe,
                                'ID_MATIERE' => $cour_matiere,
                                'ID_SALLE' => $cour_salle,
                                'ID_USER' => $cour_prof,
                                'DATE_DEBUT' => NULL,
                                'DATE_FIN' => NULL)); 
                            
                        }
                        
                        
header('location: administration.php');
?>
