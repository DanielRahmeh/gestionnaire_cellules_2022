<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_bail = $_GET['id_bail'];
$query = $bdd->prepare('DELETE FROM bail WHERE id_bail = :id_bail');
$query->execute(array(
   'id_bail' => $id_bail));

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>