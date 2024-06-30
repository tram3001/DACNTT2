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
                      <a  href="/room/calendar_week/branch={{$branch[0]->id}}" style="font-size: 15px">Xem lịch phòng theo tuần</a>
                    </div>
                    <div class="col-lg-3" style="padding-top:20px;padding-bottom:10px">
                      @if (Auth::user()->type==0)
                        <select name="" id="foo" class="form-control" style="width:100%">
                          <option value="">{{$branch[0]->name}}</option>
                          @foreach ($list_branch as $item)                           
                              <option value="/room/calendar_general/branch={{$item->id}}" type="submit"><a href="#">{{$item->name}}</a></option>
                          @endforeach
                        </select>
                     
                      @endif
                    </div>
                    {{----Lịch phòng học theo tuần-----}}
                   
                      <div class="col-lg-12">
                        <table class="table" style="text-align:center;margin-top:20px">
                          <thead style="background-color: #526484;padding:auto" >
                              <th >#</th>
                              <th >T2</th>
                              <th >T3</th>
                              <th >T4</th>
                              <th >T5</th>
                              <th >T6</th>
                              <th >T7</th>
                              <th >CN</th>
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
                                                        $d=$d+1;$dpb=$dpb+1;
                                                        $str=$item->name.':'.$row->malop;
                                                        array_push($pb,$str);
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