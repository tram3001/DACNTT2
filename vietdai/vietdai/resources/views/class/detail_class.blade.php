@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="{{asset('storage/favicon.ico')}}" />
    <title>VIETDAI EDUACATION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/course.css')}}">
 </head>
  <body style=" background: rgb(247,248,252);">
    <div id="main">
        <div class="main-body">
            <div class="row"  style="padding-right:30px;padding-top:30px">
                <div class="col-lg-12">
                    <div class="col1" style="padding: 25px;background:white">
                        <div class="row">
                            <div class="col-lg-12">
                                <div style="margin-bottom:5px">
                                    <a class="h5">CHI TIẾT LỚP HỌC</a>
                                    @if (Auth::user()->type!=2)
                                        @if ($class[0]->status!=0)
                                            <a data-toggle="modal" data-target="#Editclass" style="float: right;"><i class="fi fi-rr-edit"></i></a>
                                        @endif
                                    @endif
                                    <br>
                                    <a style="font-size: 15px;font-weight:bold;color:#526484">ML: {{$class[0]->malop}}</a><br>
                                    <a style="font-size: 15px;font-weight:bold;color:#526484">Trạng thái:
                                        @if ($class[0]->status==0)
                                            <a style="font-size: 15px;color: green; font-weight:bold"> Kết thúc</a>
                                        @elseif ($class[0]->status==1)
                                            <a style="font-size: 15px;color: rgb(253,160,29); font-weight:bold"> Đang diễn ra</a>
                                        @elseif ($class[0]->status==2)
                                            <a style="font-size: 15px;color: rgb(253,160,29); font-weight:bold"> Sắp diễn ra</a>
                                        @endif
                                    </a>
                                
                                </div>
                                <table  class="table">
                                    <thead style="color: #3b2b74;font-size:15px;  ">
                                    <th style="background-color:rgb(247,248,252);color:#020917">Tên khóa học</th>
                                    <th style="background-color:rgb(247,248,252);color:#020917">Số buổi</th>
                                    <th style="background-color:rgb(247,248,252);color:#020917">Học phí</th>
                                    <th style="background-color:rgb(247,248,252);color:#020917">Chi nhánh</th>
                                    <th style="background-color:rgb(247,248,252);color:#020917">Hình thức</th>
                                    <th style="background-color:rgb(247,248,252);color:#020917">Giáo viên</th>
                                    </thead>
                                    <tbody style="color: #3b2b74;font-size:15px; ">
                                    <tr>
                                        <td >
                                        {{$course[0]->name}}-{{$course[0]->language}}
                                        </td>
                                        <td >
                                        {{$course[0]->period}}
                                        </td>
                                        <td >
                                        <?php echo number_format($course[0]->price)?>
                                        </td>
                                        <td >
                                        {{$branch[0]->name}}
                                        </td>
                                        <td >
                                        {{$class[0]->ht}}
                                        </td>
                                        <td >
                                        {{$teacher[0]->name}}
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Ngày bắt đầu</label>
                                <input type="date" name="start" id="end" value="{{$class[0]->bd}}" class="form-control" readonly="width:100%">
                            </div>
                            <div class="col-lg-3">
                                <label for="">Ngày kết thúc</label>
                                <input type="date" name="end"id="end" value="{{$class[0]->kt}}" class="form-control" readonly style="width:100%">
                            </div>
                            <div class="col-lg-6">
                                <label for="" style="color: #f67e06">Ghi chú</label>
                                <textarea name="note" rows="1" style="width:100%; " readonly  placeholder="Ghi chú" class="form-control" >{{$class[0]->note}}</textarea>
                            </div>
                            <div class="col-lg-12" style="padding-top:20px ">
                                <div style="text-align: center">
                                    <h6>Lịch lớp học</h6>
                                </div>
                                @if ($class[0]->ht=='Lớp tại trung tâm')
                                    @if (Auth::user()->type!=2)
                                        <div style="float: right">
                                            <a href="" data-toggle="modal" data-target="#changeroom" >Đổi phòng</a>
                                        </div>
                                        @include('modal.modal_changeroom')
                                    @endif
                                @endif
                                <table style="width:100%; border: 1px solid rgb(222, 217, 217);margin-top:20px" class="text-center">
                                    <thead>
                                    <?php 
                                        $lich=explode('-',$class[0]->calendar);
                                        array_shift($lich);
                                    $p='';
                                    ?>
                                    
                                    @foreach ($lich as $item)
                                    <?php  $t=mb_substr($item, 0,2); ?>
                                        <th style="border: 1px solid rgb(222, 217, 217);background-color: #526484;color:white;padding:15px">
                                            @if ($t=="T8")
                                                CN
                                            @else
                                                {{$t}}
                                            @endif
                                        
                                        </th>
                                    @endforeach
                                
                                    </thead>
                                    <tbody >
                                    @foreach ($lich as $item)
                                    <?php $c=mb_substr($item, 2,2);
                                        if($class[0]->ht=='Lớp tại trung tâm'){
                                            $p=mb_substr($item,5,strlen($item));
                                            $name_P=DB::table('room')->where('id',$p)->get()->toArray();
                                            $p='_'.''.$name_P[0]->name;
                                        }
                                            
                                    ?>
                                    <td style=" border: 1px solid rgb(222, 217, 217); padding:20px">
                                            <a style="color:#526484; font-size:15px; font-weight:bold">{{$c}}{{$p}}</a>
                                        </td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                          
                        </div>
                    </div>
                    @if (Session::has('success'))
                        <script>
                          swal("Thông báo","{{Session::get('success')}}",'success',{
                            button:true,
                            timer:3000,
                            button:"OK",
                          }) 
                        </script>
                      @endif  
                </div>
                
                <div class="col-lg-12" style="margin-top: 10px">
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="col1" style="background: white;">
                            <div class="row">
                                <div class="col-lg-12" style="padding-top:10px ">
                                    <a  class="h5">
                                        Danh sách học viên
                                    </a>
                                    @if (Auth::user()->type!=2)
                                        @if ($class[0]->status!=0)
                                            <a data-toggle="modal" data-target="#ModalStudent" style="float: right;">
                                                <i class="fi fi-rr-apps-add" style="font-size: 20px;color: rgb(115, 137, 216);"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-lg-9"></div>
                                <div class="col-lg-3" style="float: right;margin-top:20px" >
                                    <form method="get" action="/class/detail_class/search_student" style="width:100%;float:right;" >
                                        {{ csrf_field() }}
                                        <?php $value='';?>
                                        <input  name="class" value="{{$class[0]->id}}" hidden>
                                        @if (isset($_GET['search']))
                                            <?php $value=$_GET['search'];?>
                                        @endif
                                        <input type="text"  name='search' style="font-size:14px;height:42px;" value="{{$value}}" placeholder="Tìm kiếm " class="form-control">
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
                                            @if (Auth::user()->type!=2)
                                                <th>
                                                    Hoạt động
                                                </th>
                                            @endif                                                        
                                        </thead>
                                            <tbody style="font-size:15px;color:#526484;">
                                                <?php 
                                                    $d=0;                                       
                                                ?>
                                                @foreach ($list_student as $item)
                                                    <tr>
                                                        <td>{{$d=$d+1}}</td>
                                                        <td>{{$item[0]->name}}</td>
                                                        <td>{{$item[0]->nationality}}</td>
                                                        <td>{{$item[0]->sex}}</td>
                                                        <td>{{$item[0]->phone}}</td>
                                                        @if (Auth::user()->type!=2)
                                                            <td><a href="/student/detail_student/{{$item[0]->id}}"><button class="btn-hd" >Chi tiết</button></a>
                                                                <a data-toggle='modal' data-target="#delete{{$item[0]->id}}"><button class="btn-hd delete" >Xóa</button></a>
                                                           @include('modal.delete_student_class')
                                                        @endif
                                                    </tr>
                                                    
                                                @endforeach
                                                            
                                            </tbody>
                                                            
                                    </table>
                                </div>
                            </div>
                            
                        </div>      
                    </div>
                    </div>
                </div>
                
            </div>
            
        </div>
      @include('modal.student')
      @include('modal.modal_edit_class')
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
@endsection