// génération d'un mot de passe ou saisie d'un mot de passe
function checkGeneratePass() {
   var checkBox = document.getElementById("generateCheckBox");
   var genPass = document.getElementById("generate_pass");
   var formPass = document.getElementById("form_pass");
   var confirmPass = document.getElementById("confirm_pass");
   var pass = document.getElementById("pass");
   var nPass = document.getElementById("nPass");

   console.log(checkBox);
   if (checkBox.checked == true || (checkBox.checked == true && window.location.href.includes("param_admin.php?gen=1") == true)){
      genPass.style.display = "block";
      formPass.style.display = "none";
      confirmPass.style.display = "none";
      formPass.setAttribute("pattern", "");
      pass.required = false;
      nPass.required = false;
   } else {
      genPass.style.display = "none";
      formPass.style.display = "block";
      confirmPass.style.display = "block";
   }
}

// vérification des critères de validité d'un mot de passe
var lenPasswordText = document.getElementById("len_password_text");
var lenPasswordVal = document.getElementById("len_password_val");
var lenPasswordCheck = document.getElementById("len_password_check");
var lenPasswordIco = document.getElementById("len_password_ico");
function lenPasswordCheckClick() { 
   PasswordCheckClick(lenPasswordCheck, lenPasswordVal, lenPasswordText, lenPasswordIco, 0);
}
var majPasswordText = document.getElementById("maj_password_text");
var majPasswordVal = document.getElementById("maj_password_val");
var majPasswordCheck = document.getElementById("maj_password_check");
var majPasswordIco = document.getElementById("maj_password_ico");
function majPasswordCheckClick() { 
   PasswordCheckClick(majPasswordCheck, majPasswordVal, majPasswordText, majPasswordIco, 1);
}
var minPasswordText = document.getElementById("min_password_text");
var minPasswordVal = document.getElementById("min_password_val");
var minPasswordCheck = document.getElementById("min_password_check");
var minPasswordIco = document.getElementById("min_password_ico");
function minPasswordCheckClick() { 
   PasswordCheckClick(minPasswordCheck, minPasswordVal, minPasswordText, minPasswordIco, 2);
}
var numPasswordText = document.getElementById("num_password_text");
var numPasswordVal = document.getElementById("num_password_val")
var numPasswordCheck = document.getElementById("num_password_check");
var numPasswordIco = document.getElementById("num_password_ico");
function numPasswordCheckClick() { 
   PasswordCheckClick(numPasswordCheck, numPasswordVal, numPasswordText, numPasswordIco, 3);
}

var arrayPasswordCheck = [40, 0, 0, 0];

var pass = document.getElementById('pass');

function PasswordCheckClick(check, val, text, ico, index) {
   if (check.checked == true) {
      val.style.display = "block";
      ico.style.display = "block";
      text.style.textDecoration = "none";
      arrayPasswordCheck[index] = parseInt(val.value);
      var tot = arrayPasswordCheck[1] + arrayPasswordCheck[2] + arrayPasswordCheck[3];
      if (tot > arrayPasswordCheck[0]) {
         if (index == 0)
            val.value = tot;
         else
            val.value = arrayPasswordCheck[index] - (tot - arrayPasswordCheck[0]);
         arrayPasswordCheck[index] =  parseInt(val.value);
      } 
      text.innerHTML=('Minimum ' + arrayPasswordCheck[index]);
   }
   else {
      val.style.display = "none";
      ico.style.display = "none";
      text.style.textDecoration = "line-through";
      text.innerHTML=('Minimum 0')
      arrayPasswordCheck[index] = 0;
   }
   console.log(arrayPasswordCheck);
   pass.setAttribute("title", "- Minimum " + arrayPasswordCheck[0] + 
                              " charactère \r\n- Au moins " + arrayPasswordCheck[1] +
                              " MAJ (A-Z) \r\n- Au moins " + arrayPasswordCheck[2] + 
                              " MIN (a-z) \r\n- Au moins " + arrayPasswordCheck[3] + " NUM (1-9)");
   pass.setAttribute("pattern", "^(?=.*[a-z]{" + arrayPasswordCheck[2] +
                                 "})(?=.*[A-Z]{" + arrayPasswordCheck[1] +
                                 "})(?=.*[0-9]{" + arrayPasswordCheck[3] +
                                 "}).{" + arrayPasswordCheck[0] + ",40}$");
}

/*********** Verification de la validité du mot de passe (min 6 CAR, min 1 MAJ, min 1 MIN, min 1 NUM) ***********/
var pass = document.getElementById('pass');

pass.oninvalid = function(event) {
    event.target.setCustomValidity
    ("- Minimum " + arrayPasswordCheck[0] + 
    " charactère\n- Au moins " + arrayPasswordCheck[1] + 
    " MAJ (A-Z)\n- Au moins " + arrayPasswordCheck[2] + 
    " MIN (a-z)\n- Au moins " + arrayPasswordCheck[3] + " NUM (1-9)");
}

/*********** Verification lors de la validité du mot de passe lors de sa saisie ***********/
var pass = document.getElementById("pass");

function checkLivePassword() {
   if (pass.value.length >= arrayPasswordCheck[0])
      document.getElementById("len_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("len_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
   if (pass.value.length - pass.value.replace(/[A-Z]/g, '').length  >= arrayPasswordCheck[1])
      document.getElementById("maj_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("maj_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
   if (pass.value.length - pass.value.replace(/[a-z]/g, '').length  >= arrayPasswordCheck[2])
      document.getElementById("min_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("min_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png"; 
   if (pass.value.length - pass.value.replace(/[1-9]/g, '').length  >= arrayPasswordCheck[3])
      document.getElementById("num_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("num_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
}
pass.onkeyup = checkLivePassword;
// document.getElementById("len_password_val").oninput = checkLivePassword;
// document.getElementById("maj_password_val").oninput = checkLivePassword;
// document.getElementById("min_password_val").oninput = checkLivePassword;
// document.getElementById("num_password_val").oninput = checkLivePassword;

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
