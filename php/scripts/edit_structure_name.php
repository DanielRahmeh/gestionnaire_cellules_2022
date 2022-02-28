<?php 
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_structure = $_GET['id'];
$nom_structure = $_POST['new_title'];
$query = $bdd->prepare('UPDATE structure SET nom_structure = :nom_structure WHERE id_structure = :id_structure');
$query->execute(array(
   'nom_structure' => $nom_structure,
   'id_structure' => $id_structure));

header("Location: ../pages/" . $_GET['rang'] . ".php?id=" . $_GET['id'] . "&link=" . $_GET['link']);
?>