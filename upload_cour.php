<?php
session_start();
try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host='.$_SESSION["host"].';'.$_SESSION["dbase"], $_SESSION['login'], $_SESSION['pwd'], $pdo_options);
    
$_SESSION['partage_erreur'] = $erreur1 = $erreur2 = $erreur3 = NULL;

//recuparation des données
$nom_fichier_partage = $_FILES['fichier_partage']['name'];     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
$taille_fichier_partage = $_FILES['fichier_partage']['size'];     //La taille du fichier en octets.
$chemin_fichier_partage = $_FILES['fichier_partage']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
$erreur_fichier_partage = $_FILES['fichier_partage']['error'];  

// Sécurité contre les injections SQL
if (get_magic_quotes_gpc()) {
    $description_fichier= stripslashes($_POST['description']);
} else {
    $description_fichier = $_POST['description'];
}

    $description_fichier=mysql_real_escape_string($description_fichier);
	
// Fin sécurité contre les injections SQL

$id_classe_upload = $_POST['idclasse'];
$id_matiere_upload = $_POST['idmatiere'];
$cour_exercice_upload = $_POST['cour_exercice'];
$user_uploader = $_SESSION['id'];

//selection date
    $requete_date = "select NOW() as date";
    $reponse_date = $bdd->query($requete_date);
    $donnee_date = $reponse_date->fetch(PDO::FETCH_ASSOC);
    $date_fichier = $donnee_date['date'];

//select id
$requete_id_fichier= "select MAX(ID_FICHIER) as id_fichier from FICHIER";
$reponse_id_fichier = $bdd->query($requete_id_fichier);
$donnee_id_fichier = $reponse_id_fichier->fetch(PDO::FETCH_ASSOC);
$id_fichier = $donnee_id_fichier['id_fichier']+1;

// test extention
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'pdf', 'doc','docx', 'odt' );
$extension_upload = strtolower(  substr(  strrchr($nom_fichier_partage, '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ){ 
    echo "Extension correcte";
    
//test des données
if ($erreur_fichier_partage > 0){
    $erreur1 = 1;
}elseif ($taille_fichier_partage > $_POST['MAX_FILE_SIZE']) {
    
    $erreur2 = 2;
}else{
    if ($cour_exercice_upload == 0) {
        $nom_fichier = "CMC_".$id_classe_upload."_".$id_matiere_upload."_".$id_fichier;//cmc = classe_matiere_cour
    }  else {
        $nom_fichier = "CME_".$id_classe_upload."_".$id_matiere_upload."_".$id_fichier;//cmE = classe_matiere_exercice
    }    
    
$lien_fichier = "fichier/cour_exercice/{$nom_fichier}.{$extension_upload}";
$resultat = move_uploaded_file($chemin_fichier_partage,$lien_fichier);
if ($resultat) {
    echo "Transfert réussi";
}

//insertion base de donnee
 $requete_insert_message = " insert into COUR_EXERCICE(ID_FICHIER,ID_USER,ID_CLASSE,ID_MATIERE,DATE_DEPOT,DESCRIPTION,COUR_EXERCICE,LIEN_FICHIER)
     values(:ID_FICHIER,:ID_USER,:ID_CLASSE,:ID_MATIERE, :DATE_DEPOT,:DESCRIPTION,:COUR_EXERCICE,:LIEN_FICHIER)";
                 $reponse_insert_message = $bdd->prepare($requete_insert_message);
                 $insert_message = $reponse_insert_message -> execute(array(
                        'ID_FICHIER' => $id_fichier,
                        'ID_USER' => $user_uploader,
                        'ID_CLASSE' => $id_classe_upload,
                        'ID_MATIERE' => $id_matiere_upload,
                        'DATE_DEPOT' => $date_fichier,
                        'DESCRIPTION' => $description_fichier,
                        'COUR_EXERCICE' => $cour_exercice_upload,
                        'LIEN_FICHIER' => $lien_fichier));

}//fin else
}  else {
    $erreur3 = 4;
}
}//fin try
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$_SESSION['partage_erreur_cour'] = $erreur1 + $erreur2 + $erreur3;
header('location: cour.php');
?>
