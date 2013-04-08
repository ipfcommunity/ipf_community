<?php
session_start();
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=ipf_com', $_SESSION['login'], $_SESSION['pwd'], $pdo_options);

$type = $_POST['type_insert'];
        //si section
                        if ($type == 'section') {
                            
                        }
        // si classe    
                        elseif ($type == 'classe') {
                            
                        }
       // si matiere    
                        elseif ($type == 'matiere') {  
                            
                        } 
      // si user   
                        elseif ($type == 'user') {  
                            
                        } 
     // si user   
                        elseif ($type == 'salle') {  
                            
                        }
                        
                        
header('location: administration.php');
?>
