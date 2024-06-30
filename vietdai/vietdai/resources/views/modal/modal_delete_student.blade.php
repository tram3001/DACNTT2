{{---Delete Student---}}
<form action="/delete_student" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>Bạn có muốn xóa học viên: </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden value="{{$item->id}}" name="id">
                    <div style="padding-bottom: 10px">
                        <a href="/student/detail_student/{{$item->id}}" style="font-size: 15px;font-weight:bold">{{$item->name}} - CN: {{$branch[0]->name}}</a>
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