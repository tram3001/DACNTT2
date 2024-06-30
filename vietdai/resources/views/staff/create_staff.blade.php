@extends('layouts.app')
@section('content')
    @include('sweetalert::alert')
        <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
        crossorigin="anonymous">
        
    <link rel="stylesheet" href="{{asset('css/course.css')}}">
    <body style="background: rgb(247,248,252);">
    <div id="main" >
        <div class="main-body">
            <div style="padding-top: 20px">
                <div class="col1" style=" background-color:white;padding:25px;margin-right:40px" >
                    <h5>THÊM NHÂN VIÊN MỚI</h5>
                        <form action="/staff/save" method="post" enctype="multipart/form-data" onsubmit="return validateCreate()">
                            {{ csrf_field() }}
                            
                                <div class="row">
                                  <div  class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                   
                                    <label for="" style="font-size: 15px"><i class="fi fi-rr-following"></i> Họ và tên</label>
                                    <input class="form-control"  type="text" placeholder="Họ và tên" name="name" required>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                    <label for="" style="font-size: 15px"><i class="fi fi-rr-venus-mars"></i> Giới tính</label>
                                    <select name="sex" id="" class="form-control">
                                        <option  value="Nam" >Nam</option>
                                        <option  value="Nữ" >Nữ</option>
                                    </select>
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                    <label for="" style="font-size: 15px"><i class="fi fi-rr-calendar"></i> Ngày tháng năm sinh</label>
                                    <input class="form-control" type="date" name="date_of_birth" value="" required >
                                  </div>
                                  <div class="col-lg-12" style="padding: 10px">
                                    <label for="" style="font-size: 15px"><i class="fi fi-rr-map-marker-home"></i> Quê quán</label>
                                    <input class="form-control" type="text" value="" name="address" required placeholder="Quê quán">
                                  </div>
                                  <div class="col-lg-12" style="padding: 10px">
                                    <label for="" style="font-size: 15px"><i class="fi fi-rr-map-marker-home"></i> Địa chỉ liên hệ</label>
                                    <input class="form-control" type="text" value="" name="address1" required placeholder="Địa chỉ liên hệ">
                                  </div>
                                  <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                      <label for="" style="font-size: 15px"><i class="fi fi-rr-phone-call"></i> Số điện thoại</label>
                                      <input class="form-control"  type="text" value="" name="phone" id="phone"  placeholder="Số điện thoại" required >
                                  </div>
                                   <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                      <label for="" style="font-size: 15px"><i class="fi fi-rr-envelope"></i> Email</label>
                                      <input class="form-control"  type="text" value="" name="email" placeholder="Email" >
                                   </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                                      <label for="" style="font-size: 15px"><i class="fi fi-rr-id-badge"></i> CCCD/CMND</label>
                                      <input class="form-control"  type="text" value="" name="cccd" id="cccd" required >
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 10px">
                                        <label for="" style="font-size: 15px"><i class="fi fi-rr-home-heart"></i> Hình thức làm việc</label>
                                        <select name="form_work" id="" class="form-control">
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>  
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 10px">
                                      <label for="" style="font-size: 15px"><i class="fi fi-rr-home-heart"></i> Chi nhánh làm việc</label>
                                      <select name="branch" id="" class="form-control">
                                        @if (Auth::user()->type==0)
                                            <?php $branch=DB::table('branch')->get()->toArray();?>
                                            @foreach ($branch as $item)
                                              <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="{{$branch[0]->id}}">{{$branch[0]->name}}</option> 
                                        
                                        @endif
                                      </select>
                                    </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 " style="padding: 10px">
                                      <label for="" style="font-size: 15px"><i class="fi fi-rr-sack-dollar"></i> Bộ môn giảng dạy</label><br>
                                      <?php $languages=DB::table('languages')->get()->toArray(); $d=0?>
                                      @foreach ($languages as $row)
                                        <input type="checkbox" value="{{$row->name}}" name="{{$d=$d+1}}" 
                                          style="width:20px; " >
                                          <a style="color:black; font-size:14px">{{$row->name}}</a>
                                      @endforeach
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div style="padding: 10px; text-align:center">
                                            <a style="font-weight:bold ">ĐĂNG KÝ LỊCH LÀM VIỆC </a>
                                        </div>
                                        <table class="table"  style="margin-top: 0px;">
                                            <thead style="background-color: #526484" >
                                                <th></th>
                                                <th style="color:white;">T2</th>
                                                <th style="color:white;">T3</th>
                                                <th style="color:white;">T4</th>
                                                <th style="color:white;">T5</th>
                                                <th style="color:white;">T6</th>
                                                <th style="color:white;">T7</th>
                                                <th style="color:white;">CN</th>      
                                            </thead>
                                            <tbody>
                                                <?php
                                                    for ($i=1;$i<8;$i++){
                                                            
                                                ?>
                                                    <tr>
                                                        <td>Ca {{$i}}</td>
                                                        <?php
                                                            for($j=2;$j<9;$j++){
                                                        ?>
                                                            <td><input class="box_calendar"  type="checkbox" name="T{{$j}}C{{$i}}" ></td>
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
                                    <div class="col-lg-12">
                                        <div style="text-align: center" >
                                            <a style="margin-top: 10px;margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="tb"></a>
                                        </div> 
        
                                    </div>
                                    <div class="col-lg-12">
                                       
                                        <div  style="float: right">
                                            <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                                            <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </div>
                        </form> 
                        
                    
                </div>
               
                @if (Session::has('error'))
                <script>
                  swal("Thông báo","{{Session::get('error')}}",'error',{
                    button:true,
                    timer:3000,
                    button:"OK",
                  }) 
                </script>
              @endif  
            </div>
        </div>
       
        </body>
        <script>
            function validateCreate(){
               let phone=document.getElementById("phone").value;
               let cccd=document.getElementById("cccd").value;
               var cccdno= /^\+?([0-9]{4})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
               var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
                if(phone.match(phoneno) && cccd.match(cccdno)){
                    return true;
                }  
                else {  
                    document.getElementById("tb").innerHTML="Sai định dạng số điện thoại hoặc CCCD/CMND "
                    return false;
                }
               
           }
       
        
       </script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection