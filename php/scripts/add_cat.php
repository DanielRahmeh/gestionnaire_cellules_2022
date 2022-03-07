<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$libelle = $_POST['libelle'];
if ($_FILES["image"]["name"] != '') {
   if (isset($_FILES['image']))
      move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/etat/" . $_FILES["image"]["name"]);
   $image = 'https://rahmeh.fr/gdc/img/etat/' . $_FILES["image"]["name"]; 
}

else {
   $image = 'https://rahmeh.fr/gdc/img/etat/default_categorie.jpg'; 
}

$query = $bdd->prepare('INSERT INTO cat_equipement(libelle, image)
                        VALUES(:libelle, :image)');
$query->execute(array(
   'libelle' => $libelle,
   'image' => $image));

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>