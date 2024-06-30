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
                            <h5>Danh sách lớp giảng dạy</h5>
                            <a class="link_a" href="/staff/detail/staff={{$teacher[0]->id}}">Giáo viên: {{$teacher[0]->name}}</a> 
                        </div>
                       
                        <div class="col-lg-6" >
                            <form action="/staff/list_class/filter" method="get" enctype="multipart/form-data" > 
                            {{ csrf_field() }}  
                            <input type="text" hidden value="{{$teacher[0]->id}}" name="teacher">
                            <div class="row" style="margin-top:20px">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="select_form">
                                        <select name="form" id="" class="form-control" style="height:40px">
                                            @if (isset($_GET['form']))
                                                <?php
                                                    if($_GET['form']!='all'){
                                                        $form_class=DB::table('form_class')->whereRaw('name=?',$_GET['form'])->get()->toArray();
                                                        if(count($form_class))
                                                        {
                                                            ?>
                                                                <option value="{{$_GET['form']}}">{{$_GET['form']}}</option>
                                                                
                                                            <?php
                                                        }
                                                       
                                                    }
                                                    
                                                ?>
                                            @endif
                                            <option value="all">---Hình thức---</option>
                                            <?php
                                              $form_class=DB::table('form_class')->get()->toArray();  
                                            ?>
                                            @foreach ($form_class as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div>
                                        <select name="status" id="" class="form-control" style="height:40px">
                                            @if (isset($_GET['status']))
                                            <?php
                                                if($_GET['status']!='all'){
                                                    if($_GET['status']==1){
                                                        ?> 
                                                            <option value="{{$_GET['status']}}">Đang diễn ra</option>
                                                        
                                                        <?php
                                                    }if($_GET['status']==0){
                                                        ?> 
                                                            <option value="{{$_GET['status']}}">Kết thúc</option>
                                                        
                                                        <?php
                                                    }
                                                    
                                                }
                                                
                                            ?>
                                        @endif
                                            <option value="all">---Trạng thái---</option>
                                            <option value="2">Sắp diễn ra</option>
                                            <option value="1">Đang diễn ra</option>
                                            <option value="0">Kết thúc</option>
                                        </select> 
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-3 col-sm-3" style="margin-top:20px">
                            <button type="submit" style="background: none; border:none;"><i class="fi fi-rr-filter" style="font-size:25px"></i></button>
                        </div>
                        <div class="col-lg-2"></div>
                        </form>
                        <div class="col-lg-3 col-md-12 col-sm-12">  
                            <form method="get" action="/staff/list_class/search" style=" margin-top:20px" >
                                @csrf
                                <input type="text" hidden name="teacher" value="{{$teacher[0]->id}}">
                                <?php $value="";?>
                                @if (isset($_GET['search']))
                                    <?php $value= ($_GET['search']);?>
                                @endif
                                <input type="text"name='search' style="font-size:14px;padding:10px;height:40px" value="{{$value}}" placeholder="Tìm kiếm theo mã lớp" class="form-control">
                                <button id='but' type='submit' hidden>do not click me</button>
                            </form>
                        </div>
                        <div class="col-lg-12" style="margin-top:20px">
                            <?php $d=0?>
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Mã lớp</th>
                                    <th>Hình thức</th>
                                    <th>Học viên</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                </thead>
                                <tbody>
                                   @foreach ($class as $item)
                                   <?php $count_hv=DB::table('list_class')->whereRaw('class=?',$item->id)->count();?>
                                       <tr>
                                            <td class="stt">{{$d=$d+1}}</td>
                                            <td ><a href="/class/detail_class/class={{$item->id}}" class="link_a">{{$item->malop}}</a></td>
                                            <td>{{$item->ht}}</td>
                                            <td>{{ $count_hv}}</td>
                                            <td>{{$item->bd}}</td>
                                            <td>{{$item->kt}}</td>
                                            <td>
                                                <?php
                                                    if($item->status==1){
                                                        ?>
                                                            <a style="color: rgb(253,160,29)">Đang diễn ra</a>
                                                        <?php
                                                    }if($item->status==0){
                                                        ?>
                                                            <a style="color:green">Kết thúc</a>
                                                        <?php
                                                    }
                                                    if($item->status==2){
                                                        ?>
                                                             <a style="color: rgb(253,160,29)">Sắp diễn ra</a>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                       </tr>
                                   @endforeach
                                </tbody>
            
                            </table>
                        
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