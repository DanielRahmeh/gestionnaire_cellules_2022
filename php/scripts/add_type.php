<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$libelle = $_POST['libelle'];
$id_cat_equipement = $_GET['id_cat_equipement'];

$query = $bdd->prepare('INSERT INTO type_equipement(id_cat_equipement, libelle)
                        VALUES(:id_cat_equipement, :libelle)');
$query->execute(array(
   'id_cat_equipement' => $id_cat_equipement,
   'libelle' => $libelle));

header('Location: ../pages/edit_type_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $id_cat_equipement);
?>