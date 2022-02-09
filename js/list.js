function dispList (i) {
   i = parseInt(i);
   id = 'structure' + i;
   cliked = 'cliked' + i;
   listToShow = document.getElementById(id);
   console.log('id :')
   console.log(cliked)
   cliked = document.getElementById(cliked);
   // console.log('val :')
   // console.log(cliked);
   if (listToShow.style.display == "block") {
      console.log('a cacher');
      // cliked.src="https://rahmeh.fr/gdc/img/icon/right_white.png";
      listToShow.style.display = "none";
   }
   else {
      console.log('a afficher');
      listToShow.style.display = "block";
      // cliked.src="https://rahmeh.fr/gdc/img/icon/down_white.png";
   }
   if ( cliked.src== "https://rahmeh.fr/gdc/img/icon/down_white.png")
      cliked.src="https://rahmeh.fr/gdc/img/icon/right_white.png";
   else
      cliked.src="https://rahmeh.fr/gdc/img/icon/down_white.png";
}