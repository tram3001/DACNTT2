{{---Ẩn phòng---}}
<form action="/edit_class" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="Editclass" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>chỉnh sửa lớp học</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="">Tên khóa học</label>
                            <input type="text" readonly  value=" {{$course[0]->name}}-{{$course[0]->language}}" class="form-control">
                        </div>
                        <input type="text" hidden name="id" value="{{$class[0]->id}}">
                        <div class="col-lg-12" style="padding-top:10px">
                            <label for="" >Mã lớp</label>
                            <input type="text" readonly name="malop" value=" {{$class[0]->malop}}" class="form-control">
                        </div>
                        <div class="col-lg-6" style="padding-top:10px">
                            <label for="">Ngày bắt đầu</label>
                            <input type="date" name="start" value="{{$class[0]->bd}}" class="form-control" >
                        </div>
                        <div class="col-lg-6" style="padding-top:10px">
                            <label for="" >Ngày kết thúc</label>
                            <input type="date" name="end" value="{{$class[0]->kt}}" class="form-control" >
                        </div>
                        <div class="col-lg-12" style="padding-top:10px">
                            <label for="" style="color: #f67e06">Ghi chú</label>
                            <textarea name="note" rows="1" style="width:100%; "  placeholder="Ghi chú" class="form-control" >{{$class[0]->note}}</textarea>
                        </div>
                    </div>
                    <div style="float: right;padding-top:20px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-success">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>