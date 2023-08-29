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
      <div class="main-body">
          <div style="padding-top:30px;padding-right:30px ">
            <div class="col1" style=" background-color:white;padding:25px;" >
              <h5>chi tiết giáo viên</h5>
              <form action="/staff/detail_staff/update" method="POST" onsubmit="return validateCreate()">
                @csrf
                    <div class="row">
                      <div  class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <input hidden value="{{$staff[0]->id}}" name="id">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-following"></i> Họ và tên</label>
                        <input class="form-control"  type="text" value="{{$staff[0]->name}}" name="name" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-venus-mars"></i> Giới tính</label>
                        <input class="form-control"  type="text" value="{{$staff[0]->sex}}" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-calendar"></i> Ngày tháng năm sinh</label>
                        <input class="form-control" type="date" value="{{$staff[0]->date_birthday}}" readonly>
                      </div>
                      <div class="col-lg-12" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-map-marker-home"></i> Quê quán</label>
                        <input class="form-control" type="text" value="{{$staff[0]->address}}" name="address" readonly placeholder="Quê quán">
                      </div>
                      <div class="col-lg-12" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-map-marker-home"></i> Địa chỉ liên hệ</label>
                        @if (Auth::user()->type!=2)
                          <input class="form-control" type="text" value="{{$staff[0]->address1}}" name="address1" placeholder="Địa chỉ liên hệ">
                        @else
                          <input class="form-control" type="text" value="{{$staff[0]->address1}}" name="address1" readonly>
                        @endif
                        
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                          <label for="" style="font-size: 15px"><i class="fi fi-rr-phone-call"></i> Số điện thoại</label>
                          @if (Auth::user()->type!=2)
                            <input class="form-control"  type="text" value="{{$staff[0]->phone}}" name="phone" id="phone"  placeholder="Số điện thoại" required >
                          @else
                            <input class="form-control"  type="text" value="{{$staff[0]->phone}}" name="phone" id="phone"  placeholder="Số điện thoại" readonly >
                          @endif
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-envelope"></i> Email</label>
                        @if (Auth::user()->type!=2)
                          <input class="form-control"  type="text" value="{{$staff[0]->email}}" name="email" placeholder="Email" >
                        @else
                          <input class="form-control"  type="text" value="{{$staff[0]->email}}" name="email" readonly >
                        @endif
                        
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-id-badge"></i> CCCD/CMND</label>
                        @if (Auth::user()->type!=2)
                          <input class="form-control"  type="text" value="{{$staff[0]->cccd}}" name="cccd" id="cccd" >
                        @else
                          <input class="form-control"  type="text" value="{{$staff[0]->cccd}}" name="cccd" readonly >
                        @endif
                        
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-home-heart"></i> Hình thức làm việc</label>
                        @if (Auth::user()->type!=2)
                          <select name="form_work" id="" class="form-control">
                            <option value="{{$staff[0]->form_work}}">{{$staff[0]->form_work}}</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>  
                          </select>
                        @else
                            <input readonly class="form-control" value="{{$staff[0]->form_work}}">
                        @endif
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-home-heart"></i> Chi nhánh làm việc</label>
                        <select name="branch" id="" class="form-control">
                          <option value="{{$branch[0]->id}}">{{$branch[0]->name}}</option>
                          @if (Auth::user()->type==0)
                            <?php $branch=DB::table('branch')->get()->toArray();?>
                            @foreach ($branch as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 " style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-sack-dollar"></i> Bộ môn giảng dạy</label><br>
                        @if (Auth::user()->type!=2)
                          <?php $languages=DB::table('languages')->get()->toArray();?>
                          @foreach ($languages as $row)
                            <?php $check=strpos($staff[0]->languages,$row->name); if($check!=''){$check='checked';}?>
                            <label>
                              <input type="checkbox" value="{{$row->name}}" name="{{$row->id}}" 
                                  style="width:20px; " <?php echo $check?>>
                                  <a style="color:black; font-size:14px">{{$row->name}}</a>
                            </label>
                          @endforeach
                        @else
                          <?php $language=explode('-',$staff[0]->languages);?>
                          @foreach ($language as $item)
                              <a >{{$item}}</a>&ensp;  
                          @endforeach
                        @endif
                      </div>
                      
                      @if (Auth::user()->type!=2)
                      <div class="col-lg-6 col-md-6 col-sm-6 " style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-calendar-day"></i> <a href="/calendar/staff={{$staff[0]->id}}" style="color:#5E5DF0;"> Lịch làm việc của giáo viên</a></label> <br>
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-ballot"></i> <a href="/staff/list_class/staff={{$staff[0]->id}}" style="color:#5E5DF0;"> Danh sách lớp học giảng dạy</a></label>                   
                      </div>
                      <div class="col-lg-12">
                        <div style="text-align: center" >
                          <a style="margin-top: 10px;margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="tb"></a>
                        </div> 
                          
                      </div>
                        <div class="col-lg-12">
                          <div style="float: right">
                            <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                          </div>
                        </div>
                      @endif
                     
                    </div>
            
                
              </form> 
            </div>
      
          </div>
    </div> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
@endsection