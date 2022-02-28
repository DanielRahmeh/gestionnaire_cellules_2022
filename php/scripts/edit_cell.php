<?php
// Script traitant les données du formulaires de mofification de cellule

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

echo 'type : ' . ($_POST['modify']) . '<br />';
echo 'catégorie : ' . ($_POST['cat']) . '<br />';
echo 'nouvelle catégorie : ' . ($_POST['new-cat']) . '<br />';
echo 'nouveau type : ' . ($_POST['new-type']) . '<br />';
echo 'surface : ' . ($_POST['surface']) . '<br />';
echo 'nouvelle image : ' . ($_POST['new-image']) . '<br /><br /><br />';
$id_structure = $_GET['id'];

if ($_POST['modify'] != '/' && $_POST['modify'] != '-' ) {
   $id_type_cellule = $_POST['modify'];
   $query = $bdd->prepare('UPDATE cellule SET id_type_cellule = :id_type_cellule WHERE id_structure = :id_structure');
   $query->execute(array(
      'id_type_cellule' => $id_type_cellule,
      'id_structure' => $id_structure));
}

if ($_POST['modify'] == '/' && $_POST['cat'] != '/') {
   $id_cat_cellule = $_POST['cat'];
   $libelle = $_POST['new-type'];
   echo $id_cat_cellule . ' ' . $libelle;
   $reponse = $bdd->query("SELECT * FROM type_cellule");
   $count = 0;
   while ($donnees = $reponse->fetch()) {
      if ($libelle == $donnees['libelle'])
         $count++;
      $id_type_cellule = $donnees['id_type_cellule'] + 1;
   }
   if ($count != 0)
      header('Location: ../pages/cellule.php?error=1&id=' . $_GET['id'] . '&link=' . $_GET['link']);
   else {
   $query = $bdd->prepare('INSERT INTO type_cellule(id_type_cellule, id_cat_cellule, libelle)
                           VALUES(:id_type_cellule, :id_cat_cellule, :libelle)');
   $query->execute(array(
      'id_type_cellule' => $id_type_cellule,
      'id_cat_cellule' => $id_cat_cellule,
      'libelle' => $libelle));
   $query = $bdd->prepare('UPDATE cellule SET id_type_cellule = :id_type_cellule WHERE id_structure = :id_structure');
   $query->execute(array(
      'id_type_cellule' => $id_type_cellule,
      'id_structure' => $id_structure));
   }
}

if ($_POST['modify'] == '/' && $_POST['cat'] == '/') {
   echo'bonjour';
   $libelle = $_POST['new-cat'];
   $reponse = $bdd->query("SELECT * FROM cat_cellule");
   $count = 0;
   while ($donnees = $reponse->fetch()) {
      if ($libelle == $donnees['libelle']){
         $count = $donnees['id_cat_cellule'];
      }
      $id_cat_cellule = $donnees['id_cat_cellule'] + 1;
   }
   if ($count != 0)
      $id_cat_cellule = $count;
   else {
   $query = $bdd->prepare('INSERT INTO cat_cellule(id_cat_cellule, libelle)
                           VALUES(:id_cat_cellule, :libelle)');
   $query->execute(array(
      'id_cat_cellule' => $id_cat_cellule,
      'libelle' => $libelle));
   }
   $libelle = $_POST['new-type'];
   $reponse = $bdd->query("SELECT * FROM type_cellule");
   $count = 0;
   while ($donnees = $reponse->fetch()) {
      if ($libelle == $donnees['libelle'])
         $count = $donnees['id_type_cellule'];
      $id_type_cellule = $donnees['id_type_cellule'] + 1;
   }
   if ($count != 0)
   $id_type_cellule = $count;
   else {
      $query = $bdd->prepare('INSERT INTO type_cellule(id_type_cellule, id_cat_cellule, libelle)
                              VALUES(:id_type_cellule, :id_cat_cellule, :libelle)');
      $query->execute(array(
         'id_type_cellule' => $id_type_cellule,
         'id_cat_cellule' => $id_cat_cellule,
         'libelle' => $libelle));
      $query = $bdd->prepare('UPDATE cellule SET id_type_cellule = :id_type_cellule WHERE id_structure = :id_structure');
      $query->execute(array(
         'id_type_cellule' => $id_type_cellule,
         'id_structure' => $id_structure));
   }
}

if ($_POST['surface'] != '') {
   $surface_structure = $_POST['surface'];
   $query = $bdd->prepare('UPDATE structure SET surface_structure = :surface_structure WHERE id_structure = :id_structure');
   $query->execute(array(
      'surface_structure' => $surface_structure,
      'id_structure' => $id_structure));
}

if ($_FILES["new-image"]["name"] != '') {
   if (isset($_FILES['new-image']))
      move_uploaded_file($_FILES["new-image"]["tmp_name"], "../../img/structures/" . $_FILES["new-image"]["name"]);
   $image_structure = 'https://rahmeh.fr/gdc/img/structure/' . $_FILES["new-image"]["name"];
   $query = $bdd->prepare('UPDATE structure SET image_structure = :image_structure WHERE id_structure = :id_structure');
   $query->execute(array(
      'image_structure' => $image_structure,
      'id_structure' => $id_structure));
}


header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>