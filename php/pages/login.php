<!-- Page de connexion -->

<!DOCTYPE html>
<html lang="fr">

<!-- Head spécifique à la page login.php -->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Intégration de bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
   rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
   integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   <!-- Intégration du CSS -->
   <link rel="stylesheet" href="../../css/style.css" type="text/css" />
   
   <title>Conexion</title>
</head>

<body>
   <!-- Zone de connexion -->
   <main id="main_login">
      <div id="connexion">
         <div id="img_login"><img src="../../img/logo/logo_texte.png"></div>

         <!-- Formulaire de connexion -->
         <form action="../scripts/authentify.php" method="POST">
            <h2>Connexion</h2>

            <!-- Saisie de l'email  -->
            <div class="lab_login">
               <label><i>Email</i></label>
               <input type="email" class="input_login" name="email" placeholder="Entrer l'email" required>
            </div>

            <!-- Saisie du mot de passe  -->
            <div class="lab_login">
               <label><i>Mot de passe</i></label>
               <input type="password" class="input_login" name="password" placeholder="Entrer le mot de passe" required>
            </div>
            
            <div id="check_login">
               <div>
                  <!-- Checkbox pour rester connecté -->
                  <label>Rester connecté</label>
                  <input type="checkbox" name="stay_connected" placeholder="Toujours rester connecté">
               </div>
               <!-- Lien vers la demande d'un nouveau mot de passe -->
               <a href="#">Mot de passe oublié</a>
            </div>

            <!-- Bouton de confirmation  et d'envoi du formulaire -->
            <div id="submit_login_div">
               <input type="submit" id="submit_login" value='Connexion' >
            </div>

         </form>
         
         <!-- Gestion d'erreur des données saisie : affiche une erreur en cas de données incorectes -->
         <?php
         if(isset($_GET['erreur'])) {
               $err = $_GET['erreur'];
               ?> <div class="error" id="error_login">Utilisateur ou mot de passe incorrect</div> <?php
            }
        ?>
      </div>
   </main>
</body>

<!-- Script utilisé pour le diaporama en fond de la page de connexion -->
<script>
   // Tableaux des url d'images à afficher
   let images=new Array('http://localhost/gestionnaire_cellules_2022/img/background/HotelTertiaire_Bat.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/HotelTertiaire_Lieu.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica1_Bat.png', 
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatA.png', 
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatB.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatC.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_Lieu.png');
   
   let i = 0;

   console.log(images);

   // Fonction permettant de changer l'image en background de la page login
   function change() {
      // Si le compteur est au niveau de la dernière image il revient à 0 pour afficher la première
      if (i == images.length)
         i = 0;
      document.getElementById('main_login').setAttribute("style", "background-image: url('" + images[i] + "');");
      i++;
   }

   // La fonction est appelée toutes les 5 sec tant que la page est chargée
   window.onload = function () {
      setInterval(change, 5000);
   };

</script>

</html>