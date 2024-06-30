<form action="/course/create_class/confirm_class/save" method="POST"  enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal fade text-left" id="confim_class" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                          <img src="{{asset('storage/form_course.png')}}" style="width:100%" alt=""> 
                        </div>
                        <div class="col-lg-6 ">
                          <div class="row" style="padding:10px; ">
                        
                            <div class="col-lg-1 col-md-1 col-sm-1" style="margin-top:20px">                           
                              <i class="fi fi-rr-e-learning" ></i>                          
                            </div>
                            <div class="col-lg-11 col-md-5 col-sm-5" style="margin-top:20px">
                                <input type="text" name="course"  value="{{$course[0]->id}}" hidden >
                                <a style="color: #526484">{{$course[0]->name}}</a>                       
                                <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style="margin-top:20px">
                              <i class="fi fi-rr-following"></i>
                            </div>
                            <div class="col-lg-11 col-md-5 col-sm-5"style="margin-top:20px">
                              <input type="text" name="teacher"  value="{{$teacher->id}}" hidden >
                              <a style="color: #526484">{{$teacher->name}}</a>                       
                              <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>  
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style="margin-top:20px" >                           
                              <i class="fi fi-rr-home-location-alt"></i>                          
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5"  style="margin-top:20px"  >
                                <input type="text" name="branch"  value="{{$branch[0]->id}}" hidden >
                                <a style="color: #526484">{{$branch[0]->name}}</a>                       
                                <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style=" margin-top:20px">                           
                              <i class="fi fi-rr-chalkboard-user"></i>                            
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5" style="margin-top:20px">
                              <input type="text" name="form"  value="{{$form[0]->name}}" hidden >
                              <input type="text" name="choose"  value="{{$form[0]->choose}}" hidden >
                              <a style="color: #526484">{{$form[0]->name}}</a>                       
                              <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style=" margin-top:20px">                           
                              <i class="fi fi-rr-calendar-days"></i>                           
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5" style="margin-top:20px">
                              <input type="date" value="" name="start" readonly style="border: none;width:100%">                     
                              <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style=" margin-top:20px">                           
                              <i class="fi fi-rr-arrow-small-right"></i>                            
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5" style="margin-top:20px">
                              <input type="date" value="" name="end" readonly style="border: none;width:100%">                            
                              <div class="col-lg-12" style="height: 1px; width:100%; background: #ddd8ef; ">  </div>                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1"style=" margin-top:20px">
                              <i class="fi fi-rr-sack-dollar"></i>
                            </div>
                          </div>
                        </div> 
                          <div class="col-lg-6">
                            <div class="col-lg-12">
                              <table style="width:100%; border: 1px solid rgb(222, 217, 217);margin-top:20px" class="text-center">
                                  <thead>
                                    <?php $calendar='';?>
                                    @foreach ($lich as $item)
                                    <?php  $t=mb_substr($item, 0,2);$c=mb_substr($item, 2,2) ;?>
                                      <th style="border: 1px solid rgb(222, 217, 217);background-color: #526484;color:white">
                                        {{$t}}_{{$c}}
                                        <?php $calendar=$calendar.'-'.$t.''.$c;?>
                                      </th>
                                    @endforeach
                                    <input type="text" hidden name="calendar" value="{{$calendar}}">
                                  </thead>
                                  <tbody >
                                    @foreach ($lich as $item)
                                    <td style=" border: 1px solid rgb(222, 217, 217);height:50px;  background: rgb(253,160,29);">
                                        <?php
                                        $t=mb_substr($item, 0,2);$c=mb_substr($item, 2,2);
                                        if($form[0]->choose!=1){
                                          ?>{{$form[0]->name}}<?php
                                        }else{
                                          $a=mb_substr($item, 6,strlen($item));
                                          $array=explode('_',$a);
                                          foreach($array as $row){
                                            $name=DB::table('room')->where('id',$row)->get()->toArray();
                                            ?>
                                              <input type="radio" name="'T'{{$t}}'C'{{$c}}" value="{{$row}}" id="" checked="checked">
                                              <label for="">{{$name[0]->name}}</label><br>
                                            <?php
                                          }
                                        }
                                        ?>
                                      </td>
                                    @endforeach
                                  </tbody>
                              </table>
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px">
                             <textarea name="note" rows="3" style="width:100%" placeholder="Ghi chú"></textarea>
                            </div>
                            <div class="col-lg-12"  style="margin-bottom: 20px">
                              <button type="submit" class='btn-class' style="width:40%; float: right;">Lưu</button>
                            </div>
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