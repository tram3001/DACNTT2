$(document).ready(function () {
    $('#submit').on('click', '#savebtn', function (e){
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var name=$('#name').val();
            // var phone=$('#phone').val();
            // var nationally=$('#nationally').val();
            // var start=$('#start').val();
            var a=document.getElementById('tb');
            $.ajax({
                url: '/staff/save',
                type:'POST',
                data: {_token:_token,name:name},
                dataType: 'json',
                success:function(response)
                {
                a.innerHTML=response['success'];
                console.log(response);  
                }
            });
      
    });
  });