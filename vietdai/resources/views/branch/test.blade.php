@extends('layouts.app')
@section('content')
<title>VIETDAI EDUACATION</title>
      <!doctype html>
      <html lang="en">
        <head>
      
          <!-- Required meta tags -->
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        </head>
        <body style="background: rgb(247,248,252);">
          <div id="main" >
            <div class="main-body">
              <div style="padding-top: 30px;padding-right:30px">
              <div class="col1" style="background: white;" >
              <div class="row" style="padding: 10px" >
                <div class="col-lg-12" >
                  <a  class="h5">
                    Danh sách chi nhánh
                  </a>
                  @if (Auth::user()->type==0)
                    <a data-toggle="modal" data-target="#BranchCreate" style="float: right;">
                      <i class="fi fi-rr-apps-add" style="font-size: 20px;color: rgb(115, 137, 216);"></i>
                    </a>
                  @endif
                
                </div>
                <div class="col-lg-12">
                  <form method="get" action="/branch/search" style="width:250px; float:right; margin-bottom:10px" >
                      @csrf
                      <input type="text"  name='search' style="font-size:14px " placeholder="Tìm kiếm" class="form-control">
                      <button id='but' type='submit' hidden>do not click me</button>
                  </form>
                </div>
              </div>      
              <table class="table" >
                <thead>
                  <tr >
                    <th>#</th>
                    <th>Tên chi nhánh</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Số phòng</th>
                    <th >Hoạt động</th>
                  </tr>
                </thead>
                @foreach ($branch as $row)
                <tr  class="tr_course" >
                      <td class="stt">
                      
                        CN{{$row->id}}
                      
                      </td>
                      <td>

                        {{$row->name}}
                        
                      </td>
                      <td>
                        {{$row->address}}
                      </td>
                      <td>
                        {{$row->phone}}
                      </td>
                      <td>
                        {{$row->room}}
                        <div style="float: right" data-toggle="modal" data-target="#RoomCreate{{$row->id}}">
                          <i class="fi fi-rr-square-plus"></i>
                        </div>
                      </td>
                      <td>
                        <a style="margin: auto" href='branch/detail/{{$row->id}}'>
                          <button class="btn-hd" >Chi tiết</button>
                        </a>
                        <a>
                          <button class="btn-hd" style="background: rgb(253,160,29);" data-toggle="modal" data-target="#BranchEdit{{$a=$row->id}}" >
                            chỉnh sửa
                          </button>
                        </a>
                        @if (Auth::user()->type==0)
                          <a >
                            <button class="btn-hd" style="background: rgb(205, 59, 10);" data-toggle="modal" data-target="#reset{{$row->id}}" >
                              khôi phục MK
                            </button>
                          </a>
                        @endif
                       
                      </td>
                    </tr>
                    @include('modal.modal_room')
                    @include('modal.modal_editbranch')
                @endforeach
              </table>
              @include('modal.modal_branch')
       
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
              </div>
           </div>
           
          </div>
          <script>
            function editForm(){
                $a=document.get
            }
          </script>
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
      </html>
@endsection
<div class="col-lg-12 " >
    <div class="col1" style="border-radius:0px; width:100%;padding-top:10px; padding-bottom:15px">
        <div style="width:100%" class="text-center">
        
                <?php
                for($i=1;$i<13;$i++){
                    if($month==$i){
                        ?>
                            <button class="circle-focus" style="color: white">{{$i}}</button>
                        <?php
                    }else{
                        ?>
                    <a href="#"><button class="circle" style="submit">{{$i}}</button></a>
                            
                        <?php
                    }
                
                }
                ?>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="col1" style="background: white;border-radius:0px; width:100%;padding-top:15px; padding-bottom:15px">
        <table style="font-size: 15px;">
            <tr> 
                <td style="height: 100%; width:3px; background:#807676; ">     
                <td style="font-size:15px ;padding-left:15px">
                    Chi nhánh
                </td>
                <td style="padding-left:10px ">
                    {{$branch[0]->name}}
                </td>
            </tr>
            <tr>
                <td style="height: 100%; width:3px; background:#807676; ">     
                <td style="font-size:15px ;padding-left:15px">
                    Địa chỉ
                </td>
                <td style="padding-left:10px ">
                    {{$branch[0]->address}}
                </td>
            </tr>
            <tr>
                <td style="height: 100%; width:3px; background:#807676; ">     
                <td style="font-size:15px ;padding-left:15px">
                    Số điện thoại
                </td>
                <td style="padding-left:10px ">
                    0123456789
                    {{-- {{$branch[0]->phone}} --}}
                </td>
            </tr>
            <tr>
                <td style="height: 100%; width:3px; background:#807676; ">     
                <td style="font-size:15px ;padding-left:15px">
                    Email:
                </td>
                <td style="padding-left:10px ">
                    vietdaieduacation@gmail.com
                    {{-- {{$branch[0]->phone}} --}}
                </td>
            </tr>
        </table>
        
    </div>
</div>
{{--Count room---}}
<div class="col-lg-4 ">
    <div class="col1 zoom" style="background: white;border-radius:0px; width:100%;padding-top:15px; padding-bottom:15px">
        <table >
            <td style="height: 100%; width:3px; background:#807677; ">                            
            </td>
            <td>
                <i class="fi fi-rr-layers card-icon" style="color: rgb(253,160,29);"></i>
            </td>
            <td style="font-size:15px ;padding-left:15px">
                Tổng số phòng<br>
            <a style="color: black; font-size:30px; font-weight:bold">{{$branch[0]->room}}</a>
            
            </td>
        </table>
    </div>
</div>
{{---Count_teacher--}}
<div class="col-lg-4 ">
    <div class="col1 zoom" style="background: white;border-radius:0px; width:100%;padding-top:15px; padding-bottom:15px">
    
        <table >
            <td style="height: 100%; width:3px; background:#807676; ">                            
            </td>
            <td>
                <i class="fi fi-rr-chalkboard-user card-icon" style="color: #9072ff;"></i>
            </td>
            <td style="font-size:15px ;padding-left:15px">
                Tổng giáo viên<br>
            <a style="color: black; font-size:30px; font-weight:bold">{{$count_teacher}}</a>
            
            </td>
        </table>
    </div>
</div>
{{--Count_class---}}
<div class="col-lg-4 ">
    <div class="col1 zoom" style="background: white;border-radius:0px; width:100%;padding-top:15px; padding-bottom:15px">
        
        <table >
            <td style="height: 100%; width:3px; background:#807676; ">                            
            </td>
            <td>
                <i class="fi fi-rr-e-learning card-icon" style="color:green"></i>
            </td>
            <td style="font-size:15px ;padding-left:15px">
                Tổng lớp học<br>
            <a style="color: black; font-size:30px; font-weight:bold">{{$count_class}}</a>
            
            </td>
        </table>
    </div>
</div>