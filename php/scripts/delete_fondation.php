<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }

   $id_fondation = $_GET['id_fondation'];

   $query = $bdd->prepare('DELETE FROM fondation
                           WHERE id_fondation = :id_fondation');
   $query->execute(array(
      'id_fondation' => $id_fondation));

   header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>