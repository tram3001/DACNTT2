$('#price').on('keyup',function(){
    $value=$(this).val().replace(",","");
    var num=Intl.NumberFormat('en-US').format($value);
    document.getElementById('format_money').innerHTML=num;
    
})

function validateForm() {
    let name=document.getElementById("name").value;
    let period=document.getElementById("period").value;
    let price=document.getElementById("price").value;
    if (name == "") {
    //   alert("Name must be filled out");
      document.getElementById('tb').innerHTML="Vui lòng nhập tên khóa học";
      return false;
    }
    if(period!=''){
        if(!/^[0-9]+$/.test(period)){
            document.getElementById('tb').innerHTML="Vui lòng kiểm tra số buổi";
            return false;
        }
    }
    if(price!=''){
        if(!/^[0-9]+$/.test(price)){
            document.getElementById('tb').innerHTML="Vui lòng kiểm tra học phí";
            return false;
        }
    }
    
    
}

