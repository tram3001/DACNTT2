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
                @foreach ($branch as $row)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="card-list" >
                    <article class="card" style="background: white">
                    <div class="card-header" style="background: white;margin:0px"> 
                      <img src="{{asset('storage/create_branch.png')}}" style="width:100%" alt="" >
                      <table style="padding-top: 10px; display:flex">
                        <tr>
                          <td style="font-weight:bold;width:80px;vertical-align: top;">Chi nhánh</td>
                          <td>{{$row->name}}_(CN{{$row->id}})</td>
                        </tr>
                        <tr>
                          <td style="font-weight:bold;vertical-align: top;">Địa chỉ</td>
                          <td>{{$row->address}}</td>
                        </tr>
                        <tr>
                          <td style="font-weight:bold;vertical-align: top;">SĐT</td>
                          <td>{{$row->phone}}</td>
                        </tr>
                      </table>
                    </div>
                    <div class="card-footer" style="background: white;">
                     <div style="float: right">
                      <a  href='branch/detail/branch={{$row->id}}'>
                        <button class="btn-hd" >Chi tiết</button>
                      </a>
                      <a>
                        <button class="btn-hd" style="background: rgb(253,160,29);" data-toggle="modal" data-target="#BranchEdit{{$a=$row->id}}" >
                          chỉnh sửa
                        </button>
                      </a>
                      @if (Auth::user()->type==0)
                        <a >
                          <button class="btn-hd" style="background: rgb(223, 81, 81);" data-toggle="modal" data-target="#reset{{$row->id}}" >
                            khôi phục MK
                          </button>
                        </a>
                        <a data-toggle="modal" data-target="#delete{{$row->id}}"> <button class="btn-hd" style="background: rgb(182, 53, 53);" >Xóa</button></a>
                    
                      @endif
                     </div>
                    </div>
                   
                  </article>
                  @include('modal.modal_room')
                  @include('modal.modal_editbranch')
                  </div>
                </div>
                
              @endforeach
               
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
          document.getElementById("foo").onchange = function() {
              if (this.selectedIndex!==0) {
                  window.location.href = this.value;
              }        
          };
          
      </script>
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
      </html>
@endsection