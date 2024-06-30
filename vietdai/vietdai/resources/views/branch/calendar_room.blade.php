@extends('layouts.app')
@section('content')
    <!doctype html>
    <html lang="en">
      <head>
       
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
                    <div class="col-lg-9" style="padding-top:20px;padding-bottom:10px">
                      <h5>LỊCH PHÒNG HỌC TRONG TUẦN CỦA CHI NHÁNH {{$branch[0]->name}}</h5>
                      <a  href="/room/calendar_general/branch={{$branch[0]->id}}" style="font-size: 15px">Xem lịch phòng chi nhánh tổng quát</a><br>
                      <a  href="/room/calendar_week/branch={{$branch[0]->id}}" style="font-size: 15px">Tuần hiện tại</a>
                    </div>
                    <div class="col-lg-3" style="padding-top:20px;padding-bottom:10px">
                      @if (Auth::user()->type==0)
                        <select name="" id="foo" class="form-control" style="width:100%">
                          <option value="">{{$branch[0]->name}}</option>
                          @foreach ($list_branch as $item)                           
                              <option value="/room/calendar_week/branch={{$item->id}}" type="submit"><a href="#">{{$item->name}}</a></option>
                          @endforeach
                        </select>
                     
                      @endif
                    </div>
                    {{----Lịch phòng học theo tuần-----}}
                    <div class="col-lg-3">
                      <div style="float: left">
                        <form action="/room/calendar_week" method="get">
                          @csrf
                          <input type="text" name="dt" value="{{$dt}}" hidden>
                          <input type="text" name="idbranch" value="{{$branch[0]->id}}" hidden>
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
                        <form action="/room/calendar_week" method="get">
                          @csrf
                          <input type="text" name="dt" value="{{$dt}}" hidden >
                          <input type="text" name="idbranch" value="{{$branch[0]->id}}" hidden>
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
                              <tbody>
                                <?php
                                  for($i=1;$i<8;$i++){
                                    ?>
                                      <tr>
                                        <td class="stt">Ca{{$i}}</td>
                                         <?php
                                            for($j=2;$j<9;$j++){?>
                                            <td>
                                            <?php
                                              $list_room='';$count=0;$pb= array('');$dpb=0;
                                              foreach($room as $item){
                                                $key='T'.''.$j.'C'.$i.'R'.$item->id; $d=0;
                                                foreach ($class as $row) {
                                                    # code...
                                                    $a=strpos($row->calendar,$key);
                                                    if ($a!='') {
                                                      $day=$days[$j-2];$day=$day->format('Y-m-d');
                                                      if(strtotime($row->bd)<=strtotime($day)&& strtotime($row->kt)>=strtotime($day) ){
                                                        $d=$d+1;$dpb=$dpb+1;
                                                        $str=$item->name.':'.$row->malop;
                                                        array_push($pb,$str);
                                                      }
                                                    }
                                                }if($d==0){
                                                    $list_room=$list_room.' '.$item->name;
                                                    $count=$count+1;
                                                }
                                                
                                              }?> 
                                              <a style="color: #526484" data-toggle="tooltip" data-placement="bottom" title="<?php foreach($pb as $pb){echo $pb; echo "\n";}?>">PB:{{$dpb}}</a><br>
                                              <a data-toggle="tooltip" data-placement="bottom" title="DSP:{{$list_room}}">PT:{{$count}}</a>
                                              
                                              <?php
                                              
                                            }?></td><?php
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
        <script>
          document.getElementById("foo").onchange = function() {
              if (this.selectedIndex!==0) {
                  window.location.href = this.value;
              }        
          };
          
      </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
@endsection