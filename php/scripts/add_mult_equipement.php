<?php
// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$num = $_POST['num'];
$id_type_equipement = $_POST['type'];
$id_structure = $_GET['id'];

$reponse = $bdd->query("SELECT *
                        FROM equipement
                        LEFT JOIN type_equipement ON equipement.id_type_equipement = type_equipement.id_type_equipement
                        WHERE equipement.id_type_equipement = '$id_type_equipement'
                        AND equipement.id_structure = '$id_structure'");
$i = 1;
while ($donnees = $reponse->fetch()) {
   $libelle = $donnees['libelle'];
   $i++;
}
if ($i == 1) {
   $reponse = $bdd->query("SELECT *
                           FROM type_equipement
                           WHERE type_equipement.id_type_equipement = '$id_type_equipement'");
   $i = 1;
   while ($donnees = $reponse->fetch()) {
      $libelle = $donnees['libelle'];
   }
}

$num += $i;
$image = 'https://rahmeh.fr/gdc/img/etat/default_categorie.jpg'; 

$id_etat = 1;
$date = date('Y-m-d');

for ($i = $i; $i < $num; $i++) {
   $nom_equipement = $libelle . ' ' . $i;
   $query = $bdd->prepare('INSERT INTO equipement(id_type_equipement,
                                                   id_etat,
                                                   id_structure,
                                                   nom_equipement,
                                                   image,
                                                   date)
                           VALUES(:id_type_equipement,
                                 :id_etat,
                                 :id_structure,
                                 :nom_equipement,
                                 :image,
                                 :date)');
$query->execute(array(
   'id_type_equipement' => $id_type_equipement,
   'id_etat' => $id_etat,
   'id_structure' => $id_structure,
   'nom_equipement' => $nom_equipement,
   'image' => $image,
   'date' => $date));
}


header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>