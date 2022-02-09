// function check_path(nb, tab) {
//    count = 0;
//    for(i = 0; i < tab.length; i++) {
//       if (nb == tab[i])
//          count++;
//    }
//    return(count);
// }

function dispList(i) {
   i = parseInt(i);
   id = 'structure' + i;
   cliked = 'cliked' + i;
   listToShow = document.getElementById(id);
   cliked = document.getElementById(cliked);
   if (listToShow.style.display == "block") {
      if ( cliked.src == "https://rahmeh.fr/gdc/img/icon/down_white.png")
         cliked.src = "https://rahmeh.fr/gdc/img/icon/right_white.png";
     else
         cliked.src ="https://rahmeh.fr/gdc/img/icon/right_orange.png";
      listToShow.style.display = "none";
   }
   else {
      listToShow.style.display = "block";
      if ( cliked.src == "https://rahmeh.fr/gdc/img/icon/right_white.png")
         cliked.src ="https://rahmeh.fr/gdc/img/icon/down_white.png";
     else
         cliked.src ="https://rahmeh.fr/gdc/img/icon/down_orange.png";
   }
}

function checkList(path) {
   tab_path = path.split('/');
   console.log(tab_path);
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