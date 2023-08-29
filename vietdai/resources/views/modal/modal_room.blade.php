
<form action="/room/create" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="RoomCreate{{$row->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Thêm phòng</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label  style="font-size:15px" ><i class="fi fi-rr-house-building"></i> Chi nhánh:</label><br>
                            <input name="branch" value="{{$row->id}}" hidden>
                            <input class="input form-control" type="text" value="{{$row->name}}" readonly><br>
                        </div>
                        <div class="col-lg-6">
                           
                            <label  style="font-size:15px"><i class="fi fi-rr-layers"></i> Số phòng cần thêm</label><br>
                            <select name="number" class="form-control ">
                                <?php
                                    for($i=1;$i<21;$i++){
                                        ?>
                                         <option >
                                            {{$i}}
                                         </option>
                                        <?php
                                    }
                                ?>
                                   
                            </select>
                        </div>
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