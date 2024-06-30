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
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    </head>
      <body>
          <div id="main">
            <div class="main-body">
             <div style="padding-top:30px;padding-right:30px">
                <div class="col1" style="padding-top:20px" >
                   <div class="row">
                    <div class="col-lg-12" >
                      <div style="float: right">
                        <button id="btn"  type="button" style="border:none;background:none"><i class="fi fi-rr-camera-viewfinder" style="font-size: 20px"></i></button>
                      </div>
                    </div>
                    <div class="col-lg-9" style="padding-top:20px">
                      <h5>LỊCH TRONG TUẦN CỦA CHI NHÁNH {{$branch[0]->name}}</h5>
                      <a  href="/calendar_branch/branch={{$branch[0]->id}}" style="font-size:15px">Xem lịch theo tuần</a>
                    </div>
                    <div class="col-lg-3" style="padding-top:20px">
                      @if (Auth::user()->type==0)
                        <select name="" id="foo" class="form-control" style="width:100%">
                          <option value="">{{$branch[0]->name}}</option>
                          @foreach ($list_branch as $item)                           
                              <option value="/general_calendar/branch={{$item->id}}" type="submit"><a href="#">{{$item->name}}</a></option>
                          @endforeach
                        </select>
                   
                      @endif
                    </div>
                   
                    {{-----Bảng lịch làm việc------}}
                      <div class="col-lg-12" id="capture">
                        <table class="table" style="text-align:center;margin-top:20px" >
                          <thead style="background-color: #526484;padding:auto" >
                            <th ></th>
                            <?php
                              for($t=2;$t<9;$t++){
                                $k='T'.''.$t;
                                if($t==8){
                                  $k='CN';
                                }
                                ?>
                                  <th style="color: white">{{$k}}<br><a style="color: white; font-size:12px"></a></th>
                                <?php
                              }
                            ?>
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
                                              $key='T'.''.$j.'C'.$i;
                                              $d=0;
                                              foreach($teacher as $item){
                                                $a=strpos($item->calendar, $key );$c=0;
                                                if($a!=''){
                                                  $class=DB::table('class')->whereRaw('teacher=?',$item->id);
                                                  $class=$class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();
                                                  if(count($class)){
                                                    foreach ($class as $kt) {
                                                      # code...
                                                      $b=strpos($kt->calendar, $key );
                                                      if ($b!='') {$c=1;
                                                        ?>
                                                          <a href="/class/detail_class/class={{$kt->id}}" style="font-size:10px;font-weight:bold" >{{$kt->malop}}</a><br>
                                                        <?php
                                                      }
                                                    }if($c==0){
                                                      $arr=explode(' ',$item->name);$name_='';$s=count($arr)-1 ;
                                                      
                                                      foreach ($arr as $value) {
                                                            # code...
                                                        $name=preg_replace('/\b(\w)|./u', '$1', strtoupper($value));
                                                        $name_=$name_.'.'.$name;
                                                       }
                                                      ?>
                                                      <a href="/staff/detail/{{$item->id}}" style="color: black">{{substr($name_,1,strripos($name_,'.'))}}{{$arr[count($arr)-1]}}</a><br><?php
                                                    }
                                                  
                                                  }else{
                                                    
                                                    $arr=explode(' ',trim($item->name));$name_='';$s=count($arr)-1 ;
                                                   
                                                    foreach ($arr as $value) {
                                                      # code...
                                                      $name=preg_replace('/\b(\w)|./u', '$1', strtoupper($value));
                                                      $name_=$name_.'.'.$name;
                                                    }
                                                  ?>
                                                    <a href="/staff/detail/staff={{$item->id}}" style="color:black">{{substr($name_,1,strripos($name_,'.'))}}{{$arr[count($arr)-1]}}</a><br><?php
                                                  }
                                                }
                                                $d=$d+1;
                                              }
                                              
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
         
          function capture() {
            const captureElement = document.querySelector('#capture')
            html2canvas(captureElement)
              .then(canvas => {
                canvas.style.display = 'none'
                document.body.appendChild(canvas)
                return canvas
              })
              .then(canvas => {
                const image = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream')
                const a = document.createElement('a')
                a.setAttribute('download', 'calendar.png')
                a.setAttribute('href', image)
                a.click()
                canvas.remove()
              })
          }

          const btn = document.querySelector('#btn')
          btn.addEventListener('click', capture)
          document.getElementById("foo").onchange = function() {
              if (this.selectedIndex!==0) {
                  window.location.href = this.value;
              }        
          };
         
    
      </script>
       <script type="text/javascript" src="html2canvas-master/dist/html2canvas.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
    </html>
@endsection