<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_cat_equipement = $_POST['cat'];
$libelle = $_POST['libelle'];
if ($_FILES["image"]["name"] != '') {
   if (isset($_FILES['image']))
      move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/etat/" . $_FILES["image"]["name"]);
   $image = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["image"]["name"]; 
   $query = $bdd->prepare('UPDATE cat_equipement
                        SET image = :image
                        WHERE  id_cat_equipement = :id_cat_equipement');
   $query->execute(array(
      'image' => $image,
      'id_cat_equipement' => $id_cat_equipement));
}

if ($libelle != '') {
   $query = $bdd->prepare('UPDATE cat_equipement
                           SET libelle = :libelle
                           WHERE  id_cat_equipement = :id_cat_equipement');
   $query->execute(array(
      'libelle' => $libelle,
      'id_cat_equipement' => $id_cat_equipement));
}

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>