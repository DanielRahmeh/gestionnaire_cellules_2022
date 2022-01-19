// génération d'un mot de passe ou saisie d'un mot de passe
function checkGeneratePass() {
   var checkBox = document.getElementById("generateCheckBox");
   var genPass = document.getElementById("generate_pass");
   var formPass = document.getElementById("form_pass");
   var pass = document.getElementById("pass");
   var nPass = document.getElementById("nPass");

   console.log(checkBox);
   if (checkBox.checked == true || (checkBox.checked == true && window.location.href.includes("param_admin.php?gen=1") == true)){
      genPass.style.display = "block";
      formPass.style.display = "none";
      formPass.setAttribute("pattern", "");
      pass.required = false;
      nPass.required = false;
   } else {
      genPass.style.display = "none";
      formPass.style.display = "block";
   }
}

// vérification des critères de validité d'un mot de passe
var lenPasswordText = document.getElementById("len_password_text");
var lenPasswordVal = document.getElementById("len_password_val");
var lenPasswordCheck = document.getElementById("len_password_check");
function lenPasswordCheckClick() { 
   PasswordCheckClick(lenPasswordCheck, lenPasswordVal, lenPasswordText);
}
var majPasswordText = document.getElementById("maj_password_text");
var majPasswordVal = document.getElementById("maj_password_val");
var majPasswordCheck = document.getElementById("maj_password_check");
function majPasswordCheckClick() { 
   PasswordCheckClick(majPasswordCheck, majPasswordVal, majPasswordText);
}
var minPasswordText = document.getElementById("min_password_text");
var minPasswordVal = document.getElementById("min_password_val");
var minPasswordCheck = document.getElementById("min_password_check");
function minPasswordCheckClick() { 
   PasswordCheckClick(minPasswordCheck, minPasswordVal, minPasswordText);
}
var numPasswordText = document.getElementById("num_password_text");
var numPasswordVal = document.getElementById("num_password_val")
var numPasswordCheck = document.getElementById("num_password_check");
function numPasswordCheckClick() { 
   PasswordCheckClick(numPasswordCheck, numPasswordVal, numPasswordText);
}


function PasswordCheckClick(check, val, text) {
   if (check.checked == true) {
      val.style.display = "block";
      text.style.textDecoration = "none";
      text.innerHTML=('Minimum ' + val.value)
   }
   else {
      val.style.display = "none";
      text.style.textDecoration = "line-through";
      text.innerHTML=('Minimum 0')
   }
}

/*********** Verification de la validité du mot de passe (min 6 CAR, min 1 MAJ, min 1 MIN, min 1 NUM) ***********/
var pass = document.getElementById('pass');

pass.oninvalid = function(event) {
    event.target.setCustomValidity
    ("- Minimum 6 charactère\n- Au moins une MAJ (A-Z)\n- Au moins une MIN (a-z)\n- Au moins une NUM (1-9)");
}

/*********** Verification lors de la validité du mot de passe lors de sa saisie ***********/
var pass = document.getElementById("pass");

function checkLivePassword() {
    if (pass.value.length >= 6)
        document.getElementById("len_pass").innerHTML = "Minimum 6 charactères : oui";
    else
        document.getElementById("len_pass").innerHTML = "Minimum 6 charactères : non";
    if (pass.value != pass.value.toLowerCase())
        document.getElementById("maj_pass").innerHTML = "Minimum une majuscule (A-Z) : oui";
    else
        document.getElementById("maj_pass").innerHTML = "Minimum une majuscule (A-Z) : non";
    if (pass.value != pass.value.toUpperCase())
        document.getElementById("min_pass").innerHTML = "Minimum une minuscule (a-z) : oui";
    else
        document.getElementById("min_pass").innerHTML = "Minimum une minuscule (a-z) : non";
    var hasNumber = /\d/; 
    if (hasNumber.test(pass.value) == true)
        document.getElementById("num_pass").innerHTML = "Minimum un nombre (1-9) : oui";
    else
        document.getElementById("num_pass").innerHTML = "Minimum un nombre (1-9) : non";
}
pass.onkeyup = checkLivePassword;

// Verification de la confirmation du mot de passe
var pass = document.getElementById("pass");
var nPass = document.getElementById("nPass");

function validatePassword(){
    if(pass.value != nPass.value) {
        nPass.setCustomValidity("Le mot de passe ne correspond pas");
    } else {
        nPass.setCustomValidity('');
    }
}
pass.onchange = validatePassword;
nPass.onkeyup = validatePassword;

// Affichage d'un message d'alerte afin de confirmer la création d'un nouveau compte utilisateur
var createButton = document.getElementById("create");

function confirmation() {
    var email = document.getElementById("email");
    var confirmDiv = document.getElementById("confirm");

    if (email.value != '') {
        document.getElementById("confirm_text").innerHTML = ("Etes vous sur de vouloir créer un compte pour " + email.value);
        confirmDiv.style.display = "block";
    }
}

createButton.onclick = confirmation;
