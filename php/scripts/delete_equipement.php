<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }

   $id_equipement = $_GET['id_equipement'];

   $query = $bdd->prepare('DELETE FROM equipement
                           WHERE id_equipement = :id_equipement');
   $query->execute(array(
      'id_equipement' => $id_equipement));

   header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>