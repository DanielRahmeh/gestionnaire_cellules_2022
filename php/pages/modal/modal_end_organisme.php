<div class="modal fade" id="endOrganisme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 10px;">
         <h3 class="modal-title" id="exampleModalLongTitle">Fin de location</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <?php
         $url = '../scripts/end_bail.php?id_bail=' . $id_bail . '&id=' . $_GET['id'] . '&link=' . $_GET['link'];
         ?>
         <form action="<?php echo($url); ?>" method="POST" class="form-modal">
            <p>Etes-vous sur de vouloir mettre fin à la location ?</p>
               <input type="submit" value="Mettre fin à la location" class="modal-submit">
         </form>
      </div>
      </div>
   </div>
</div>