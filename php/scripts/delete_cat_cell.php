<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_cat_cellule = $_POST['cat'];
$id_type_cellule = 12;


$query = $bdd->prepare('UPDATE cellule, type_cellule, cat_cellule 
                        SET cellule.id_type_cellule = :id_type_cellule 
                        WHERE cellule.id_type_cellule = type_cellule.id_type_cellule
                        AND type_cellule.id_cat_cellule = :id_cat_cellule ');
$query->execute(array(
   'id_type_cellule' => $id_type_cellule,
   'id_cat_cellule' => $id_cat_cellule));
$query = $bdd->prepare('DELETE FROM type_cellule 
                        WHERE id_cat_cellule = :id_cat_cellule');
$query->execute(array(
   'id_cat_cellule' => $id_cat_cellule));
$query = $bdd->prepare('DELETE FROM cat_cellule 
                        WHERE id_cat_cellule = :id_cat_cellule');
$query->execute(array(
   'id_cat_cellule' => $id_cat_cellule));

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>