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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        <meta name="_token" content="{{ csrf_token() }}">
        </head>
        <body style="background: rgb(247,248,252);">
          <div id="main" >
            <div class="main-body">
                <div  style="padding-right: 30px;padding-top:20px;">
                    <div class="col1" style="background: white">
                        @include('class.list_class')
                    </div>
                </div>
            </div>
          </div>

          {{-- <script src="{{asset('js/course_charts.js')}}"></script> --}}
         
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       
        </body>
      </html>
@endsection