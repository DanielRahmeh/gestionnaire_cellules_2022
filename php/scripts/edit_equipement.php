<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_structure = $_GET['id'];
$id_type_equipement = $_POST['type'];
if ($_POST['nom_equipement'] == '') {
   
   $reponse = $bdd->query("SELECT *
                           FROM equipement
                           LEFT JOIN type_equipement ON equipement.id_type_equipement = type_equipement.id_type_equipement
                           WHERE equipement.id_type_equipement = '$id_type_equipement'
                           AND equipement.id_structure = '$id_structure'");
   $i = 1;
   while ($donnees = $reponse->fetch()) {
      $libelle = $donnees['libelle'];
      $i++;
   }
   if ($i == 1) {
      $reponse = $bdd->query("SELECT *
                              FROM type_equipement
                              WHERE type_equipement.id_type_equipement = '$id_type_equipement'");
      $i = 1;
      while ($donnees = $reponse->fetch()) {
         $libelle = $donnees['libelle'];
      }
   }
   $nom_equipement = $libelle . ' ' . $i;
   echo $nom_equipement;
}
else {
   $nom_equipement = $_POST['nom_equipement'];
   echo $nom_equipement;
}
$id_etat = $_POST['etat'];
$code_equipement = $_POST['code_equipement'];
$serial_equipement = $_POST['serial_equipement'];
$prix_equipement = $_POST['prix_equipement'];
$date_achat = $_POST['date_achat'];
$date_maintenance = $_POST['date_maintenance'];
$date_fin = $_POST['date_fin'];
$commentaire = $_POST['commentaire'];
$date = date('Y-m-d');

if (isset($_GET['id_equipement'])) {
   $id_equipement = $_GET['id_equipement'];
   if ($_FILES["image"]["name"] != '') {
      if (isset($_FILES['image']))
         move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/etat/" . $_FILES["image"]["name"]);
      $image = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["image"]["name"];
      $query = $bdd->prepare('UPDATE equipement
                              SET image = :image
                              WHERE  id_equipement = :id_equipement');
      $query->execute(array(
         'image' => $image,
         'id_equipement' => $id_equipement));
   }
   $query = $bdd->prepare('UPDATE equipement
                           SET id_type_equipement = :id_type_equipement,
                           id_etat = :id_etat,
                           nom_equipement = :nom_equipement,
                           code_equipement = :code_equipement,
                           serial_equipement = :serial_equipement,
                           prix_equipement = :prix_equipement,
                           date_achat = :date_achat,
                           date_maintenance = :date_maintenance,
                           date_fin = :date_fin,
                           commentaire = :commentaire,
                           date = :date
                           WHERE  id_equipement = :id_equipement');
   $query->execute(array(
      'id_type_equipement' => $id_type_equipement,
      'id_etat' => $id_etat,
      'nom_equipement' => $nom_equipement,
      'code_equipement' => $code_equipement,
      'serial_equipement' => $serial_equipement,
      'prix_equipement' => $prix_equipement,
      'date_achat' => $date_achat,
      'date_maintenance' => $date_maintenance,
      'date_fin' => $date_fin,
      'commentaire' => $commentaire,
      'date' => $date,
      'id_equipement' => $id_equipement));
}

else {
   if ($_FILES["image"]["name"] != '') {
      if (isset($_FILES['image']))
         move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/etat/" . $_FILES["image"]["name"]);
      $image = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["image"]["name"]; 
   }
   else {
      $image = 'https://rahmeh.fr/gdc/img/etat/default_categorie.jpg'; 
   }
   $query = $bdd->prepare('INSERT INTO equipement(id_type_equipement,
                                                id_etat,
                                                id_structure,
                                                nom_equipement,
                                                code_equipement,
                                                serial_equipement,
                                                prix_equipement,
                                                date_achat,
                                                date_maintenance,
                                                date_fin,
                                                commentaire,
                                                image,
                                                date)
                           VALUES(:id_type_equipement,
                                 :id_etat,
                                 :id_structure,
                                 :nom_equipement,
                                 :code_equipement,
                                 :serial_equipement,
                                 :prix_equipement,
                                 :date_achat,
                                 :date_maintenance,
                                 :date_fin,
                                 :commentaire,
                                 :image,
                                 :date)');
   $query->execute(array(
      'id_type_equipement' => $id_type_equipement,
      'id_etat' => $id_etat,
      'id_structure' => $id_structure,
      'nom_equipement' => $nom_equipement,
      'code_equipement' => $code_equipement,
      'serial_equipement' => $serial_equipement,
      'prix_equipement' => $prix_equipement,
      'date_achat' => $date_achat,
      'date_maintenance' => $date_maintenance,
      'date_fin' => $date_fin,
      'commentaire' => $commentaire,
      'image' => $image,
      'date' => $date));
}

if (!isset($_GET['id_equipement'])) {
   $reponse = $bdd->query("SELECT MAX(id_equipement)
                           FROM equipement");   
   while ($donnees = $reponse->fetch()) {
      $id_equipement = $donnees['id_equipement'];
   }
}

header('Location: ../pages/equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_equipement=' . $_GET['id_equipement'] . '&id_cat_equipement='. $_GET['id_cat_equipement']);

?>