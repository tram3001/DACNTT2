
<form action="/branch/create" method="post" enctype="multipart/form-data" style="margin:auto" onsubmit="return validateCreate()">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="BranchCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <img src="{{asset('storage/create_branch.png')}}" style="width:100%" alt="">  --}}
                    <h6>Tạo chi nhánh mới</h6>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-top:25px;margin-right:10px">
                        <div class="col-lg-6">
                            <label style="font-size:15px;font-weight:bold"><i class="fi fi-rr-home-heart"></i> Tên chi nhánh</label><br>
                            <input class=" form-control" type="text" value="" name="name" required><br>
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size:15px;font-weight:bold" ><i class="fi fi-rr-phone-call"></i> Số điện thoại</label><br>
                            <input class="form-control" type="text" value="" name="phone" id="phone_create"><br>
                        </div>
                        <div class="col-lg-12" >
                            <label for="" style="font-size: 15px;font-weight:bold"><i class="fi fi-rr-map-marker-home" ></i> Địa chỉ chi nhánh</label><br>
                            <textarea name="address" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div style="text-align: center;margin-top:10px" >
                        <a style="margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="error_"></a>
                    </div> 
                    <div style="margin-top:25px ; float:right;" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <button  type="submit" class="btn btn-dialog btn-success">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


