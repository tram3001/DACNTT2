@extends('layouts.app')
@section('content')
    <!doctype html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link  rel="stylesheet" href="{{asset('css/course.css')}}">
    </head>
  <body>
    <div id="main">
      <div class="main-body">
          <div style="padding-right:30px;padding-top:30px">
            @if (Session::has('success'))
                <script>
                swal("Thông báo","{{Session::get('success')}}",'success',{
                    button:true,
                    timer:3000,
                    button:"OK",
                }) 
                </script>
            @endif  
            @if (Session::has('error'))
                <script>
                swal("Thông báo","{{Session::get('error')}}",'error',{
                    button:true,
                    timer:3000,
                    button:"OK",
                }) 
                </script>
            @endif  
            <div class="col1" style="background: white;">
                <div class="row">
                    <div class="col-lg-12" style="padding-top:10px ">
                        <a class="h5">Thêm học viên vào lớp</a><br>
                        <a href="/class/detail_class/class={{$class[0]->id}}" class="link_a">Lớp: {{$class[0]->malop}}</a><br>
                        <?php $teacher=DB::table('staff')->whereRaw('id=?',$class[0]->teacher)->get()->toArray();?>
                        <a href="/staff/detail/staff={{$teacher[0]->id}}" class="link_a">Giáo viên: {{$teacher[0]->name}}</a>
                    </div>
                    <div class="col-lg-9"></div>
                    <div class="col-lg-3" style="float: right">
                        <form method="get" action="/class/insert_student/search" style="width:100%;float:right;" >
                            {{ csrf_field() }}     
                            <input  name="class" value="{{$class[0]->id}}" hidden>
                            <?php $value='';?>
                            @if (isset($_GET['search']))
                                <?php $value=$_GET['search'];?>
                            @endif
                            <input type="text"  name='search' style="font-size:14px;height:42px;  " placeholder="Tìm kiếm " value="{{$value}}" class="form-control">
                            <button id='but' type='submit' hidden>do not click me</button>
                        </form>
                    </div>
                    <div class="col-lg-12" style="padding-top: 10px">
                        <table class="table">
                            <thead style="">
                                <th>
                                    #
                                </th>
                               
                                <th>
                                    Họ và tên
                                </th>
                                <th>
                                    Quốc tịch
                                </th>
                                <th>
                                    Giới tính
                                </th>
                                <th>
                                    Số điện thoại
                                </th>
                                <th>
                                    Hoạt động
                                </th>  
                            </thead>
                                <tbody style="font-size:15px;color:#526484;">
                                    <?php 
                                        $d=0;                                       
                                    ?>
                                  @foreach ($list_student as $item)
                                  <tr>
                                    <td>{{$d=$d+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->nationality}}</td>
                                    <td>{{$item->sex}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                       <a href="/student/detail_student/{{$item->id}}"><button class="btn-hd">Chi tiết</button></a>
                                       <a >
                                        <form action="/class/insert_student/add" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="class" value="{{$class[0]->id}}">
                                            <input hidden name="branch" value="{{$class[0]->branch}}">
                                            <input hidden name="student" value="{{$item->id}}">
                                            <button class="btn-hd" style="background:#526484">Thêm</button>
                                        </form>
                                        
                                        </a>
                                    </td>
                                  </tr>
                                      
                                  @endforeach
                                </tbody>
                                                
                        </table>
                        {{$list_student->links()}}
                    </div>
                </div>
                
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