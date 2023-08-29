{{---Hide Teacher---}}
<form action="/hide_teacher" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="hideteacher{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>Bạn có muốn ẩn giáo viên: </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden value="{{$item->id}}" name="id">
                    <div style="padding-bottom: 10px">
                        <a href="/student/detail_student/{{$item->id}}" style="font-size: 15px;font-weight:bold">{{$item->name}} - CN: {{$row->name}}</a>
                    </div>
                    <div style="float:right" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn  btn-dialog delete" style="color: white">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{---Delete Teacher---}}
<form action="/delete_teacher" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="deleteteacher{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>Bạn có muốn xóa giáo viên: </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <a style="font-size: 15px">Các thông tin liên quan đến lớp học do giáo viên đó chịu trách nhiệm giảng dạy sẽ bị xóa.</a>
                    <input type="text" hidden value="{{$item->id}}" name="id">
                    <div style="padding-bottom: 10px">
                        <a href="/student/detail_student/{{$item->id}}" style="font-size: 15px;font-weight:bold">{{$item->name}} - CN: {{$row->name}}</a>
                    </div>
                    <div style="float:right" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn  btn-dialog delete" style="color: white">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{---Display Teacher---}}
<form action="/display_teacher" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="displayteacher{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>Bỏ ẩn giáo viên: </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden value="{{$item->id}}" name="id">
                    <div style="padding-bottom: 10px">
                        <a href="/student/detail_student/{{$item->id}}" style="font-size: 15px;font-weight:bold">{{$item->name}} - CN: {{$row->name}}</a>
                    </div>
                    <div style="float:right" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-success" style="color: white">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{---Reset password---}}
<form action="/reset_password" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="reset{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <a class="modal-title" style="font-weight:bold ">Cập nhật lại mật khẩu ban đầu cho {{$item->name}}?</a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                  
                    <input type="text" hidden name="name" value="{{$item->email}}">
                    <input type="text" hidden name="branch" value="{{$item->id_branch}}">
                    <input type="text" hidden name="staff" value="{{$item->id}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-warning">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>