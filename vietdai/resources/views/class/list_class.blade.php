<div class="row">
    
<div class="col-lg-12" style="padding-top:10px ">
    <h5>DANH SÁCH LỚP HỌC</h5>
    @if (isset($course))
        <a style="color:#526484; font-size:15px" href="/course">Tên khóa học: {{$course[0]->name}}-{{$course[0]->language}}</a>
    @endif
    
</div>
<div class="col-lg-8" >
    <div >  
        <form action="/class/filter" method="get" enctype="multipart/form-data" > 
        {{ csrf_field() }}                     
        <div class="row" style="margin-top:20px">
            @if (isset($course))
               
            @endif
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div >
                    @if (Auth::user()->type==0)
                        <select name="branch" id="" class="form-control" style="height:40px;font-size:15px">
                            @if (isset($_GET['branch']))
                                <?php $name_branch=DB::table('branch')->whereRaw('id=?',$_GET['branch'])->get()->toArray();
                                    if (count($name_branch)) {
                                            # code...
                                        ?> <option value="{{$_GET['branch']}}" >{{$name_branch[0]->name}}</option><?php
                                    }
                                ?>
                            @endif
                                <option value="all">---Chi nhánh---</option>
                                <?php $branch=DB::table('branch')->get()->toArray()?>
                                @foreach ($branch as $item)
                                    <option value="{{$item->id}}" >{{$item->name}}</option> 
                                @endforeach
                        </select>
                    @else
                         <input type="text" hidden name="branch" value="{{$branch[0]->id}}">
                         <input class="form-control" value="{{$branch[0]->name}}" readonly>   
                    @endif
                        
                </div>                                 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="select_form">
                    <select name="form" id="" class="form-control" style="height:40px">
                        @if (isset($_GET['form']))
                            <?php
                                if($_GET['form']!='all'){
                                    $form_class=DB::table('form_class')->whereRaw('name=?',$_GET['form'])->get()->toArray();
                                    if(count($form_class))
                                    {
                                        ?>
                                            <option value="{{$_GET['form']}}">{{$_GET['form']}}</option>
                                            
                                        <?php
                                    }
                                   
                                }
                                
                            ?>
                        @endif
                        <option value="all">---Hình thức---</option>
                        <?php
                          $form_class=DB::table('form_class')->get()->toArray();  
                        ?>
                        @foreach ($form_class as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                        
                    </select>
                </div>                                   
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div>
                    <select name="status" id="" class="form-control" style="height:40px">
                        @if (isset($_GET['status']))
                        <?php
                            if($_GET['status']!='all'){
                                if($_GET['status']==1){
                                    ?> 
                                        <option value="{{$_GET['status']}}">Đang diễn ra</option>
                                    
                                    <?php
                                }if($_GET['status']==0){
                                    ?> 
                                        <option value="{{$_GET['status']}}">Kết thúc</option>
                                    
                                    <?php
                                }
                                if($_GET['status']==0){
                                    ?> 
                                        <option value="{{$_GET['status']}}">Sắp diễn ra</option>
                                    
                                    <?php
                                }
                                
                            }
                            
                        ?>
                    @endif
                        <option value="all">---Trạng thái---</option>
                        <option value="1">Đang diễn ra</option>
                        <option value="2">Sắp diễn ra</option>
                        <option value="0">Kết thúc</option>
                    </select> 
                </div>                                 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div>
                    <select name="language" id="" class="form-control" style="height:40px">
                        @if (isset($_GET['language']))
                        <?php
                            if($_GET['language']!='all'){
                               ?>
                                <option value="{{$_GET['language']}}">{{$_GET['language']}}</option>
                               <?php
                                
                            }
                            
                        ?>
                    @endif
                        <option value="all">---Ngôn ngữ---</option>
                        <?php $languages=DB::table('languages')->get()->toArray();?>
                        @foreach ($languages as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                    </select> 
                </div>       
            </div>
          
        </div>
        
    </div>
</div>
<div class="col-lg-1 col-md-3 col-sm-3" style="margin-top:20px">
    <button type="submit" style="background: none; border:none;"><i class="fi fi-rr-filter" style="font-size:25px"></i></button>
</div>
</form>
<div class="col-lg-3 col-md-12 col-sm-12">  
    <form method="get" action="/class/search_class" style=" margin-top:20px" >
        @csrf
            @if (isset($course))
                <input type="text" name='course' value="{{$course[0]->id}}" hidden>
            @endif
            <?php $value=''?>
            @if (isset($_GET['search']))
                <?php $value= $_GET['search']?>
            @endif
        <input type="text"name='search' style="font-size:14px;padding:10px;height:40px " value="{{$value}}" placeholder="Tìm kiếm theo mã lớp" class="form-control">
        <button id='but' type='submit' hidden>do not click me</button>
    </form>
</div>

<div class="col-lg-12" style="padding-top:20px ">
        <?php $d=0?>
        <table class="table">
            <thead >
                <th>
                #
                </th>
                <th>
                    Mã lớp
                </th>
                <th>
                    Chi nhánh
                </th>
                <th>
                    Hình thức
                </th>
                <th>
                    Giáo viên
                </th>
              
                <th>
                    Học viên
                </th>
                <th>
                    Tình trạng
                </th>
                <th>
                    Hoạt động
                </th>
            </thead>
            <tbody >
                @foreach ($class as $item)
                <tr>
                    <td class="stt" >{{$d=$d+1}}</td>
                    <td>{{$item->malop}}</td>
                    <td>
                        <?php
                            $branch=DB::table('branch')->whereRaw('id=?',$item->branch)->get()->toArray();
                            $branch=$branch[0]->name;
                        ?>
                        {{$branch}}
                    </td>
                    <td>
                        {{$item->ht}}
                    </td>
                    <td>
                        <?php
                            $teacher=DB::table('staff')->where('id',$item->teacher)->get()->toArray();
                        ?>
                        {{$teacher[0]->name}}
                    </td>
                    <td>
                        <?php
                            $count=DB::table('list_class')->where('class',$item->id)->count();
                        ?>
                        {{$count}}
                    </td>
                    <td>
                        <?php
                            if($item->status==1){
                                ?>
                                    <a style="color: rgb(253,160,29)">Đang diễn ra</a>
                                <?php
                            }if($item->status==0){
                                ?>
                                    <a style="color:green">Kết thúc</a>
                                <?php
                            }
                            if($item->status==2){
                                ?>
                                    <a style="color: rgb(253,160,29)">Sắp diễn ra</a>
                                <?php
                            }
                        ?>
                    </td>
                    <td>
                        <a href="/class/detail_class/class={{$item->id}}"><button class="btn-hd" >Chi tiết</button></a>
                        <a data-toggle='modal' data-target="#delete{{$item->id}}"><button class="btn-hd delete" >Xóa</button></a>
                    </td>
                    @include('modal.modal_delete')
                </tr>
            
            @endforeach
            </tbody>
        </table>
        {{$class->links()}}
</div>

    
</div>