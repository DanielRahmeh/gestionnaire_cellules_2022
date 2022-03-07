<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_organisme = $_POST['organisme'];

$query = $bdd->prepare('DELETE FROM bail
                        WHERE id_organisme = :id_organisme');
$query->execute(array(
   'id_organisme' => $id_organisme));

$query = $bdd->prepare('DELETE FROM organisme
                        WHERE id_organisme = :id_organisme');
$query->execute(array(
   'id_organisme' => $id_organisme));

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>