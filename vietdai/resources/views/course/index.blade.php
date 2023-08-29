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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        </head>
        <body style="background: rgb(247,248,252);">
          <div id="main" >
            <div class="main-body">
              <div class="main-body">
                <div style="padding-top: 30px;padding-right:30px">
                <div class="col1" style="background: white;" >
                  @if (Session::has('success'))
                  <script>
                    swal("Thông báo","{{Session::get('success')}}",'success',{
                        button:true,
                        timer:3000,
                        button:"OK",
                    })
                  </script>
                @endif  
                  @if (Session::has('message'))
                    <script>
                      swal("Thông báo","{{Session::get('message')}}",'error',{
                          button:true,
                          timer:3000,
                          button:"OK",
                      })
                    </script>
                  @endif  
                  
                      <div class="row" style="padding-top:5px;padding: 10px ">
                        <div class="col-lg-12" >
                          <a class="h5">
                            Danh sách khóa học
                          </a>
                          @if (Auth::user()->type==0)
                            <a data-toggle="modal" data-target="#ModalCreate" style="float: right">
                              <i class="fi fi-rr-apps-add" style="font-size: 20px;color: rgb(115, 137, 216);"></i>
                            </a>
                          @endif
                        </div>
                         <div class="col-lg-10"></div>
                          <div class="col-lg-1 ">
                            @if (Auth::user()->type==0)
                              <button data-toggle="modal" data-target="#UploadCourse" class="btn btn-warning">Tải File</button>
                              @include('modal.modal_upload')
                            @endif
                            
                          </div>
                          <div class="col-lg-1">
                            <form action="/export/excel_course" method="post" style="float: right">
                              {{ csrf_field() }}
                              <input type="submit" name="export_excel" value="Xuất File" class="btn btn-success">
                            </form>
                          </div>
                        <div class="col-lg-12" style="padding-bottom:10px;padding-top:10px">                                           
                          <form method="get" action="/course/search" style="width:250px; float:right; margin-bottom:10px" >
                              @csrf
                              <?php $value="";?>
                              @if (isset($_GET['search']))
                                  <?php $value=$_GET['search']?>
                              @endif
                              <input type="text"  name='search' style="font-size:14px " value="{{$value}}" placeholder="Tìm kiếm" class="form-control">
                              <button id='but' type='submit' hidden>do not click me</button>
                          </form>
                        </div>
                        <div class="col-lg-12">
                          <table class="table">
                            <thead >
                              <tr>
                                <th >#</th>
                                <th>Mã khóa học</th>
                                <th >Tên khóa học</th>
                                <th >Ngôn ngữ</th>
                                <th >Số buổi</th>
                                <th >Học phí (VND)</th>
                                <th >Hoạt động</th>
                                {{-- <th>Trạng thái</th> --}}
                              </tr>
                            </thead>
                            <tbody>
                              <?php $d=0?>
                              @foreach ($course as $row)
                                <tr >
                                  <td style="color: #9072ff"><b>{{$d=$d+1}}</td>
                                  <td>{{$row->id}}</td>
                                  <td >{{$row->name}}</td>
                                  <td >{{$row->language}}</td>
                                  <td >{{$row->period}}</td>
                                  <td style="color:orange;font-weight:bold">
                                    <?php echo number_format($row->price)?>
                                  </td>
                                  <td >
                                    {{-- href='/course/create_class/{{$row->id}}' --}}
                                    @if ($row->status==1)
                                      <a style="margin: auto; "  >
                                        <button class="btn-hd"  style="background: #5E5DF0; "  data-toggle="modal" data-target="#ModalClass{{$a=$row->id}}">
                                          Mở lớp 
                                        </button>
                                      </a>
                                    @else
                                      <a style="margin: auto; "  >
                                        <button class="btn-hd" style="background: #5E5DF0;opacity: 0.2">
                                          Mở lớp 
                                        </button>
                                      </a>
                                    @endif
                                    @if (Auth::user()->type==0)
                                      <a style="margin: auto; "  data-toggle="modal" data-target="#Modaledit{{$a=$row->id}}">
                                        <button class="btn-hd" style="background:#fda01d;" >
                                          Chỉnh sửa
                                        </button>
                                      </a>
                                      @if ($row->status==1)
                                        <a style="margin: auto;">
                                          <button class="btn-hd" style="opacity:0.2" >
                                            Mở KH
                                          </button>
                                        </a>
                                        <a style="margin: auto; "  data-toggle="modal" data-target="#hide{{$a=$row->id}}">
                                          <button class="btn-hd" style="background:#f87706" >
                                            Ẩn KH
                                          </button>
                                        </a>
                                      @else
                                        <a style="margin: auto; "  data-toggle="modal" data-target="#display{{$a=$row->id}}">
                                          <button class="btn-hd" >
                                            Mở KH
                                          </button>
                                        </a>
                                        <a style="margin: auto; ">
                                          <button class="btn-hd" style="background:#f87706;opacity:0.2" >
                                            Ẩn KH
                                          </button>
                                        </a>
                                      @endif
                                      
                                      <a style="margin: auto; "  data-toggle="modal" data-target="#delete{{$a=$row->id}}">
                                        <button class="btn-hd" style="background: rgb(182, 53, 53)" >
                                          Xóa
                                        </button>
                                      </a>
                                    @endif
                                    @include('modal.modal_edit_openclass')
                                  </td>
                                </tr>
                              @endforeach
                            
                            </tbody>
                        
                          </table>
                          @include('modal.create_course')
                          {{$course->links()}}
                         </div>
                      </div>
                    
                </div>  
      
          </div>
{{--           
          <script src="{{asset('js/course_charts.js')}}"></script> --}}
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
      </html>
@endsection