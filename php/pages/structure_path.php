<?php
// Fichier permettant d'affiche le chemin de la structure affichée

// echo('<pre>');
// print_r($tab_path);
// echo('</pre>');
?> <p class="path"> <?php
for($i = 0; $i < count($tab_path['level']); $i++) {
   echo(' / ');
   if ($i != count($tab_path['level']) - 1) {
      $link = $tab_path['level'][$i] . '.php?id=' . $tab_path['id'][$i]  . '&link=' . $tab_path['link'][$i] ;
      ?> <a href="<?php echo($link); ?>"><?php echo($tab_path['name'][$i] ); ?></a> <?php
   }
   else {
      ?><?php echo($tab_path['name'][$i] ); ?> <?php
   }
}
?> </p>