<?php

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

echo 'organimse : ' . $_POST['organisme'] . '<br />';
echo 'new_organimse : ' . $_POST['new_organisme'] . '<br />';
echo 'tel_organimse : ' . $_POST['tel_organisme'] . '<br />';
echo 'date_entree : ' . $_POST['date_entree'] . '<br />';
echo 'date_sortie : ' . $_POST['date_sortie'] . '<br />';
if (isset($_POST['undifinied_date_sortie'])) {
   echo 'oui' . '<br />';
}
else {
   echo 'non' .  '<br />';
}


$id_organisme = $_POST['organisme'];
$tel_organisme = $_POST['tel_organisme'];
$id_structure = $_GET['id'];

if ($_POST['date_entree'] == '') {
   $date_entree = date('Y-m-d');
}

else {
   $date_entree = $_POST['date_entree'];
}

if (isset($_GET['id_bail'])) {
   $id_bail = $_GET['id_bail'];
   if ($id_organisme != '/' && $id_organisme != '-') {
      $query = $bdd->prepare('UPDATE bail SET id_organisme = :id_organisme WHERE id_bail = :id_bail');
      $query->execute(array(
         'id_organisme' => $id_organisme,
         'id_bail' => $id_bail));
   }
   
   if (isset($_POST['new_organisme']) && ($_POST['new_organisme']!= '')) {
      $nom_organisme = $_POST['new_organisme'];
      $reponse = $bdd->query("SELECT *
                              FROM organisme");
      $count = 0;
      while ($donnees = $reponse->fetch()) {
         if ($donnees['nom_organisme'] == $nom_organisme) {
            $count = 1;
         }
      }
      if ($count == 0) {
         $query = $bdd->prepare('INSERT INTO organisme(nom_organisme, tel_organisme)
                                 VALUES(:nom_organisme, :tel_organisme)');
         $query->execute(array(
            'nom_organisme' => $nom_organisme,
            'tel_organisme' => $tel_organisme));
         $reponse = $bdd->query("SELECT *
                                 FROM organisme
                                 WHERE nom_organisme = '$nom_organisme'");
         while ($donnees = $reponse->fetch()) {
            $id_organisme = $donnees['id_organisme'];
         }
         $query = $bdd->prepare('UPDATE bail SET id_organisme = :id_organisme WHERE id_bail = :id_bail');
         $query->execute(array(
            'id_organisme' => $id_organisme,
            'id_bail' => $id_bail));
      }
   }
   
   $query = $bdd->prepare('UPDATE bail SET date_entree = :date_entree WHERE id_bail = :id_bail');
   $query->execute(array(
      'date_entree' => $date_entree,
      'id_bail' => $id_bail));
   
   if (!isset($_POST['undifined_tel'])) {
      echo('non');
      $query = $bdd->prepare('UPDATE organisme SET tel_organisme = :tel_organisme WHERE id_organisme = :id_organisme');
      $query->execute(array(
         'tel_organisme' => $tel_organisme,
         'id_organisme' => $id_organisme));
   }
   else {
      echo'oui';
      $reponse = $bdd->query("SELECT *
                              FROM organisme
                              WHERE id_organisme = '$id_organisme'");
      while ($donnees = $reponse->fetch()) {
         $tel_organisme = $donnees['tel_organisme'];
      }
      $query = $bdd->prepare('UPDATE organisme SET tel_organisme = :tel_organisme WHERE id_organisme = :id_organisme');
      $query->execute(array(
         'tel_organisme' => $tel_organisme,
         'id_organisme' => $id_organisme));
   }
   
   if (isset($_POST['undifined_date_sortie'])) {
      $date_sortie = '0000-00-00';
      $query = $bdd->prepare('UPDATE bail SET date_sortie = :date_sortie WHERE id_bail = :id_bail');
      $query->execute(array(
         'date_sortie' => $date_sortie,
         'id_bail' => $id_bail));
   }
   else {
      $date_sortie = $donnees['date_sortie'];
      $query = $bdd->prepare('UPDATE bail SET date_sortie = :date_sortie WHERE id_bail = :id_bail');
      $query->execute(array(
         'date_sortie' => $date_sortie,
         'id_bail' => $id_bail));
   } 
}

else {
   if ($_POST['organisme'] != '/') {
      $id_organisme = $_POST['organisme'];
      if (!isset($_POST['undifined_tel']))
         $tel_organisme = $_POST['tel_organisme'];
      else {
         $reponse = $bdd->query("SELECT *
                                 FROM organisme
                                 WHERE id_organisme = '$id_organisme'");
         while ($donnees = $reponse->fetch()) {
            $tel_organisme = $donnees['tel_organisme'];
         }
      }
   }
   else {
      $nom_organisme = $_POST['new_organisme'];
      $reponse = $bdd->query("SELECT *
                              FROM organisme");
      $count = 0;
      while ($donnees = $reponse->fetch()) {
         if ($donnees['nom_organisme'] == $_POST['new_organisme']) {
            $count = 1;
         }
      }
      if ($count == 0) {
         $query = $bdd->prepare('INSERT INTO organisme(nom_organisme, tel_organisme)
                                 VALUES(:nom_organisme, :tel_organisme)');
         $query->execute(array(
         'nom_organisme' => $nom_organisme,
         'tel_organisme' => $tel_organisme));
         $reponse = $bdd->query("SELECT *
                                 FROM organisme
                                 WHERE nom_organisme = '$nom_organisme'");
         while ($donnees = $reponse->fetch()) {
            $id_organisme = $donnees['id_organisme'];
         }
      }
   }
   if (isset($_POST['undifined_date_sortie']))
      $date_sortie = '0000-00-00';
   else
      $date_sortie = $_POST['date_sortie'];
   echo $id_organisme . ' ' . $date_entree . ' ' . $date_sortie;
   $reponse = $bdd->query("SELECT *
                           FROM cellule
                           WHERE id_structure = '$id_structure'");
   while ($donnees = $reponse->fetch()) {
      $id_cellule = $donnees['id_cellule'];
   }
   $query = $bdd->prepare('INSERT INTO bail(id_organisme, id_cellule, date_entree, date_sortie)
                           VALUES(:id_organisme, :id_cellule, :date_entree, :date_sortie)');
   $query->execute(array(
      'id_organisme' => $id_organisme,
      'id_cellule' => $id_cellule,
      'date_entree' => $date_entree,
      'date_sortie' => $date_sortie));
}

header('Location: ../pages/cellule.php?id=' . $_GET['id'] . '&link=' . $_GET['link']);
?>