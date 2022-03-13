<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$id_structure = $_GET['id'];
$image_structure = $_POST['plan'];

if ($_FILES["plan"]["name"] != '') {
   if (isset($_FILES['plan']))
      move_uploaded_file($_FILES["plan"]["tmp_name"], "../../img/structures/" . $_FILES["plan"]["name"]);
   $image_structure = 'https://rahmeh.fr/gdc/img/structure/' . $_FILES["plan"]["name"];
   $query = $bdd->prepare('UPDATE structure SET image_structure = :image_structure WHERE id_structure = :id_structure');
   $query->execute(array(
      'image_structure' => $image_structure,
      'id_structure' => $id_structure));
}

header('Location: ../pages/etage.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);

?>