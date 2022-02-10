<?php
   function get_link($url, $structure, $i, $path) {
      $cliked = 'cliked' . $i;
      $link = $url . $structure->id_structure . '&link=' . $i; 
      if(isset($_GET['id']) && $_GET['id'] == $structure->id_structure) { ?>
         <img  src="../../img/icon/right_orange.png" alt="" id="<?php echo($cliked); ?>"
               onclick="dispList('<?php echo($i);?>')">
         <a href="<?php echo($link); ?>" id="selected_structure"><?php echo($structure->nom_structure); ?></a>
      <?php }
      else { ?>
         <img  src="../../img/icon/right_white.png" alt="" id="<?php echo($cliked); ?>"
               onclick="dispList('<?php echo($i);?>', '<?php echo($path);?>')">
         <a href="<?php echo($link); ?>"><?php echo($structure->nom_structure); ?></a>
      <?php } ?>
      <!-- Appel du fichier js regroupant tous les script liés à la page setting_admin.php -->
      <script src="../../js/list.js"></script>
      <?php
   }

   $i = 0;
   $id = 'structure' . $i;
   ?>
   <ul id="lieu">
      <?php
         foreach ($array_structure as $lieu) {
            ?> <li><?php get_link('lieu.php?id=', $lieu, $i, $lieu->path); ?></li> <?php
            $id = 'structure' . $i;
            $i++;
            ?> 
            <ul id="<?php echo($id); ?>">
               <?php     
                  foreach ($lieu->content as $batiment) {
                     $batiment->path = $lieu->path . '/' . $i;
                     ?> <li><?php get_link('batiment.php?id=', $batiment, $i, $batiment->path); ?></li> <?php
                     $id = 'structure' . $i;
                     $i++;
                     ?> 
                     <ul id="<?php echo($id); ?>">
                        <?php
                           foreach ($batiment->content as $etage) {
                              $etage->path = $batiment->path . '/' . $i;
                              ?> <li><?php get_link('etage.php?id=', $etage, $i,  $etage->path); ?></li> <?php
                              $id = 'structure' . $i;
                              $i++;
                              ?> 
                              <ul id="<?php echo($id); ?>">
                                 <?php
                                    foreach ($etage->content as $cellule) {
                                       $cellule->path = $etage->path . '/' . $i;
                                       ?> <li><?php get_link('cellule.php?id=', $cellule, $i, $etage->path); ?></li> <?php
                                       $i++;
                                       
                                    }
                                 ?>
                              </ul>
                              <?php
                           }
                        ?>
                     </ul>
                     <?php
                  }
               ?>
            </ul>
            <?php
         }
      ?>
   </ul>