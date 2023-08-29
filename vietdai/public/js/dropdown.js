function isShrunk() {    
    var currentWidth = window.innerWidth;
    if (currentWidth < 1000  ) {
      return true;
    } else {
      return false;
    }
  }
  window.addEventListener("resize", function() {
    var shrunk = isShrunk();
    if (shrunk) {
      document.getElementById("dropdown").style.display="none";
      document.getElementById("dropdown-content").style.background=" #f1f1f1";
    } else {
        document.getElementById("dropdown").style.display="block";

    }
});
function screen(){
    var currentWidth = window.innerWidth;
    if(currentWidth<1300){
    document.getElementById("dropdown").style.display="none";
      
    }else {
        document.getElementById("dropdown").style.display="block";

    }
}
  
window.onload = screen;