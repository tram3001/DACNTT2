$('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'get',
        dataType: 'json',
        url:'/class/search',
        data:{'search':$value},
        success:function(data){
            console.log(data);
            $('#search_class').html(data);

        }
    })
})