<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_type_equipement = $_POST['type'];
$libelle = $_POST['libelle'];


if ($libelle != '') {
   $query = $bdd->prepare('UPDATE type_equipement
                           SET libelle = :libelle
                           WHERE  id_type_equipement = :id_type_equipement');
   $query->execute(array(
      'libelle' => $libelle,
      'id_type_equipement' => $id_type_equipement));
}

header('Location: ../pages/edit_type_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_type_equipement=' . $id_type_equipement);
?>