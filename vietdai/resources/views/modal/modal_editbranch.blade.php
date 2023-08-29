<form action="/branch/edit" method="post" enctype="multipart/form-data" style="margin:auto" onsubmit="return validateEdit({{$a}})">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="BranchEdit{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Chỉnh sửa thông tin chi nhánh</h6>
                    
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                     --}}
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 10px" >
                        <div class="col-lg-6">
                            <input value="{{$row->id}}" name="id" hidden>
                            <label style="font-size:15px; font-weight:bold"><i class="fi fi-rr-home-heart"></i> Tên chi nhánh</label><br>
                            <input class="form-control" type="text" value="{{$row->name}}" name="name" readonly required><br>
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size:15px;font-weight:bold" ><i class="fi fi-rr-phone-call"></i> Số điện thoại</label><br>
                            <input class="form-control" type="text" value="{{$row->phone}}" name="phone" id="phone{{$row->id}}"><br>
                        </div>
                        <div class="col-lg-12">
                            <label style="font-size:15px;font-weight:bold" ><i class="fi fi-rr-map-marker-home"></i> Địa chỉ chi nhánh</label><br>
                            <textarea name="address" class="form-control" id="" cols="30" rows="5">{{$row->address}}</textarea>
                            
                        </div>
                    </div>
                    <div style="text-align: center;margin-top:10px" >
                        <a style="margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="error{{$a}}"></a>
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
{{---Reset password---}}
<form action="/reset_password" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="reset{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Cập nhật lại mật khẩu ban đầu cho {{$row->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <?php  $namebranch=preg_replace('/\b(\w)|./u', '$1', strtoupper($row->name));?>
                    <input type="text" hidden name="name"  value="CN{{$row->id}}{{$namebranch}}">
                    {{-- <input type="text" hidden name="password" value="CN{{$row->id}}{{$namebranch}}"> --}}
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-warning">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{---Delete branch---}}
<form action="/delete_branch" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="delete{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Xóa chi nhánh {{$row->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id"  value="{{$row->id}}">
                    <a >Các thông tin liên quan đến chi nhánh sẽ bị xóa</a>
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog delete" style="color: white">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function validateEdit(id){
        let phone=document.getElementById("phone"+id).value;  
        var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        if(phone.match(phoneno)){
            return true;
        }  
        else {  
            document.getElementById("error"+id).innerHTML="Sai định dạng số điện thoại"
            return false;
        }
    }
    function validateCreate(){
        let phone=document.getElementById("phone_create").value;
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