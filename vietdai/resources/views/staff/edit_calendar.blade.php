@extends('layouts.app')
@section('content')
    <!doctype html>
    <html lang="en">
      <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
      <body>
          <div id="main">
            <div class="main-body">
             <div  style="padding-right:30px;padding-top:30px">
                <div class="col1" style="padding: 25px" >
                    <a class="h5">LỊCH TRONG TUẦN CỦA GIÁO VIÊN</a><br>
                    <a class="link_a" href="/staff/detail/{{$teacher->id}}">Giáo viên: {{$teacher->name}}</a>
                                      
                        <form action="/calendar/edit_calendar" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input hidden value="{{$teacher->id}}" name="id">
                        <div class="row">
                            <div class="col-lg-12" style="padding-top:20px">
                                <table class="table" style="text-align:center">
                                    <thead style="background-color: #526484;padding:auto" >
                                        <th >#</th>
                                        <th >T2</th>
                                        <th >T3</th>
                                        <th >T4</th>
                                        <th >T5</th>
                                        <th >T6</th>
                                        <th >T7</th>
                                        <th >CN</th>
                                    </thead>
                                        <tbody >
                                            <?php
                                                for($i=1; $i<8; $i++){
                                                if($i<3){
                                                    $color='#FD9722';
                                                }else if(2<$i&& $i<6){
                                                    $color='#F2426E';
                                                }else{
                                                    $color='#526484';
                                                }
                                            ?>
                                            <tr >
                                                <td ><b>Ca{{$i}}</td>
                                                <?php
                                                for($j=2;$j<9;$j++){ 
                                                    $key='T'.''.$j.''.'C'.''.$i;                                     
                                                    ?>
                                                    <td style="padding: 0px; padding-top:0px; padding-bottom:0px;height:50px" >
                                                        <input type="checkbox" value="{{$key}}" name="{{$key}}" style="float: right" >
                                                        <?php
                                                        $a=strpos($teacher->calendar, $key );
                                                        if($a!=''){
                                                            if($class!=null){
                                                            $calendar='';
                                                            foreach ($class as $row) {
                                                                # code...
                                                                $calendar=strpos($row->calendar,$key);
                                                    
                                                                if($calendar!=''){
                                                            
                                                                ?>
                                                                <div style="color: white;background:#05591e;width:100%;height:100%;padding-top:10px;padding-bottom:15px;" >
                                                                    <a href="/class/detail_class/class={{$row->id}}" style="font-size: 12px; color:white">                                                                
                                                                        {{$row->malop}}
                                                                    
                                                                    </a>                                                                 
                                                                </div>
                                                                <?php
                                                                break;
                                                            }}if($calendar=='' ){
                                                                ?>
                                                                <div style="color: white;background:{{$color}};width:100%; height:100%;padding-bottom:15px;padding-top:10px;margin:0px" class="text-center" >
                                                                    <a style="font-size: 14px; color:white; "> VP
                                                                    <br>                                                                                    
                                                                </div>                                                               
                                                                <?php
                                                                }
                                                            
                                                            }else{
                                                            ?>
                                                                <div style="color: white;background:{{$color}};width:100%; height:100%;padding-top:10px;padding-bottom:15px;" class="text-center" >
                                                                    <a style="font-size: 14px; color:white"> VP
                                                                    <br>                                                           
                                                                </div>                                                               
                                                            <?php
                                                            }
                                                        }
                                                    
                                                        ?>
                                                    
                                                
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12" >
                                <div style="float: right">
                                     <button  type="reset" class="btn  btn-dialog grey btn-outline-secondary" >Hủy</button>
                                    <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                                </div>
                               
                            </div>
                        </div>
                        </form>
                       
                    
                </div>
                
             </div>
          </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
@endsection