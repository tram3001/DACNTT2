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
                               DANH SÁCH GIÁO VIÊN bị ẩn
                            </a>
                           
                            <br>
                            <a href="/staff" style="font-size: 15px">Danh sách giáo viên </a>
                        </div>
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3 col-md-12 col-sm-12">  
                            <form method="get" action="/staff/hide/search_staff" style=" margin-top:20px" >
                                <?php $value="";?>
                                @if (isset($_GET['search']))
                                    <?php $value= ($_GET['search']);?>
                                @endif
                                <input type="text"name='search' style="font-size:14px;padding:10px;height:40px" value="{{$value}}" placeholder="Tìm kiếm" class="form-control">
                                <button id='but' type='submit' hidden>do not click me</button>
                            </form>
                        </div>
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
                                                <a data-toggle="modal" data-target="#displayteacher{{$item->id}}" > <button class="btn-hd" style="background:rgb(253,160,29);opacity:0.2" >Ẩn</button></a>
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