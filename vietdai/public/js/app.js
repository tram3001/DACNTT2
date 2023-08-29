
function btnsidebar(){
    if(document.getElementById("bg").style.display=="none"){
        document.getElementById("bg").style.display="block";
        document.getElementById("bg").style.width = "260px";
        document.getElementById("main").style.marginLeft = "300px";
    }else{
        document.getElementById("bg").style.display="none";
        document.getElementById("bg").style.width = "0px";
        document.getElementById("main").style.marginLeft = "20px";
    } 
}

// Hàm kiểm tra xem trang web có bị kéo nhỏ không
function isShrunk() {
  // Lấy kích thước ban đầu của trang web
  var originalWidth = document.body.clientWidth;
  var originalHeight = document.body.clientHeight;

  // Lấy kích thước hiện tại của cửa sổ trình duyệt
  var currentWidth = window.innerWidth;
  var currentHeight = window.innerHeight;
  // So sánh kích thước hiện tại với kích thước ban đầu
  if (currentWidth < 1300  ) {
    return true;
  } else {
    return false;
  }
}

// Gán một hàm xử lý cho sự kiện resize của cửa sổ
window.addEventListener("resize", function() {
  // Kiểm tra xem trang web có bị kéo nhỏ hay không
  var shrunk = isShrunk();
  // Hiển thị kết quả ra màn hình
  if (shrunk) {
    document.getElementById("bg").style.display="none";
    document.getElementById("bg").style.width = "0px";
    document.getElementById("main").style.marginLeft = "20px";
  } else {

    document.getElementById("bg").style.display="block";
    document.getElementById("bg").style.width = "260px";
    document.getElementById("main").style.marginLeft = "300px";
  }
});

//Tắt sidebar khi màn hình nhỏ

function screen(){
  var currentWidth = window.innerWidth;
  if(currentWidth<1300){
    document.getElementById("bg").style.display="none";
    document.getElementById("bg").style.width = "0px";
    document.getElementById("main").style.marginLeft = "20px";
    
  }
}

window.onload = screen;

