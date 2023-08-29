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
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </head>
      <body>
          <div id="main">
            <div class="main-body">
             <div style="padding-top:30px;padding-right:30px">
                <div class="col1" style="padding-top:20px">
                 <div class="row">
                   <div class="col-lg-12" style="padding-bottom:10px">
                        <h5>Lịch trong tuần của giáo viên</h5>
                        @if (Auth::user()->type!=2)
                            <a href="/calendar/edit_calendar/staff={{$teacher->id}}" style="float: right"><i class="fi fi-rr-edit"></i></a>
                        @endif
                        <a class="link_a" href="/staff/detail/{{$teacher->id}}">Giáo viên: {{$teacher->name}}</a><br>
                        <a  href="/calendar/general/staff={{$teacher->id}}" style="font-size: 15px">Xem lịch giáo viên tổng quát</a><br>
                        <a  href="/calendar/staff={{$teacher->id}}" style="font-size: 15px">Tuần hiện tại</a>
                   </div>
                   {{---Xem lịch theo tuần----}}
                   <div class="col-lg-3">
                    <div style="float: left">
                      <form action="/calendar/staff/week" method="get">
                        @csrf
                        <input type="text" name="dt" value="{{$dt}}" hidden>
                        <input type="text" name="id" value="{{$teacher->id}}" hidden  >
                        <input type="text" name="back" value="0" id="" hidden>
                        <button type="submit" class="btn btn-primary">Tuần trước</button>
                      </form>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div style="text-align:center;font-weight:bold;font-size:20px;color:#526484">
                     {{$dt->startOfWeek()->format('d/m/Y')}} - {{$dt->endOfWeek()->format('d/m/Y')}}
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div style="float: right">
                      <form action="/calendar/staff/week" method="get">
                        @csrf
                        <input type="text" name="dt" value="{{$dt}}" hidden >
                        <input type="text" name="id" value="{{$teacher->id}}" hidden  >
                        <input type="text" name="next" value="0" hidden  >
                        <button type="submit" class="btn btn-primary">Tuần sau</button>
                      </form>
                      
                    </div>
                  </div>
                  {{------Lấy ngày trong tuần-------}}
                  <?php
                    $weekStartDate = $dt->startOfWeek();
                    // $weekStartDate=$weekStartDate->next();
                    $days=[];
                    for($i=0; $i<7;$i++){
                      $days[] = $weekStartDate->copy();
                      $weekStartDate->addDay();
                    }
                  ?>
                    
                    <div class="col-lg-12">
                        <table class="table" style="text-align:center;margin-top:20px">
                            <thead style="background-color: #526484;padding:auto" >
                                <th >#</th>
                                <th >T2<br><a style="color: white; font-size:12px">{{$days[0]->format('d-m')}}</a></th>
                                <th >T3<br><a style="color: white; font-size:12px">{{$days[1]->format('d-m')}}</a></th>
                                <th >T4<br><a style="color: white; font-size:12px">{{$days[2]->format('d-m')}}</a></th>
                                <th >T5<br><a style="color: white; font-size:12px">{{$days[3]->format('d-m')}}</a></th>
                                <th >T6<br><a style="color: white; font-size:12px">{{$days[4]->format('d-m')}}</a></th>
                                <th >T7<br><a style="color: white; font-size:12px">{{$days[5]->format('d-m')}}</a></th>
                                <th >CN<br><a style="color: white; font-size:12px">{{$days[6]->format('d-m')}}</a></th>
                            </thead>
                                <tbody >
                                    <?php
                                        for($i=1; $i<8; $i++){
                                        if($i<3){
                                            $color='#FD9722';
                                        }else if(2<$i&& $i<6){
                                            $color='#F2426E';
                                        }else{
                                            $color='#526484';
                                        }
                                    ?>
                                    <tr >
                                        <td ><b>Ca{{$i}}</td>
                                        <?php
                                        for($j=2;$j<9;$j++){ 
                                            $key='T'.''.$j.''.'C'.''.$i;                                     
                                            ?>
                                            <td style="padding: 0px; padding-top:0px; padding-bottom:0px;height:50px" >
                                                <?php
                                                $a=strpos($teacher->calendar, $key );
                                                if($a!=''){
                                                    if($class!=null){
                                                    $c=0;
                                                    $calendar='';
                                                    foreach ($class as $row) {
                                                        # code...
                                                        $calendar=strpos($row->calendar,$key);
                                                        if($calendar!=''){
                                                            $day=$days[$j-2];$day=$day->format('Y-m-d');
                                                            if(strtotime($row->bd)<=strtotime($day)&& strtotime($row->kt)>=strtotime($day) ){$c=1
                                                            ?>
                                                                <div style="color: white;background:#05591e;width:100%;height:100%;padding-top:10px;padding-bottom:15px;" >
                                                                    <a href="/class/detail_class/class={{$row->id}}" style="font-size: 12px; color:white">                                                                
                                                                        {{$row->malop}}
                                                                    
                                                                    </a>                                                                 
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                    }if($c==0){
                                                        ?>
                                                        <div style="color: white;background:{{$color}};width:100%; height:100%;padding-bottom:15px;padding-top:10px;margin:0px" class="text-center" >
                                                            <a style="font-size: 14px; color:white; "> VP
                                                            <br>                                                                                    
                                                        </div>                                                               
                                                        <?php
                                                        }
                                                    
                                                    }else{
                                                    ?>
                                                        <div style="color: white;background:{{$color}};width:100%; height:100%;padding-top:10px;padding-bottom:15px;" class="text-center" >
                                                            <a style="font-size: 14px; color:white"> VP
                                                            <br>                                                           
                                                        </div>                                                               
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                        </table>
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