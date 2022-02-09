function check_path(nb, tab) {
   count = 0;
   for(i = 0; i < tab.length; i++) {
      if (nb == tab[i])
         count++;
   }
   return(count);
}

function dispList (i, path) {
   i = parseInt(i);
   id = 'structure' + i;
   cliked = 'cliked' + i;
   tab_path = path.split('/');
   console.log(tab_path);
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