<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }

   $id_cat_equipement = $_POST['cat'];

   $query = $bdd->prepare('DELETE FROM cat_equipement
                           WHERE id_cat_equipement = :id_cat_equipement');
   $query->execute(array(
      'id_cat_equipement' => $id_cat_equipement));

   header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>