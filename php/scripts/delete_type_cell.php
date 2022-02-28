<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_type_cellule = $_POST['type'];

$query = $bdd->prepare('UPDATE cellule, type_cellule, cat_cellule 
                        SET cellule.id_type_cellule = 12
                        WHERE cellule.id_type_cellule = :id_type_cellule');
$query->execute(array(
   'id_type_cellule' => $id_type_cellule));

$query = $bdd->prepare('DELETE FROM type_cellule 
                        WHERE id_type_cellule = :id_type_cellule');
$query->execute(array(
   'id_type_cellule' => $id_type_cellule));

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>