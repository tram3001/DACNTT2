{{--Change Room--}}
<form action="/change_room" method="post" enctype="multipart/form-data" style="margin:auto">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="changeroom" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="margin-top:50px">
                <div class="modal-header">
                    <h6>ĐỔI PHÒNG</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body" >
                    {{---Xử lý room----}}
                    <input type="text" hidden  name="id" value="{{$class[0]->id}}">
                    <input type="text" hidden name="calendar" value="{{$class[0]->calendar}}">
                    <input type="text" hidden name="malop" value="{{$class[0]->malop}}">
                    <?php 
                        $rooms=DB::table('room')->whereRaw('id_branch=?',$branch[0]->id);
                        $rooms=$rooms->whereRaw('status=?',1)->get()->toArray();
                        $lich=explode('-',$class[0]->calendar); array_shift($lich);
                        $list_class=DB::table('class')->whereRaw('branch=?',$branch[0]->id);
                        $list_class=$list_class->where(function($query) {$query->where('status',1)->orWhere('status',2);})->get()->toArray();
                        if ($class[0]->status==2) {
                            $start=$class[0]->bd;
                        }else{
                            $start=$today;
                        }
                        ?> 
                            <table style="border: solid 1px;width:100%">
                                <tbody >
                                    <?php
                                        foreach ($lich as $item) {
                                            $key=mb_substr($item,0,4);
                                        ?>
                                            <tr>
                                                <td style="border: solid 1px;" >
                                                    <div>
                                                        <a style="font-weight:bold">{{$key}}</a>
                                                    </div>
                                                </td>
                                                <td style="border: solid 1px;" > 
                                                    <?php
                                                        foreach ($rooms as $room) {
                                                            $count=0;$d='';
                                                            $name=$key.''.'R'.''.$room->id;
                                                            foreach ($list_class as $l) { 
                                                                $d=strpos($l->calendar, $name );
                                                                if($d!=null){
                                                                    if($l->kt>=$start || $l->bd <=$class[0]->kt){
                                                                        $count=1;
                                                                    }
                                                                }
                                                            }
                                                            if($count==0){
                                                            ?>
                                                                <input type="radio" name="{{$key}}" value="{{$room->id}}">
                                                                <label for="">{{$room->name}}</label>&ensp;
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                   
                                </tbody>
                           </table>
                        <?php
                    ?>
                    <div style="float: right;padding-top:20px">
                        <button  type="button" class="btn  btn-dialog grey btn-outline-secondary" data-dismiss="modal">Không</button>
                        <button  type="submit" class="btn btn-dialog btn-success" style="color: white">Đồng ý</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</form>