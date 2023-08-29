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
                        <div class="col-lg-12" style="padding-bottom: 30px">
                            <a class="h5">danh sách ngôn ngữ giảng dạy</a>
                        </div>
                        @foreach ($languages as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6" style="padding-bottom: 10px">
                            <div class="card-list" >
                              <article class="card" style="background: white">
                              <div class="card-header" style="background: white;margin:0px"> 
                                <img src="{{asset('storage/language.png')}}" style="width:100%" alt="" >
                                <table style="padding-top: 10px; display:flex">
                                  <tr>
                                    <td style="font-weight:bold;width:100px;vertical-align: top;">Ngôn ngữ</td>
                                    <td>{{$item->name}}</td>
                                  </tr>
                                  <tr>
                                    <?php $count=DB::table('course')->whereRaw('language=?',$item->name)->count();?>
                                    <td style="font-weight:bold;vertical-align: top;">Số khóa học</td>
                                    <td>{{$count}}</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="card-footer" style="background: white;">
                               <div style="float: right">
                                <a  href='/course/search?search={{$item->name}}'>
                                  <button class="btn-hd" >Danh sách</button>
                                </a>
                                @if (Auth::user()->type==0)
                                  <a >
                                    <button class="btn-hd" style="background: rgb(205, 59, 10);" data-toggle="modal" data-target="#delete_laguage{{$item->id}}" >
                                      Xóa
                                    </button>
                                  </a>
                                @endif
                               </div>
                             
                              </div> 
                                </article>
                            </div>
                            @include('languages.modal_create')
                          </div>
                        @endforeach
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