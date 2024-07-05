function updatemenu() {
  if (document.getElementsByClassName('responsive-menu').checked == true) {
    document.getElementsByClassName('menu').style.borderBottomRightRadius = '0';
    document.getElementsByClassName('menu').style.borderBottomLeftRadius = '0';
  }else{
    document.getElementsByClassName('menu').style.borderRadius = '0px';
  }

}


