<?php
// Fonction permettant d'établir un tableau des cellules sous location que composent la structure affichée

function find_cell($array_structure, $id, $bdd) {

   $array_cel = array("nom" => array(),
                     "id" => array(),
                     "link" => array(),
                     "etage" => array(),
                     "batiment" => array(),
                     "lieu" => array(),
                     "organisme" => array());
   $date = date('Y-m-d');
   $check = 0;
   foreach ($array_structure as $lieu) {
      if ($id == $lieu->id_structure) {
         $check = 1;
      }
      foreach ($lieu->content as $batiment) {
         if ($id == $batiment->id_structure) {
            $check = 2;
         }
         foreach ($batiment->content as $etage) {
            if ($id == $etage->id_structure) {
               $check = 3;
            }
            foreach ($etage->content as $cellule) {
               if ($check > 0){
                  $count = 0;
                  $reponse = $bdd->query("SELECT organisme.nom_organisme 
                                          FROM cellule, bail, organisme
                                          WHERE cellule.id_structure = '$cellule->id_structure'
                                          AND cellule.id_cellule = bail.id_cellule
                                          AND (bail.date_sortie >= '$date' OR bail.date_sortie = 0000-00-00)
                                          AND bail.id_organisme = organisme.id_organisme");
                  while ($donnees = $reponse->fetch()) {
                     $count++;
                     $organisme = $donnees['nom_organisme'];
                  }
                  if ($count == 1)
                     array_push($array_cel['organisme'],  $organisme);
                  else
                     array_push($array_cel['organisme'],  '/');
                  array_push($array_cel['nom'],  $cellule->nom_structure);
                  array_push($array_cel['id'],  $cellule->id_structure);
                  array_push($array_cel['link'],  $cellule->link_structure);
                  array_push($array_cel['etage'],  $etage->nom_structure);
                  array_push($array_cel['batiment'],  $batiment->nom_structure);
                  array_push($array_cel['lieu'],  $lieu->nom_structure);
               }
            }
            if ($check == 3)
               $check = 0;
         }
         if ($check == 2)
            $check = 0;
      }
      if ($check == 1)
         $check = 0;
   }
   return($array_cel);
}
?>