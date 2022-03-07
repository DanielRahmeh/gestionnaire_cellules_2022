<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_type_equipement = $_POST['type'];
$id_cat_equipement = $_GET['id_cat_equipement'];

$query = $bdd->prepare('DELETE FROM type_equipement
                        WHERE id_type_equipement = :id_type_equipement');
$query->execute(array(
   'id_type_equipement' => $id_type_equipement));

header('Location: ../pages/edit_type_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $id_cat_equipement);
?>