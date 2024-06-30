
<form action="/course/create" method="POST" enctype="multipart/form-data" style="margin:auto" onsubmit="return validateForm()" >
    {{ csrf_field() }}
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>TẠO KHÓA HỌC</h6>                 
                </div>
                <div class="modal-body" >
                    <div class="row" style="padding:10px; ">
                        <div class="col-lg-12" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-e-learning" ></i> Mã khóa học</label>
                            <input class="form-control"  type="text" value=""  placeholder="Mã khóa học" id="" name="idcourse">
                        </div>                  
                        <div class="col-lg-12" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-e-learning" ></i> Tên khóa học</label>
                            <input class="form-control"  type="text" value=""  placeholder="Tên khóa học" id="name" name="name">
                        </div>
                        <div class="col-lg-12" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-globe"></i> Ngôn ngữ</label>
                            <select class="form-control" name="language">
                                @foreach ($language as $row)
                                    <option>{{$row->name}}</option>
                                @endforeach
                            </select>                                    
                        </div>
                        <div class="col-lg-6" style="padding: 10px;">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-hourglass-end"></i> Số buổi</label>
                            <input class="form-control" id="period" type="text" value=""  placeholder="Số buổi" name="period">
                        </div>
                
                        <div class="col-lg-6" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-sack-dollar"></i> Học phí</label>
                            <input class=" form-control"  type="text" value=""  placeholder="Học phí" name="price" id="price">
                        </div>
                        <div class="col-lg-6">
                            <div style="float: right">
                                <a id="error" style="color:rgb(106, 8, 8)"></a>
                            </div>  
                        </div>
                        <div class="col-lg-6" >
                            <div style="float: right">
                                <a id="format_money" style="color:green; font-size:15px"></a>
                            </div>  
                        </div>
                    </div>
                    <div style="text-align: center" >
                        <a style="margin-top: 10px;margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="tb"></a>
                    </div>
                                
                    <div style="float:right;" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <button  type="submit" class="btn btn-dialog btn-success" id="save" >Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function validateFormEdit(id) {
        let period=document.getElementById("editperiod"+id).value;
        let price=document.getElementById("price"+id).value;
        if(period!=''){
            if(!/^[0-9]+$/.test(period)){
                document.getElementById('edittb'+id).innerHTML="Vui lòng kiểm tra số buổi";
                return false;
            }
        }
        if(price!=''){
            if(!/^[0-9]+$/.test(price)){
                document.getElementById('edittb'+id).innerHTML="Vui lòng kiểm tra học phí";
                return false;
            }
        }
        
        
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('js/money.js')}}"></script>