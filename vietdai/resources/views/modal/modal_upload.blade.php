<form action="/import/import_staff" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="modal fade text-left" id="UploadStaff" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Tải File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 10px">
                       <div class="col-lg-12">
                        <input type="file" name="file" class="form-control" value="Tải execl" accept=".xlxs" style="background:rgb(207, 207, 233)">                        
                       </div>
                       
                    </div>
                    <div style="float: right;margin-top:15px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <input type="submit" name="export_excel"value="Tải File" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{--Course Upload---}}
<form action="/import/import_course" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="UploadCourse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Tải File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 10px">
                       <div class="col-lg-12">
                        <input type="file" name="file" class="form-control" value="Tải execl" accept=".xlxs" style="background:rgb(207, 207, 233)">                        
                       </div>
                       
                    </div>
                    <div style="float: right;margin-top:15px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <input type="submit" name="export_excel"value="Tải File" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{--Student Upload---}}
<form action="/import/import_student" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="UploadStudent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Tải File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 10px">
                       <div class="col-lg-12">
                        <input type="file" name="file" class="form-control" value="Tải execl" accept=".xlxs" style="background:rgb(207, 207, 233)">                        
                       </div>
                       
                    </div>
                    <div style="float: right;margin-top:15px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Hủy</button>
                        <input type="submit" name="export_excel"value="Tải File" class="btn btn-success">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>