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
    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
  
  </head>
  <body style=" background: rgb(247,248,252);">
      <div id="main">
        <div class="main-body">
          <form action="/course/create_class/confirm_class/save" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
          <div style="padding-top: 30px;padding-right:30px">
            <div class="col1" style="background: white;padding:25px">
              <div class="row" style="padding-top: 10px">
                <div class="col-lg-12">
                  <div style="margin-bottom:5px">
                    <h5>KHÓA HỌC</h5>
                  </div>
                  <table  class="table">
                    <input type="text" name="course"  value="{{$course[0]->id}}" hidden >
                    <input type="text" name="teacher"  value="{{$id_teacher}}" hidden >
                    <input type="text" name="mail"  value="{{$mail}}" hidden >
                    <input type="text" name="nameteacher"  value="{{$teacher}}" hidden >
                    <input type="text" name="branch"  value="{{$id_branch}}" hidden >
                    <input type="text" name="name"  value="{{$course[0]->name}}-{{$course[0]->language}}" hidden >
                    <input type="text" name="namebranch"  value="{{$branch}}" hidden >
                    <input type="text" name="form"  value="{{$form[0]->name}}" hidden >
                    <input type="text" name="choose"  value="{{$form[0]->choose}}" hidden >
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
                            {{$branch}}
                          </td>
                          <td >
                            {{$form[0]->name}}
                          </td>
                          <td >
                            {{$teacher}}
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-3">
                  <label for="">Ngày bắt đầu</label>
                  <input type="date" name="start" id="end" value="{{$start}}" class="form-control" readonly="width:100%">
                </div>
                <div class="col-lg-3">
                  <label for="">Ngày kết thúc</label>
                  <input type="date" name="end"id="end" value="{{$end}}" class="form-control" readonly style="width:100%">
                </div>
                <div class="col-lg-6">
                  <label for="" style="color: #f67e06">Ghi chú</label>
                  <textarea name="note" rows="3" style="width:100%; "  placeholder="Ghi chú" class="form-control" >{{$note}}</textarea>
                </div>
                  <div class="col-lg-12" style="padding-top:20px">
                    <h6>Chọn phòng học</h6>
                    <div class="row">
                      <div class="col-lg-12">
                        <table style="width:100%; border: 1px solid rgb(222, 217, 217);margin-top:20px" class="text-center">
                          <thead>
                            <?php $calendar='';?>
                            @foreach ($lich as $item)
                            <?php  $t=mb_substr($item, 0,2);$c=mb_substr($item, 2,2) ;?>
                              <th style="border: 1px solid rgb(222, 217, 217);background-color: #526484;color:white;padding:15px">
                                {{$t}}_{{$c}}
                                <?php $calendar=$calendar.'-'.$t.''.$c;?>
                              </th>
                            @endforeach
                            <input type="text" hidden name="calendar" value="{{$calendar}}">
                          </thead>
                          <tbody >
                            @foreach ($lich as $item)
                            <td style=" border: 1px solid rgb(222, 217, 217);height:50px;   padding:25px">
                                <?php
                                $t=mb_substr($item, 0,2);$c=mb_substr($item, 2,2);
                                if($form[0]->choose!=1){
                                  ?>{{$form[0]->name}}<?php
                                }else{
                                  $a=mb_substr($item, 6,strlen($item));
                                  $array=explode('_',$a);
                                  foreach($array as $row){
                                    $name=DB::table('room')->where('id',$row)->get()->toArray();
                                    ?>
                                      <input type="radio" name="{{$t}}{{$c}}" value="{{$row}}" id="" checked="checked">
                                      <label for="">{{$name[0]->name}}</label>&ensp;
                                    <?php
                                  }
                                }
                                ?>
                              </td>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                     
                      <div class="col-lg-12" style="padding-top: 10px">
                        <div style="float: right" >
                          <button  type="reset" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                          <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                          {{-- <button type="submit" class='btn-class' >Lưu</button> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          </div>
         
        </div>
      </form>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
@endsection