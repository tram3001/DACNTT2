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
        <link  rel="stylesheet" href="{{asset('css/course.css')}}">
    </head>
      <body>
        <div id="main">
            <div  class="main-body">
            <div  style="padding-right:30px;padding-top:30px">
                <div class="col1">
                    <div class="row" style="padding: 10px">
                        <div class="col-lg-12">
                            <a class="h5">
                               DANH SÁCH GIÁO VIÊN
                            </a>
                            <a href="/staff/create" style="float: right">
                                <i class="fi fi-rr-apps-add" style="font-size: 20px;color: rgb(115, 137, 216);"></i>
                            </a>
                            <br>
                            <a href="/staff/hide" style="font-size: 15px">Danh sách giáo viên bị ẩn</a>
                        </div>
                        <div class="col-lg-10"></div>
                        <div class="col-lg-1 ">
                            <button data-toggle="modal" data-target="#UploadStaff" class="btn btn-warning">Tải File</button>
                            @include('modal.modal_upload')
                        </div>
                        <div class="col-lg-1">
                            <form action="/export/excel_staff" method="post" style="float: right">
                                {{ csrf_field() }}
                                <input type="submit" name="export_excel"value="Xuất File" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-lg-8" >
                            <div >   
                                <form action="/staff/filter" method="get" enctype="multipart/form-data" > 
                                    {{ csrf_field() }}                     
                                <div class="row" style="margin-top:20px">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div >
                                            @if (Auth::user()->type==0)
                                                <select name="branch" id="" class="form-control" style="height:40px;font-size:15px">
                                                    @if (isset($_GET['branch']))
                                                        <?php
                                                            if($_GET['branch']!='all'){
                                                                $name_branch=DB::table('branch')->whereRaw('id=?',$_GET['branch'])->get()->toArray();
                                                                if(count($name_branch)){
                                                                    ?>
                                                                        <option value="{{$_GET['branch']}}" >{{$name_branch[0]->name}}</option> 
                                                                    <?php
                                                                }
                                                                
                                                            }
                                                            
                                                            
                                                        ?>
                                                    @endif
                                                            
                                                    <option value="all">---Chi nhánh---</option>
                                                    <?php $branch=DB::table('branch')->get()->toArray()?>
                                                    @foreach ($branch as $item)
                                                        <option value="{{$item->id}}" >{{$item->name}}</option> 
                                                    @endforeach
                                                
                                                </select>
                                            @else
                                                <?php $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();?>
                                                <input type="text" class="form-control" value="{{$branch[0]->name}}" name="branch" readonly>
                                            @endif
                                           
                                        </div>                                 
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="select_form">
                                            <select name="form_work" id="" class="form-control" style="height:40px">
                                                @if (isset($_GET['form_work']))
                                                    <?php
                                                        if($_GET['form_work']!='all'){
                                                            if ($_GET['form_work']=='Full-time' || $_GET['form_work']=='Part-time') {
                                                                ?>
                                                                    <option value="{{$_GET['form_work']}}">{{$_GET['form_work']}}</option>
                                                                    
                                                                <?php
                                                            }
                                                        
                                                        }
                                                        
                                                    ?>
                                                @endif
                                                <option value="all">---Hình thức làm việc---</option>
                                                <option value="Full-time">Full-time</option>
                                                <option value="Part-time">Part-time</option>
                                            </select>
                                        </div>                                   
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div>
                                            <select name="language" id="" class="form-control">
                                                @if (isset($_GET['language']))
                                                    <?php
                                                        if($_GET['language']!='all'){
                                                            $name_branch=DB::table('languages')->whereRaw('name=?',$_GET['language'])->get()->toArray();
                                                            if(count($name_branch)){
                                                                ?>
                                                                    <option value="{{$_GET['language']}}">{{$_GET['language']}}</option> 
                                                                <?php
                                                            }
                                                        }
                                                        
                                                    ?>
                                                 @endif
                                                <option value="all">---Ngôn ngữ---</option>
                                                <?php $languages=DB::table('languages')->get()->toArray();?>
                                                @foreach ($languages as $item)
                                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> 
                                        </div>       
                                    </div>
                                
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-3 col-sm-3" style="margin-top:20px">
                            <button type="submit" style="background: none; border:none;"><i class="fi fi-rr-filter" style="font-size:25px"></i></button>
                        </div>
                        </form>
                        <div class="col-lg-3 col-md-12 col-sm-12">  
                            <form method="get" action="/staff/search_staff" style=" margin-top:20px" >
                                <?php $value="";?>
                                @if (isset($_GET['branch']))
                                    <input hidden name="branch" value="{{$_GET['branch']}}">
                                @endif
                                @if (isset($_GET['language']))
                                    <input hidden name="language" value="{{$_GET['language']}}">
                                @endif
                                @if (isset($_GET['form_work']))
                                    <input hidden name="form_work" value="{{$_GET['form_work']}}">
                                @endif
                                @if (isset($_GET['search']))
                                    <?php $value= ($_GET['search']);?>
                                @endif
                                <input type="text"name='search' style="font-size:14px;padding:10px;height:40px" value="{{$value}}" placeholder="Tìm kiếm" class="form-control">
                                <button id='but' type='submit' hidden>do not click me</button>
                            </form>
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
                        <div class="col-lg-12" style="margin-top:20px">
                            <?php $d=0?>
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Họ và tên</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Bộ môn dạy</th>
                                    <th>Chi nhánh</th>
                                    <th>Hoạt động</th>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($list as $item)
                                        <tr class="tr_course">
                                            <td class="stt">{{$d=$d+1}}</td>
                                            <td >{{$item->name}}</td>
                                            <td >{{$item->sex}}</td>
                                            <td >{{$item->phone}}</td>
                                            <td >{{$item->email}}</td>
                                            <td >{{substr($item->languages, 1)}}</td>
                                            <td style="color:#FD9722">
                                                @foreach ($list_branch as $row)
                                                    @if ($item->id_branch==$row->id)
                                                        <b>{{$row->name}}
                                                        @break;
                                                    @endif
                                                @endforeach
                                            </td> 
                                            <td><a  href='/staff/detail/staff={{$item->id}}'> <button class="btn-hd" >Chi tiết</button></a>
                                                <a data-toggle="modal" data-target="#hideteacher{{$item->id}}" > <button class="btn-hd" style="background:rgb(253,160,29);" >Ẩn</button></a>
                                                <a data-toggle="modal" data-target="#reset{{$item->id}}"> <button class="btn-hd" style="background: rgb(223, 81, 81);" >Khôi phục mk</button></a>
                                                <a data-toggle="modal" data-target="#deleteteacher{{$item->id}}"> <button class="btn-hd" style="background: rgb(182, 53, 53);" >Xóa</button></a>
                                               
                                            </td>
                                            @include('modal.modal_teacher')
                                        </tr>
                                    @endforeach
                                </tbody>
            
                            </table>
                            {{$list->links()}}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
@endsection