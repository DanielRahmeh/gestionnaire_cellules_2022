function dispList(i) {
   i = parseInt(i);
   id = 'structure' + i;
   cliked = 'cliked' + i;
   listToShow = document.getElementById(id);
   cliked = document.getElementById(cliked);
   if (listToShow.style.display == "block") {
      if (cliked.src == "https://rahmeh.fr/gdc/img/icon/down_white.png")
         cliked.src = "https://rahmeh.fr/gdc/img/icon/right_white.png";
     else
         cliked.src ="https://rahmeh.fr/gdc/img/icon/right_orange.png";
      listToShow.style.display = "none";
   }
   else {
      if (cliked.src == "https://rahmeh.fr/gdc/img/icon/right_orange.png")
         cliked.src ="https://rahmeh.fr/gdc/img/icon/down_orange.png";
     else
         cliked.src ="https://rahmeh.fr/gdc/img/icon/down_white.png";
      listToShow.style.display = "block";
   }
}

function checkList(path) {
   tab_path = path.split('/');
   // console.log(tab_path);
   if (tab_path.length != 0) {
      for(i = 0; i < tab_path.length; i++) {
         id = 'structure' + tab_path[i];
         cliked = 'cliked' + tab_path[i];
         listToShow = document.getElementById(id);
         cliked = document.getElementById(cliked);
         listToShow.style.display = "block";
         if (cliked.src == "https://rahmeh.fr/gdc/img/icon/right_white.png")
            cliked.src ="https://rahmeh.fr/gdc/img/icon/down_white.png";
         else
            cliked.src ="https://rahmeh.fr/gdc/img/icon/down_orange.png";
      }
   }
}



function hideList() {
   mainPrincipal = document.getElementById('main_principal');
   buttonClick = document.getElementById('button_click');
   img = document.getElementById('img_click');
   if (img.src == "https://rahmeh.fr/gdc/img/icon/menu_on.png") {
      img.src = "https://rahmeh.fr/gdc/img/icon/menu_off.png";
      mainPrincipal.style["grid-template-columns"] = "23rem auto";
   }
   else {
      img.src = "https://rahmeh.fr/gdc/img/icon/menu_on.png";
      mainPrincipal.style["grid-template-columns"] = "0rem auto";
   }
}

