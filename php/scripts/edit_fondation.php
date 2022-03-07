<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_type_equipement = $_GET['id_type_equipement'];
$id_etat = $_POST['etat'];
$id_structure = $_GET['id'];
if ($_FILES["new_image"]["name"] != '') {
   if (isset($_FILES['new_image']))
      move_uploaded_file($_FILES["new_image"]["tmp_name"], "../../img/structures/" . $_FILES["new_image"]["name"]);
   $image_structure = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["new_image"]["name"]; 
}
$commentaire = $_POST['commentaire'];
$date = date('Y-m-d');


if (isset($_GET['id_fondation'])) {
   $id_fondation = $_GET['id_fondation'];
   $query = $bdd->prepare('UPDATE fondation 
                           SET id_etat = :id_etat, commentaire = :commentaire, date = :date
                           WHERE id_fondation = :id_fondation');
   $query->execute(array(
      'id_etat' => $id_etat,
      'commentaire' => $commentaire,
      'date' => $date,
      'id_fondation' => $id_fondation));

      if ($_FILES["new_image"]["name"] != '') {
         if (isset($_FILES['new_image']))
            move_uploaded_file($_FILES["new_image"]["tmp_name"], "../../img/etat/" . $_FILES["new_image"]["name"]);
         $image_structure = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["new_image"]["name"]; 
         $query = $bdd->prepare('UPDATE fondation 
                                 SET image_structure = :image_structure
                                 WHERE id_fondation = :id_fondation');
         $query->execute(array(
            'image_structure' => $image_structure,
            'id_fondation' => $id_fondation));
      }
}

else {
   if ($_FILES["new_image"]["name"] != '') {
      if (isset($_FILES['new_image']))
         move_uploaded_file($_FILES["new_image"]["tmp_name"], "../../img/etat/" . $_FILES["new_image"]["name"]);
      $image_structure = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["new_image"]["name"]; 
   }
   else {
      if ($id_type_equipement == 1) {
         $image_structure = 'https://rahmeh.fr/gdc/img/etat/default_mur.jpg'; 
      }
      if ($id_type_equipement == 2) {
         $image_structure = 'https://rahmeh.fr/gdc/img/etat/default_plafond.jpg'; 
      }
      if ($id_type_equipement == 3) {
         $image_structure = 'https://rahmeh.fr/gdc/img/etat/default_sol.jpg'; 
      }
   }
   $query = $bdd->prepare('INSERT INTO fondation(id_type_equipement, id_etat, id_structure, image_structure, commentaire, date)
                           VALUES(:id_type_equipement, :id_etat, :id_structure, :image_structure, :commentaire, :date)');
   $query->execute(array(
      'id_type_equipement' => $id_type_equipement,
      'id_etat' => $id_etat,
      'id_structure' => $id_structure,
      'image_structure' => $image_structure,
      'commentaire' => $commentaire,
      'date' => $date));
}

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);

?>