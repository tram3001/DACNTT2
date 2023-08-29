<div class="col1" style="background: white;">
    <div class="row" style="padding:10px">
       
        <div class="col-lg-12" style="padding-top:10px ">
            <a  class="h5">
                Danh sách học viên
            </a>
            <a data-toggle="modal" data-target="#ModalStudentBranch" style="float: right;">
                <i class="fi fi-rr-apps-add" style="font-size: 20px;color: rgb(115, 137, 216);"></i>
             
            </a>
        </div>
        <div class="col-lg-10"></div>
        <div class="col-lg-1 col-md-12 col-sm-12">  
            <div style="float: right">
                <button data-toggle="modal" data-target="#UploadStudent"  class="btn btn-warning">Tải File</button>
                @include('modal.modal_upload')
            </div>   
        </div>
        <div class="col-lg-1 col-md-12 col-sm-12" style="padding-bottom:20px">
            <form action="/export/excel_student" method="post" style="float: right">
                {{ csrf_field() }}
                <input type="submit" name="export_excel"  value="Xuất File" class="btn btn-success">
            </form>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-3" >
            @if (Auth::user()->type==0)
                <select name="" id="foo" class="form-control" style="width:100%">
                    @if (isset($branch[0]->id))
                        <option type="submit"><a href="#">{{$branch[0]->name}}</a></option>
                    @endif
                    <option value="">----Chi nhánh----</option>
                    
                        @foreach ($list_branch as $item)                           
                            <option value="/student/branch={{$item->id}}" type="submit"><a href="#">{{$item->name}}</a></option>
                        @endforeach
                
                </select>  
            @endif 
        </div>
        <div class="col-lg-3" style="float: right;">
            <form method="get" action="/student/search_student" style="width:100%;float:right;" >
                <?php $value='';?>
                {{ csrf_field() }}
                @if (isset($branch[0]->id))
                    <input name="branch" value="{{$branch[0]->id}}" hidden>
                @endif
                @if (isset($_GET['search']))
                    <?php $value=$_GET['search'];?>
                @endif
                <input type="text"  name='search' placeholder="Tìm kiếm " value="{{$value}}" class="form-control">
                <button id='but' type='submit' hidden>do not click me</button>
            </form>      
           
        </div>
       
        <div class="col-lg-12" style="padding-top: 10px">
            <table class="table">
                <thead style="">
                    <th>
                        #
                    </th>
                   
                    <th>
                        Họ và tên
                    </th>
                    <th>
                        Giới tính
                    </th>
                    <th>
                        Quốc tịch
                    </th>
                    <th>
                        Chi nhánh
                    </th>
                    <th>
                        Số điện thoại
                    </th>
                    <th>
                        Hoạt động
                    </th>  
                </thead>
                    <tbody >
                        <?php 
                            $d=0;                                       
                        ?>
                      @foreach ($list_student as $item)
                      <tr>
                        <td class="stt">{{$d=$d+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->sex}}</td>
                        <td>{{$item->nationality}}</td>
                        <td>
                            <?php $branch=DB::table('branch')->whereRaw('id=?',$item->branch)->get()->toArray()?>
                            {{$branch[0]->name}}
                        </td>
                        <td>{{$item->phone}}</td>
                        <td>
                           <a href="/student/detail_student/{{$item->id}}"><button class="btn-hd">Chi tiết</button></a>
                           <a data-toggle="modal" data-target="#delete{{$item->id}}"><button class="btn-hd delete">Xóa</button></a>
                        </td>
                      </tr>
                    @include('modal.modal_delete_student')
                      @endforeach
                    </tbody>
                                    
            </table>
            {{$list_student->links()}}
        </div>
    </div>
   
    
</div>
<script src="{{asset('js/link.js')}}"></script>