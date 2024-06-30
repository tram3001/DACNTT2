{{--Mở lớp học--}}
<form action="/course/create_class" method="post" enctype="multipart/form-data" style="margin:auto" class="fm">
    {{ csrf_field() }}
    <?php
     $course=DB::table('course')->where('id',$a)->get()->toArray();
    ?>
    <div class="modal fade text-left" id="ModalClass{{$a}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>MỞ LỚP</h6>
                </div>
                <div class="modal-body" >
                    
                    <div class="row" style="padding:10px; ">                        
                        <div class="col-lg-12"  style="padding: 10px;">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-e-learning" ></i> Khóa học</label><br>
                            <input type="text" class="form-control " name="name"  value="{{$course[0]->name}}-{{$course[0]->language}}" readonly >
                            <input type="text" value="{{$a}}" name="course" hidden>                     
                                            
                        </div>
                        
                        <div class="col-lg-6" style="padding: 10px;">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-hourglass-end"></i> Số buổi </label><br>
                            <input class="form-control"  type="text" value="{{$course[0]->period}}" readonly name="editperiod">
                        </div>
                        <div class="col-lg-6" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-sack-dollar"></i> Học phí</label><br>
                            <input class="form-control"  type="text" value="<?php echo number_format($course[0]->price)?>"  readonly name="price" >
                        </div>
                       
                        <div class="col-lg-6" style="padding: 10px;">
                            <label for="" style="font-size: 15px"> <i class="fi fi-rr-home-location-alt"></i> Chi nhánh </label><br>
                            @if (Auth::user()->type==0)
                                <select name="branch" class="form-control" >
                                    @foreach ($branch as $row)                                   
                                        <option value="{{$row->id}}">CN{{$row->id}}-{{$row->name}}</option>
                                    @endforeach                               
                                </select> 
                            @else
                                <input hidden value="{{$branch[0]->id}}" name="branch" >
                                <input class="form-control"  type="text" value="{{$branch[0]->name}}"  readonly >
                            @endif
                            
                        </div>
                        <div class="col-lg-6" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-chalkboard-user"></i> Hình thức</label><br>
                            <?php $form=DB::table('form_class')->get()->toArray();?>
                            <select name="form" class="form-control"  >
                                @foreach ($form as $row)                                   
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            
                            </select>
                        </div>
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

{{--Edit course--}}
<form action="/course/edit" method="post" enctype="multipart/form-data" style="margin:auto" onsubmit="return validateFormEdit({{$a}})">
    {{ csrf_field() }}
    <?php
     $course=DB::table('course')->where('id',$a)->get()->toArray();
    ?>
    <div class="modal fade text-left" id="Modaledit{{$a}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>KHÓA HỌC</h6>
                    {{-- <img src="{{asset('storage/form_course.png')}}" style="width:100%" alt="">                       --}}
                </div>
                <div class="modal-body" >
                   
                    <div class="row" style="padding:10px; ">
                        <div class="col-lg-12"  style="padding: 10px;">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-e-learning" ></i> Khóa học</label><br>
                            <input type="text" class="form-control " name="name"  value="{{$course[0]->name}}-{{$course[0]->language}}" readonly >
                            <input type="text" value="{{$a}}" name="course" id="{{$a}}" hidden>                     
                                            
                        </div>
                        
                        <div class="col-lg-6" style="padding: 10px;">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-hourglass-end"></i> Số buổi </label><br>
                            <input class="form-control" id="editperiod{{$a}}" type="text" value="{{$course[0]->period}}"  placeholder="Số buổi" name="editperiod">
                        </div>
                        <div class="col-lg-6" style="padding: 10px">
                            <label for="" style="font-size: 15px"><i class="fi fi-rr-sack-dollar"></i> Học phí</label><br>
                            <input type="text" hidden value="{{$course[0]->price}}" name="editprice" id="price{{$a}}">
                            <input class="form-control"  type="text" value="<?php echo number_format($course[0]->price)?>"  placeholder="Học phí" id="editprice{{$a}}">
                        </div>
                        <div class="col-lg-6"> 
                        </div>
                        <div class="col-lg-6" >
                            <div style="float: right">
                                <a id="format_price{{$a}}" style="color:green"></a>
                            </div>  
                        </div>
                    </div>    
                    <div style="text-align: center" >
                        <a style="margin-top: 10px;margin-botom:5px; color:rgb(210, 28, 28); font-weight:bold; font-size:15px;" id="edittb{{$a}}"></a>
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
{{--Hide course--}}
<form action="/hide_course" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="hide{{$a}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>Ẩn khóa học {{$course[0]->name}}-{{$course[0]->language}}?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$a}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-warning">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{--Display course--}}
<form action="/display_course" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="display{{$a}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>MỞ khóa học {{$course[0]->name}}-{{$course[0]->language}}?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <input type="text" hidden name="id" value="{{$a}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-success">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
{{--Delete course--}}
<form action="/delete_course" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="delete{{$a}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>XÓA khóa học {{$course[0]->name}}-{{$course[0]->language}}?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    <a style="font-size: 15px">Các lớp học liên quan đến khóa học sẽ bị xóa</a><br>
                    <input type="text" hidden name="id" value="{{$a}}">
                    <div style="float: right">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog delete" style="color: white">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $('#editprice'+'<?php echo $a ?>').on('keyup',function(){
        $value=$(this).val().replaceAll(",","");
        var num=Intl.NumberFormat('en-US').format($value);
        document.getElementById('format_price'+'<?php echo $a ?>').innerHTML=num;
        document.getElementById('price'+'<?php echo $a ?>').value=$value;
        
    })
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