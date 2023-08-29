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
          <div style="padding-right:30px;padding-top:30px">
            <div class="col1" style=" background-color:white;padding:25px" >
              <h5>chi tiết học viên</h5>
              <form action="/student/detail_student" method="POST" enctype="application/x-www-form-urlencoded" onsubmit="return ValidateUpdate()">
                @csrf
                    <div class="row">
                      <div  class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <input hidden value="{{$student[0]->id}}" name="id">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-following"></i> Họ và tên</label>
                        <input class="form-control"  type="text" value="{{$student[0]->name}}" name="name" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-venus-mars"></i> Giới tính</label>
                        <input class="form-control"  type="text" value="{{$student[0]->sex}}" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-calendar"></i> Ngày tháng năm sinh</label>
                        <input class="form-control"  value="{{$student[0]->date_of_birth}}" readonly>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                        <label for="" style="font-size: 15px"><i class="fi fi-rr-map-marker-home"></i> Quốc tịch</label>
                        <input class="form-control" type="text" value="{{$student[0]->nationality}}"  readonly>
                      </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                          <label for="" style="font-size: 15px"><i class="fi fi-rr-phone-call"></i> Số điện thoại</label>
                          <input class="form-control"  type="text" value="{{$student[0]->phone}}" name="phone" id="phone"  placeholder="Số điện thoại" required >
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px">
                          <label for="" style="font-size: 15px"> <i class="fi fi-rr-home-location-alt"></i> Chi nhánh</label>
                          <?php $branch=DB::table('branch')->whereRaw('id=?',$student[0]->branch)->get()->toArray();?>
                          <input class="form-control"  type="text" value="{{$branch[0]->name}}"  readonly >
                        </div>
                        <div class="col-lg-12" style="padding: 10px">
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Mã lớp</th>
                                    <th>Giáo viên</th>
                                    <th>Hình thức</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Tình trạng</th>
                                </thead>
                                <tbody>
                                    <?php $d=0?>
                                    @foreach ($list_class as $item)
                                 
                                    <tr>
                                      <td>{{$d=$d+1}}</td>
                                      <?php $class=DB::table('class')->whereRaw('id=?',$item->class)->get()->toArray()?>
                                      <td>
                                          <a href="/class/detail_class/class={{$class[0]->id}}">{{$class[0]->malop}}</a>
                                      </td>
                                      <td>
                                          <?php $teacher=DB::table('staff')->whereRaw('id=?',$class[0]->teacher)->get()->toArray();?>
                                          <a href="/staff/detail/staff={{$teacher[0]->id}}">{{$teacher[0]->name}}</a>
                                      </td>
                                      <td>{{$class[0]->ht}}</td>
                                      <td>
                                          {{$class[0]->bd}}
                                      </td>
                                      <td>
                                          {{$class[0]->kt}}
                                      </td>
                                      <td>
                                        <?php
                                          if($class[0]->status==1){
                                              ?>
                                                  <a style="color: rgb(253,160,29)">Đang diễn ra</a>
                                              <?php
                                          }if($class[0]->status==0){
                                              ?>
                                                  <a style="color:green">Kết thúc</a>
                                              <?php
                                          }
                                          if($class[0]->status==2){
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
                    </div>
            
                
              </form> 
            </div>
      
          </div>
    </div> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        function ValidateUpdate(){
        let phone=document.getElementById("phone").value;
            if(phone!=''){
                var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
                if(phone.match(phoneno)){
                    return true;
                }  
                else {  
                    document.getElementById("tb").innerHTML="Sai định dạng số điện thoại"
                    return false;
                }
            } 
       
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
@endsection