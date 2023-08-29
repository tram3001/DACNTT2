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
        
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        </head>
        <body style="background: rgb(247,248,252);">
          <div id="main" >
              <div class="main-body">
                <div class="row" style="padding-right:30px;padding-top:30px">
                    <div class="col-lg-12">
                        <div class="col1" style="padding: 20px">
                           @foreach ($branch as $row)
                            <a class="h5">phòng học chi nhánh {{$row->name}}</a>
                            <a style="float: right" data-toggle="modal" data-target="#RoomCreate{{$row->id}}">
                                <i class="fi fi-rr-square-plus"></i>
                            </a><br>
                            @include('modal.modal_room')
                           @endforeach
                            <a href="/room/calendar_week/branch={{$row->id}}" style="font-size: 15px">Lịch phòng của chi nhánh trong tuần</a>
                                <div class="row row-room " style="padding-top:20px">
                                    <div class="col-lg-9"></div>
                                    <div class="col-lg-3" style="padding-top:20px;padding-bottom:10px">
                                        @if (Auth::user()->type==0)
                                        <select name="" id="foo" class="form-control" style="width:100%">
                                            <option value="">{{$branch[0]->name}}</option>
                                            @foreach ($list_branch as $item)                           
                                                <option value="/room/branch={{$item->id}}" type="submit"><a href="#">{{$item->name}}</a></option>
                                            @endforeach
                                        </select>
                                        
                                        @endif
                                    </div>
                                    @foreach ($room as $item)
                                        @if($row->id==$item->id_branch)
                                            <div class="col-lg-3 col-md-6" style="margin-bottom:20px">
                                                <div class="card" style="padding:10px">
                                                    <div>
                                                        <i class="fi fi-rr-layers" style="font-size: 30px"></i>
                                                    </div>
                                                    <div >
                                                        <a style="font-weight:bold; font-size:15px">Số phòng:</a>
                                                        <a style=" font-size:15px">{{$item->name}}</a>
                                                        <a style="float: right" data-toggle="modal" data-target="#editroom{{$item->id}}"><i class="fi fi-rr-edit"></i></a>
                                                    </div>
                                                    <div style="width:100%;height:0.5px; background-color: rgb(220, 226, 220);margin:auto"></div>
                                                   <div >
                                                    <div style="float: right">
                                                        
                                                        @if ($item->status==1)
                                                            <a href="" ><button class="btn-hd" style="opacity:0.2" >Mở</button></a>
                                                            <a href="" data-toggle="modal" data-target="#Rooman{{$item->id}}"><button class="btn-hd" style="background:#f87706">Ẩn</button></a>
                                                        @else
                                                            <a href="" data-toggle="modal" data-target="#display{{$item->id}}"><button class="btn-hd"  >Mở</button></a>
                                                            <a href="" data-toggle="modal" data-target="#Rooman{{$item->id}}"><button class="btn-hd" style="background:#f87706;opacity:0.2">Ẩn</button></a>
                                                        @endif
                                                        
                                                        <a data-toggle="modal" data-target="#delete{{$item->id}}"><button class="btn-hd" style="background: rgb(182, 53, 53)">Xóa</button></a>
                                                    </div>
                                                   </div>
                                                   
                                                </div>
                                                @include('modal.modal_edit_room')
                                            </div>
                                        @endif
                                    @endforeach
                                    
                                </div>
                           
                          
                        </div>
                    </div>
                </div>
                  
                </button>
             
          
          </div>
       
            @include('modal.modal_room')
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