{{---Hide room---}}
<form action="/hide_room" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="Rooman{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Chi nhánh {{$row->name}} ẩn phòng {{$item->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$item->id}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-warning">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{---Display room---}}
<form action="/display_room" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="display{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Chi nhánh {{$row->name}} mở phòng {{$item->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$item->id}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-success">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{---Delete room---}}
<form action="/delete_room" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Chi nhánh {{$item->name}} xóa phòng {{$item->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$item->id}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn  btn-dialog delete" style="color: white">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{---Edit room---}}
<form action="/edit_room" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="editroom{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>đổi tên phòng</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$item->id}}">
                    <label for="">Đổi tên phòng {{$item->name}}</label>
                    <input type="text" class="form-control" name="name" value="">
                    <div style="float: right; padding-top:10px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-success" >Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>