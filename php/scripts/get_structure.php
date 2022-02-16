<?php
$reponse = $bdd->query("SELECT * FROM structure
                        WHERE structure.id_structure = " . $_GET['id']);
while ($donnees = $reponse->fetch()) {
$nom_structure = $donnees['nom_structure'];
$adresse_structure = $donnees['adresse_structure'];
$coordonnees_structure = $donnees['coordonnees_structure'];
$surface_structure = $donnees['surface_structure'];
$image_structure = $donnees['image_structure'];
}
?>