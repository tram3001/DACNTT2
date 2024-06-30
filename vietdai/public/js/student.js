$(document).ready(function () {
  var i=$('#class').val();
  $('#'+i).on('click',  function (e){
          e.preventDefault();
          console.log(i);
          var _token = $("input[name='_token']").val();
          var name=$('#name').val();
          var phone=$('#phone').val();
          var nationally=$('#nationally').val();
          var start=$('#start').val();
          var a=document.getElementById('tb');
          $.ajax({
              url: '/class/add',
              type:'POST',
              data: {_token:_token,name:name,phone:phone,nationally:nationally,start:start},
              dataType: 'json',
              success:function(response)
              {
              a.innerHTML=response['success'];
              console.log(response);  
              }
          });
    
  });
});
<script>
    $('#test').on('click','#savebtn',function(e){
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var name = $('#name').val();
        var description = $('#description').val();
        $.ajax({
            type:'POST',
            url:'/test',
            dataType: 'json',
            data:{
                _token:_token,
                name:name,
                description:description,
            },
            success:function (data) {
                if ($.isEmptyObject(data.error)) {
                    alert(data.success);
                    $('#name').val('');
                    $('#description').val('');
                }else{
                    printErrorMsg(data.error)
                }
                table.draw();
            }
        });
        });

        function printErrorMsg(msg) {
        $('.error-msg').find('ul').html('');
        $('.error-msg').css('display','block');
        $.each( msg, function( key, value ) {
            $(".error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
</script>