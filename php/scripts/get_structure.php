<?php
// Fichier permettant de récupérer les données de la structure affichée

$reponse = $bdd->query("SELECT * FROM structure
                        WHERE structure.id_structure = " . $_GET['id']);
while ($donnees = $reponse->fetch()) {
$nom_structure = $donnees['nom_structure'];
$adresse_structure = $donnees['adresse_structure'];
$coordonnees_structure = $donnees['coordonnees_structure'];
$surface_structure = $donnees['surface_structure'];
$image_structure = $donnees['image_structure'];
}

$reponse = $bdd->query("SELECT * FROM cellule");
while ($donnees = $reponse->fetch()) {
   if($donnees['id_structure'] ==  $_GET['id'])
      $id_cellule = $donnees['id_cellule'];
}
?>