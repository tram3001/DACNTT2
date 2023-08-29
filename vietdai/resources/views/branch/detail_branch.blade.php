@extends('layouts.app')
@section('content')
<title>VIETDAI EDUACATION</title>
      <!doctype html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <!-- Bootstrap CSS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        </head>
        <body style="background: rgb(247,248,252);">
            <div id="main" >
                <div class="main-body">
                  <div style="padding-top: 30px;padding-right:30px">
                    <div class="col1" style="background: white;" >
                        <div class="row" style="padding: 10px" >
                            <div class="col-lg-12" style="padding-bottom:20px">
                                @foreach ($branch as $row)
                                    <a class="h5">
                                        chi nhánh {{$row->name}}
                                    </a>
                                    <a style="float: right"data-toggle="modal" data-target="#BranchEdit{{$a=$row->id}}"><i class="fi fi-rr-edit"></i></a><br>
                                    @include('modal.modal_editbranch')
                                    <a style="color: gray">Địa chỉ: {{$row->address}} </a><br>
                                    <a style="color: gray">Số điện thoại: {{$row->phone}} </a>
                                @endforeach
                            </div>
                            @include('modal.modal_room')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card" style="padding:10px">
                                    <div>
                                        <i data-toggle="modal" data-target="#RoomCreate{{$row->id}}" class="fi fi-rr-layer-plus" style="font-size: 30px"></i>
                                    </div>
                                    <div >
                                        <a style="font-weight:bold; font-size:15px">Tổng số phòng:</a>
                                        <a style=" font-size:30px;font-weight:bold">{{$room}}</a>
                                    </div>
                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                   <div >
                                    <div style="float: right">
                                        <a href="/room/branch={{$branch[0]->id}}" ><button class="btn-hd"  >Chi tiết</button></a>
                                        <a href="/room/calendar_week/branch={{$branch[0]->id}}"  ><button class="btn-hd"  style="background: #5E5DF0; " >lịch phòng</button></a>
                                    </div>
                                   </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card" style="padding:10px">
                                    <div>
                                        <a href="/staff/create/branch={{$branch[0]->id}}" ><i class="fi fi-rr-book-open-reader" style="font-size: 30px"></i></a>
                                    </div>
                                    <div >
                                        <a style="font-weight:bold; font-size:15px">Tổng số giáo viên:</a>
                                        <a style=" font-size:30px;font-weight:bold">{{$count_teacher}}</a>
                                    </div>
                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                   <div >
                                    <div style="float: right">
                                        <form action="/staff/filter" method="get" enctype="multipart/form-data" > 
                                            {{ csrf_field() }} 
                                            <input type="text" hidden value="{{$branch[0]->id}}" name="branch">
                                            <button class="btn-hd" type="submit">Danh sách</button>
                                        </form>
                                    </div>
                                   </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card" style="padding:10px">
                                    <div>
                                        <i class= "fi fi-rr-book-copy" style="font-size: 30px"></i>
                                    </div>
                                    <div >
                                        <a style="font-weight:bold; font-size:15px">Tổng số lớp học:</a>
                                        <a style=" font-size:30px;font-weight:bold">{{$count_class}}</a>
                                    </div>
                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                   <div >
                                    <div style="float: right">
                                        <form action="/class/filter" method="get" enctype="multipart/form-data" > 
                                            {{ csrf_field() }} 
                                            <input type="text" hidden value="{{$branch[0]->id}}" name="branch">
                                            <input type="text" hidden value="all" name="language">
                                            <input type="text" hidden value="all" name="form">
                                            <input type="text" hidden value="all" name="status">
                                            <button class="btn-hd" type="submit">Danh sách</button>
                                        </form>
                                    </div>
                                   </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6" >
                                <div class="card" style="padding:10px">
                                    <div>
                                        <i class="fi fi-rr-calendar-heart" style="font-size: 30px"></i>
                                    </div>
                                    <div >
                                        <a style="font-weight:bold; font-size:15px">Lịch chi nhánh:</a><br>
                                        <a href="/general_calendar/branch={{$branch[0]->id}}">Lịch chi nhánh tổng quát</a>
                                    </div>
                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                   <div >
                                    <div style="float: right">
                                        <a href="/calendar_branch/branch={{$branch[0]->id}}"><button class="btn-hd" type="submit">Tuần</button></a>
                                    </div>
                                   </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6" style="padding-top: 10px">
                                <div class="card" style="padding:10px">
                                    <div>
                                        <i class="fi fi-rr-book-open-cover" style="font-size: 30px"></i>
                                    </div>
                                    <div >
                                        <a style="font-weight:bold; font-size:15px">Danh sách học viên</a>
                                        <a style=" font-size:15px"></a>
                                    </div>
                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                   <div >
                                    <div style="float: right">
                                        <a href="/student/branch={{$row->id}}"><button class="btn-hd" type="submit">Danh sách</button></a>
                                    </div>
                                   </div>
                                    
                                </div>
                            </div>
                           
                           
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