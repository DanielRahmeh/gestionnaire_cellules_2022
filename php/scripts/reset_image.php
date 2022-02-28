<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$image_structure = 'https://rahmeh.fr/gdc/img/structure/Numerica1_Lieu.jpg';
$id_structure = $_GET['id'];
$query = $bdd->prepare('UPDATE structure SET image_structure = :image_structure WHERE id_structure = :id_structure');
$query->execute(array(
   'image_structure' => $image_structure,
   'id_structure' => $id_structure));
header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>