<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <?php
      session_start();
      if($_SESSION['email'] != "") {
         $email = $_SESSION['email'];
         $admin = $_SESSION['admin'];
         include('header/settings_admin_header.php');
      }
   ?>
   <main>
      <!-- Formulaire de création d'un nouveau compte utilisateur -->
      <div id="new_user_container">
         <h3>Créer un nouveau compte utilisateur</h3><br />
         <form name="new_user" method="POST" action="../scripts/new_user.php">
            <!-- Champs pour l'email -->
            <div class="elem_setting">
               <label>Email</label><br />
               <input type="email" id="email" placeholder="Entrer l'email" name="email" title="Adresse email valide" required>
            </div>
            <div class="elem_setting" id="generate" >
               <label>Genérer un mot de passe</label>
               <input type="checkbox"  name="generate" id="generateCheckBox" title="Le mot de passe sera envoyé par mail" onclick="checkGeneratePass()">
            </div>
            <div class="elem_setting" id="form_pass">
               <!-- Champs pour le mot de passe -->
               <label>Mot de passe</label><br />
               <input type="password" id="pass" placeholder="Entrer le mot de passe" name="pass" 
               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,40}$" 
               title="- Minimum 6 charactère &#10;- Au moins une MAJ (A-Z) &#10;- Au moins une MIN (a-z) &#10;- Au moins un NUM (1-9)"
               required>
               <br />
               <div id="check_pass">
                  <div id="len_pass">Minimum 6 charactères : non</div>
                  <div id="maj_pass">Minimum une majuscule (A-Z) : non</div>
                  <div id="min_pass">Minimum une minuscule (a-z) : non</div>
                  <div id="num_pass">Minimum un nombre (1-9) : non</div>
               </div>
            </div>
            <!-- Champs pour la confirmation de mot de passe -->
            <div class="elem_setting">
               <label>Confirmation mot de passe</label><br />
               <input type="password" id="nPass" placeholder="Confirmer le mot de passe" name="nPass" 
               title="Confirmer le mot de passe" required>
            </div>
            <div id="generate_pass" style="display:none">
                  Un mot de passe sera généré et sera envoyé directement par mail.
            </div>
            <!-- Checkbox pour accorder les droits administrateurs -->
            <div class="elem_setting">
               <label>Droits administrateurs</label>
               <input type="checkbox"  id="rights" name="rights" title="Accorder les droits administrateurs au compte">
            </div>
            <div class="elem_setting">
               <button id="create" type="button">Créer</button>
               <div id="confirm" style="display: none;">
                     <div id="confirm_text"></div>
                     <button type="button" onclick="location.href='param_admin.php'">non</button>
                     <input type="submit" id='submit' value='oui' title="Confirmer la création du compte">
               </div> 
            </div>  
         </form>
      </div>
   </main>
   <script src="../../js/settings_admin.js"></script>
</body>
</html>