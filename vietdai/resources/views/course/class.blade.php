@extends('layouts.app')
@section('content')
<html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/course.css')}}">
<body>
        <div id="main" >
          <div class="main-body">
            @if (Session::has('message'))
              <script>
                swal("Thông báo","{{Session::get('message')}}",'error',{
                    button:true,
                    button:"OK",
                })
              </script>
            @endif
          <form action="/course/create_class/confirm_class" method="POST" enctype="multipart/form-data"   >
            {{csrf_field()}}
            <div class="row" style="padding-right:30px;padding-top:20px">
               
               
             <?php          
                      
                $weekStartDate = $dt->startOfWeek();
                // $weekStartDate=$weekStartDate->next();
                $days=[];
                for($i=0; $i<7;$i++){
                  $days[] = $weekStartDate->copy();
                  $weekStartDate->addDay();
                }
              ?>
            
             <div class="col-lg-12" style="padding-top: 30px">
                <div class="col1" style="background: white;padding:25px">
                  <div class="row" style="padding-top: 10px">
                    <div class="col-lg-12">
                      <div style="margin-bottom:5px">
                          <h5>KHÓA HỌC</h5>
                      </div>
                      <table  class="table">
                          <input type="text" name="course"  value="{{$course[0]->id}}" hidden >
                          <input type="text" name="email"  value="{{$teacher->email}}" hidden >
                          <input type="text" name="name"  value="{{$course[0]->name}}-{{$course[0]->language}}" hidden >
                          <input type="text" name="branch"  value="{{$branch[0]->id}}" hidden > <input type="text" name="teacher"  value="{{$teacher->id}}" hidden >
                          <input type="text" name="nameteacher"  value="{{$teacher->name}}" hidden >
                          <input type="text" name="namebranch"  value="{{$branch[0]->name}}" hidden > <input type="text" name="form"  value="{{$form[0]->name}}" hidden >
                          <thead style="color: #3b2b74;font-size:15px;  ">
                            <th style="background-color:rgb(247,248,252);color:#020917">Tên khóa học</th>
                            <th style="background-color:rgb(247,248,252);color:#020917">Số buổi</th>
                            <th style="background-color:rgb(247,248,252);color:#020917">Học phí</th>
                            <th style="background-color:rgb(247,248,252);color:#020917">Chi nhánh</th>
                            <th style="background-color:rgb(247,248,252);color:#020917">Hình thức</th>
                            <th style="background-color:rgb(247,248,252);color:#020917">Giáo viên</th>
                          </thead>
                          <tbody style="color: #3b2b74;font-size:15px; ">
                            <tr>
                              <td >
                                {{$course[0]->name}}-{{$course[0]->language}}
                              </td>
                              <td >
                                {{$course[0]->period}}<input hidden value="{{$course[0]->period}}" name="period">
                              </td>
                              <td >
                                <?php echo number_format($course[0]->price)?>
                              </td>
                              <td >
                                {{$branch[0]->name}}
                              </td>
                              <td >
                                {{$form[0]->name}}
                              </td>
                              <td >
                                {{$teacher->name}}
                              </td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                      <div class="col-lg-3">
                        <label for="">Ngày bắt đầu</label>
                        <input type="date" name="start" id="start" class="form-control" required style="width:100%">
                      </div>
                      <div class="col-lg-3">
                        <label for="">Ngày kết thúc</label><a >có thể để trống</a>
                        <input type="date" name="end" value="" id="end" class="form-control"  style="width:100%">
                      </div>
                      <div class="col-lg-6">
                        <label for="" style="color: #f67e06">Ghi chú</label>
                        <textarea name="note" rows="3" style="width:100%" placeholder="Ghi chú" class="form-control"></textarea>
                      </div>
                      <div class="col-lg-9" style="padding-top:20px">
                        <h6>LỊCH TRONG TUẦN CỦA GIÁO VIÊN</h6>
                        <a style="color:#526484; font-size:14px">Giáo viên: {{$teacher->name}}-{{$course[0]->language}}</a>
                      </div>
                      <div class="col-lg-3" style="padding-top:20px">
                        <select name="" id="foo" class="form-control" style="width:100%">
                          <option value="">{{$teacher->name}}</option>
                          @foreach ($list_teacher as $item)                           
                              <option value="/course/create_class/{{$item->id}}&&{{$course[0]->id}}&&{{$form[0]->name}}" type="submit"><a href="#">{{$item->name}}</a></option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12" style="margin-top:10px">
                      <table class="table"style="text-align:center" >
                        <thead style="background-color:#F2426E">
                          <th ></th>
                          <?php
                            for($t=2;$t<9;$t++){
                              $k='T'.''.$t;
                              if($t==8){
                                $k='CN';
                              }
                              ?>
                                <th style="color: white">{{$k}}<br><a style="color: white; font-size:12px">{{$days[$t-2]->format('d-m-Y')}}</a></th>
                              <?php
                            }
                          ?>
                
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
                              <tr>
                                <td><b>Ca {{$i}}</td>
                                <?php
                                  for($j=2;$j<9;$j++){ 
                                    $key='T'.''.$j.''.'C'.''.$i;                                     
                                    ?>
                                      <td style="padding: 0px; padding-top:0px; padding-bottom:0px;height:50px">
                                        <?php
                                          $name_room='';$list_room='';$d=0;$p=0;
                                          foreach($room as $item){                                                    
                                            $count=0;
                                            $name=$key.''.'R'.''.$item->id;                                                
                                            foreach ($list_class as $l) {
                                                                # code...
                                              $d=strpos($l->calendar,$name);
                                              if($d!=null){
                                                $count=$count+1;
                                              }
                                            }
                                            if($count==0){
                                              $list_room=$list_room.'_'.$item->id; 
                                              $name_room=$name_room.' '.$item->name;
                                              $d=$d+1;
                                              $p=$p+1;
                                                                
                                            }
                                          }
                                          $a=strpos($teacher->calendar, $key );
                                          if($a!=''){
                                            if($class!=null){
                                              $calendar='';
                                              $dem=0;
                                              foreach ($class as $row) {
                                                # code...
                                                $arr_r=array();
                                                $arr=explode('-', $row->calendar);
                                                foreach ($arr as $k) {
                                                  # code...
                                                  $calendar=strpos($k,$key);
                                                  if($calendar!=''){
                                                    $dem=1;
                                                    $name=$row->course;
                                                    $link=$row->id;
                                                    $end=$row->kt;
                                                    $ht=$row->ht;
                                                    if($ht=="Lớp tại trung tâm"){
                                                      $romm=substr($k,5,strlen($k));
                                                      if(array_key_exists($romm, $arr)){
                                                       
                                                      }else{
                                                        array_push($arr_r,$romm);
                                                        $list_room=$list_room.'_'.$romm;
                                                      }
                                                    }
                                                    $kt=strtotime($row->kt);
                                                    $newDate = date('d-m', $kt);      
                                                  }
                                               
                                                }
                                              
                                               
                                            }if($dem==1){
                                              ?>
                                                <div style="color: white;background:#05591e;width:100%;height:100%;" >
                                                     <a href="/class/detail_class/class={{$link}}" style="font-size: 12px; color:white">                                                                
                                                          {{$name}}- 
                                                           KT:{{$newDate}}<br>
                                                           
                                                     </a><br>
                                                    <input type="checkbox" style="float:right; margin-botom:1px" value="{{$end}}/{{$list_room}}" name="{{$key.''.'t'}}">                                                                   
                                                </div>
                                              <?php
                                            }
                                            if( $dem==0 ){
                                                ?>
                                                  <div style="color: white;background:{{$color}};width:100%;height:100%;">
                                                      <a style="font-size: 14px; color:white"> VP</a>
                                                      <br>
                                                      <a style="color:#020917">Số PT:{{$p}}<br></a>
                                                      <?php
                                                     
                                                        if($p!=0 && $form[0]->choose==1){
                                                          ?>
                                                            <input type="checkbox" style="float:right; margin-botom:1px"  value="{{$list_room}}" name="{{$key}}" >
                                                          <?php
                                                        }if($form[0]->choose!=1){
                                                          ?>
                                                            <input type="checkbox" style="float:right; margin-botom:1px"  value="{{$list_room}}" name="{{$key}}" >
                                                          <?php
                                                        }
                                                      ?>
                                                            
                                                  </div>                                                               
                                                <?php
                                            }
                                              
                                          }else{
                                              ?>
                                                <div style="color: white;background:{{$color}};width:100%; height:100%;">
                                                  <a style="font-size: 14px; color:white"> VP</a>
                                                  <br>
                                                  <a style="color:#020917">Số PT:{{$p}}<br></a>
                                                  <?php
                                                 
                                                    if($p!=0 && $form[0]->choose==1){
                                                      ?>
                                                        <input type="checkbox" style="float:right; margin-botom:1px" value="{{$list_room}}" name="{{$key}}" >
                                                      <?php
                                                    }if($form[0]->choose!=1){
                                                      ?>
                                                        <input type="checkbox" style="float:right; margin-botom:1px" value="{{$list_room}}" name="{{$key}}" >
                                                      <?php
                                                    }
                                                  ?>
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
                    <div class="col-lg-12" style="padding-top: 10px">
                      <div style="float: right">
                        <button  type="reset" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                    </div>
                    </div>
                  </div>
                  
                </div>
              </div>
             </div>
            </div>
          </form>
          {{-- @include('modal.modal_class')data-toggle="modal" data-target="#confim_class" --}}
         </div>
        </div>
        <script>
          document.getElementById("foo").onchange = function() {
              if (this.selectedIndex!==0) {
                  window.location.href = this.value;
              }        
          };
          function ValidateDate(){

          }
      </script>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>

@endsection