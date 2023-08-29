
<form action="/delete_language" method="post" enctype="multipart/form-data" style="margin:auto" onsubmit="return validateCreate()">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="delete_laguage{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Xóa ngôn ngữ {{$item->name}}</h6>
                </div>
                <div class="modal-body">
                    <input type="text" hidden value="{{$item->name}}" name="language">
                    <a >Các thông tin liên quan đến ngôn ngữ {{$item->name}}</a>
                    <div style="margin-top:25px ; float:right;" >
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <button  type="submit" class="btn btn-dialog delete" style="color: white">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


