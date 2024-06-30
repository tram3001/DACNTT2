
<form action="/student/branch/save" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateCreate()">
    {{ csrf_field() }}
<div class="modal fade text-left" id="ModalStudentBranch" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document" style="background:white">
        <div class="modal-content">
            <div class="modal-header">
                <h6>THÊM học viên</h6>
            </div>
            <div class="modal-body" >
                    <div class="row" style="padding:10px; ">   
                        <div class="col-lg-12 col-md-12 col-sm-12"style="font-size: 15px">
                            <label for=""><i class="fi fi-rr-home-location-alt"></i></label>
                            @if (Auth::user()->type==0)
                                <select name="branch" id="" class="form-control">
                                    <?php $branch=DB::table('branch')->get()->toArray()?>
                                    @foreach ($branch as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" name="branch"  value="{{Auth::user()->branch}}" class="form-control " hidden>
                            @endif
                        </div>                   
                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:20px">
                            <label for=""> <i class="fi fi-rr-following"></i> Họ và tên</label>
                            <input type="text" name="name"  placeholder="Họ và tên" class="form-control " required>                  
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6"  style="margin-top:20px"  >
                            <label for="">  <i class="fi fi-rr-globe"></i> Quốc tịch</label>
                            <input type="text" name="natinonality" id="nationality" placeholder="Quốc tịch" class="form-control" >                       
                        </div>
                       
                        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:20px">
                            <label for=""><i class="fi fi-rr-phone-call"></i> Số điện thoại</label>
                            <input type="text" name="phone" id="phone" placeholder="Số điện thoại" class="form-control " required >                                                              
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:20px">
                            <label for=""><i class="fi fi-rr-venus-mars"></i> Giới tính</label>
                            <select name="sex" class="form-control">
                                <option value="Nữ">Nữ</option>
                                <option value="Nam">Nam</option>
                            </select>                                              
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:20px">
                            <label for=""> <i class="fi fi-rr-calendar-days"></i> Ngày tháng năm sinh</label>
                            <input type="date" name="date_of_birth"   class="form-control" >                             
                        </div>
                                        
                    </div>  
                    <div style="text-align: center;margin-top:10px" >
                        <a style="margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="error_"></a>
                    </div>
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                    </div>      
                   
                
              </div>
        </div>
    </div>
</div>
</form> 
<script>
function validateCreate(){
    let phone=document.getElementById("phone").value;
    if(phone!=''){
        var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        if(phone.match(phoneno)){
            return true;
        }  
        else {  
            document.getElementById("error_").innerHTML="Sai định dạng số điện thoại"
            return false;
    }
    } 
   
}


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>