<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Foreach_;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Exports\CourseExport;
use App\Imports\CourseImport;
use Maatwebsite\Excel\Facades\Excel;
use \Illuminate\Support\Facades\Mail;
class CourseController extends Controller
{
    //load trang course
    public function index(){  
        $course=DB::table('course')->orderByDesc('stt')->paginate(10);
        $language=DB::table('languages')->get()->toArray();
        if(Auth::user()->type==0){
            $branch=DB::table('branch')->orderByDesc('id')->get()->toArray();
        }else{
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }

        return view('course.index',compact('language','branch'))->with('course',$course);
    }
 
    public function search_course(Request $request){
        $course=DB::table('course')->where('id','Like','%'.$request->search.'%')->orWhere('language','Like','%'.$request->search.'%')->orWhere('name','Like','%'.$request->search.'%')->orWhere('id','Like','%'.$request->search.'%')->orderByDesc('stt')->paginate(10);
        $course->appends(['search' =>$request->search]);
        $language=DB::table('languages')->get()->toArray();
        if(Auth::user()->type==0){
            $branch=DB::table('branch')->get()->toArray();
        }else{
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        return view('course.index',compact('language','branch'))->with('course',$course);
    }
    //create course
    public function create(Request $request){
        // $idcourse=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->language)).''.preg_replace('/\b(\w)|./u', '$1', strtoupper($request->name));
        $id=mb_strtoupper($request->idcourse,"UTF-8");
        $course=DB::table('course')->whereRaw('id=?',$id)->get()->toArray();
        if(count($course)){
            return back()->with('message','Khóa học đã tồn tại');
        }
        DB::insert("INSERT INTO course (name,language,price,period,id,status)
        VALUES(:name,:language,:price,:period,:id,:status)", [ 
           ":name"        => mb_strtoupper( $request->name,"UTF-8"),
           ":language"=>mb_strtoupper($request->language,"UTF-8"),
           ":price"=>$request->price,
           ':period'=>$request->period,
           ':id'=>$id,
           ':status'=>1
            ]
        );
      
        return back()->with('success','Tạo khóa học thành công');
    }
    //edit course
    public function edit(Request $request){
        $price=filter_var($request->editprice, FILTER_SANITIZE_NUMBER_INT);
        DB::statement("UPDATE course SET period=?,price=? WHERE id =?", [$request->editperiod,(double)$price,$request->course]);
        return back()->with('success','Chỉnh sửa khóa học thành công');
    }
   
    //detail
    public function detail_course($id){
        if(Auth::user()->type==0){
            $course=DB::table('course')->whereRaw('id=?',$id)->get()->toArray();
            $class=DB::table('class')->whereRaw('course=?',$id);
            $class=$class->paginate(10);
            return view('course.detail_course',compact('class','course'))->with('i',(request()->input('page',1)-1)*10);
        }if(Auth::user()->type==1){
            $course=DB::table('course')->whereRaw('id=?',$id)->get()->toArray();
            $class=DB::table('class')->whereRaw('course=?',$id)->whereRaw('branch=?',Auth::user()->branch);
            $class=$class->paginate(10);
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            return view('course.detail_course',compact('class','course','branch'))->with('i',(request()->input('page',1)-1)*10);
        }
        
    }

    //search form course
    //class
    //open class
    public function create_class(Request $request){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');    
        $form=DB::table('form_class')->whereRaw('name=?',$request->form)->get()->toArray();
        $course=DB::table('course')->whereRaw('id=?',$request->course)->get()->toArray();
        $list_teacher=DB::table('staff')->where('id_branch',$request->branch)->whereRaw("status=?",1);
        $list_teacher=$list_teacher->where('languages','like','%'.$course[0]->language.'%')->get()->toArray();
        $count=count($list_teacher); 
        if($count==0){
            return back()->with('message','Hiện tại chưa có giáo viên thường trực bộ môn');
        }else{  
            $teacher=$list_teacher[0];   
            // $class=DB::table('class')->whereRaw('teacher=?',$teacher->id)->whereRaw('status=?',1)->get()->toArray();            
            return Redirect::to('course/create_class/'.$teacher->id.'&&'.$course[0]->id.'&&'.$form[0]->name);
        }    
       
    }    
    public function get_teacher($id, $course, $form){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $form=DB::table('form_class')->whereRaw('name=?',$form)->get()->toArray();
        $course=DB::table('course')->whereRaw('id=?',$course)->get()->toArray();
       if(Auth::user()->type==0){
            $teacher=DB::table('staff')->whereRaw('id=?',$id)->whereRaw("status=?",1)->get()->toArray();
            $teacher=$teacher[0];
            $room=DB::table('room')->whereRaw('id_branch=?',$teacher->id_branch)->whereRaw('status=?',1)->get()->toArray();
            $room_calendar=DB::table('class')->whereRaw('branch=?',$teacher->id_branch);
            $list_teacher=DB::table('staff')->where('id_branch',$teacher->id_branch)->whereRaw("status=?",1);
            $list_teacher=$list_teacher->where('languages','like','%'.$course[0]->language.'%')->get()->toArray();
            // $class=DB::table('class')->whereRaw('teacher=?',$teacher->id)->whereRaw('status=?',1)->orWhereRaw('status=?',2)->get()->toArray(); 
            $class=DB::table('class')->whereRaw('teacher=?',$teacher->id);
            $class=$class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();  
            $branch=DB::table('branch')->whereRaw('id=?',$teacher->id_branch)->get()->toArray();
            $list_class=DB::table('class')->whereRaw('branch=?',$branch[0]->id);
            $list_class=$list_class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();  
            $count=count($list_teacher);
       }else{
            $teacher=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw("status=?",1)->get()->toArray();
            $teacher=$teacher[0];
            $room=DB::table('room')->whereRaw('id_branch=?',$teacher->id_branch)->whereRaw('status=?',1)->get()->toArray();
            $room_calendar=DB::table('class')->whereRaw('branch=?',$teacher->id_branch);
            $list_teacher=DB::table('staff')->where('id_branch',$teacher->id_branch)->whereRaw("status=?",1);
            $list_teacher=$list_teacher->where('languages','like','%'.$course[0]->language.'%')->get()->toArray();
            $class=DB::table('class')->whereRaw('teacher=?',$teacher->id);
            $class=$class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();  
            $branch=DB::table('branch')->whereRaw('id=?',$teacher->id_branch)->get()->toArray();
            $list_class=DB::table('class')->whereRaw('branch=?',$branch[0]->id);
            $list_class=$list_class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();  
            $count=count($list_teacher);
       }

        return view('course.class', compact('dt','form','teacher','room','room_calendar','course','list_teacher','list_class','class','branch'));
      
        
       
    }
     //list_class
    public function list_class(){
        if(Auth::user()->type==0){
            $class=DB::table('class')->orderByDesc('id');
            $class=$class->paginate(10);
            return view('course.detail_course',compact('class'))->with('i',(request()->input('page',1)-1)*10);
        }if(Auth::user()->type==1){
            $class=DB::table('class')->whereRaw('branch=?',Auth::user()->branch)->orderByDesc('id');
            $class=$class->paginate(10);
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            return view('course.detail_course',compact('class','branch'))->with('i',(request()->input('page',1)-1)*10);
        }
        
    }
    //search_class
    public function search_class(Request $request){
        $branch_='';
        $count_class='';
        $branch=DB::table('branch')->get()->toArray();
        if(Auth::user()->type==0){
            if(isset($request->course)){
                $course=DB::table('course')->whereRaw('id=?',$request->course)->get()->toArray();
                $class=DB::table('class')->whereRaw('course=?',$request->course);
                $class=$class->where('malop','Like','%'.$request->search.'%')->orderByDesc('id')->paginate(10);
                $class->appends(['search'=>$request->search]);
                return view('course.detail_course',compact('class','course'))->with('class',$class);
            }else{
                $class=DB::table('class');
                $class=$class->where('malop','Like','%'.$request->search.'%')->orderByDesc('id')->paginate(10);
                $class->appends(['search'=>$request->search]);
                return view('course.detail_course')->with('class',$class);
            }

        }else{
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            if(isset($request->course)){
                $course=DB::table('course')->whereRaw('id=?',$request->course)->get()->toArray();
                $class=DB::table('class')->whereRaw('course=?',$request->course)->whereRaw('branch',Auth::user()->branch);
                $class=$class->where('malop','Like','%'.$request->search.'%')->orderByDesc('id')->paginate(10);
                $class->appends(['search'=>$request->search]);
                return view('course.detail_course',compact('course','branch'))->with('class',$class);
            }else{
                $class=DB::table('class')->whereRaw('branch=?',Auth::user()->branch);
                $class=$class->where('malop','Like','%'.$request->search.'%')->orderByDesc('id')->paginate(10);
                $class->appends(['search'=>$request->search]);
                return view('course.detail_course',compact('branch'))->with('class',$class);
            }
        }
            
    }
    
    //insert class
    ///Hàm đếm ngày kết thúc
    public function date_end($start,$calendar,$period,$time){ //đếm ngày kết thúc khóa học
        $date = Carbon::parse($start);
        $dayName = $date->dayOfWeek;if($dayName==0){$dayName=7;}
        $tuan=floor($period/$time); ///chia lấy nguyên
        $a=$period%$time;  $vt=0;$dem=0;
        for($i=0;$i<count($calendar);$i++){
            if($calendar[$i]==$dayName+1){
                $vt=$i;$dem=count($calendar)-$i;
                break;
            }
        } 
        if($vt!=0){
            if($a==0){
                $mondayOneWeekLater = $date->addWeeks($tuan); 
                $du=$calendar[$vt]-$calendar[$vt-1];;
                $end=$mondayOneWeekLater->subDays($du);
            }else{
                $mondayOneWeekLater = $date->addWeeks($tuan+1);
                $test=$period-$dem-$tuan*count($calendar);
                $end=$mondayOneWeekLater->subDays($calendar[$vt]-$calendar[$test-1]);
            }
        }
        else{
            if($a==0){
               
                $mondayOneWeekLater = $date->addWeeks($tuan-1); 
                $du=$calendar[count($calendar)-1]-$calendar[0];
                $end=$mondayOneWeekLater->addDays($du);
            }else{
                $mondayOneWeekLater = $date->addWeeks($tuan+1);
                $test=$period-$tuan*count($calendar);$du=$calendar[$a-1]-$calendar[0]; 
                $end=$mondayOneWeekLater->addDays($calendar[$test-1]-$calendar[0]);
            }
        } 
        return $end;
        

    }
    public function confirm_class(Request $request){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $today=$dt->format('Y-m-d');
        $start=$request->start;
        if(strtotime($start)>strtotime($today)){
            $calendar=array();
            $lich='';
            for($i=2;$i<9;$i++){
                for($j=1;$j<8;$j++){
                    $c='T'.''.$i.''.'C'.''.$j;
                    $d=$c.''.'t';
                    if(isset($request->$d)){
                        $arr=explode('/',$request->$d);
                        if(strtotime($start)<strtotime($arr[0]) || strtotime($start)==strtotime($arr[0])){
                            return back()->with('message','Lịch học bị trùng');
                        }else{
                            if($request->form=="Lớp tại trung tâm"){
                                $lich=$lich.'-'.$c.'_'.$arr[1];
                                array_push($calendar,$i);
                            }else{
                                $lich=$lich.'-'.$c;
                                array_push($calendar,$i);
                            }    
                        }
                    }
                    if(isset($request->$c)){
                        if($request->form=="Lớp tại trung tâm"){
                            $lich=$lich.'-'.$c.'_'.$request->$c;
                            array_push($calendar,$i);
                        }else{
                            $lich=$lich.'-'.$c;
                            array_push($calendar,$i);
                        }    
                    }
                }
            }
            
            if($calendar==''){
                return back()->with('message','Vui lòng chọn lịch học');
            }
            $date = Carbon::parse($start);
            $dayName = $date->dayOfWeek;if($dayName==0){$dayName=7;}
            if($request->end==''){
                if(in_array($dayName+1, $calendar)){
                    $end=$this->date_end($start,$calendar,$request->period,count($calendar));
                    $end=$end->format('Y-m-d');
                }else{
                    return back()->with('message','Vui lòng kiểm tra thời gian lớp học');
                }
            }
            if($request->end!=''){
                $end=$request->end;
            }
           
            //Tạo mã lớp 
            $id=DB::select("SELECT MAX(id)as max_val FROM class")[0]->max_val+1;  
            // $name=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->name));
            $nameteacher=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->nameteacher));
            $namebranch=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->namebranch));
            $malop=$namebranch.'-'.$request->course.''.$lich.'-'.date('Ymd',strtotime($start)).''.date('md',strtotime($end)).'-'.$nameteacher;
            if($request->form=="Lớp tại trung tâm"){
                $id_teacher=$request->teacher;
                $teacher=$request->nameteacher;
                $id_branch=$request->branch;
                $branch=$request->namebranch;
                $course=DB::table('course')->whereRaw('id=?',$request->course)->get()->toArray();
                $form=DB::table('form_class')->whereRaw('name=?',$request->form)->get()->toArray();
                $lich=explode('-',$lich);
                $note=$request->note;
                $mail=$request->email;
                array_shift($lich);
                return view('course.confirm_class',compact('course','branch','teacher','id_teacher','id_branch','form','lich','note','start','end','mail'));
            }else{
                DB::insert("INSERT INTO class(course,teacher,branch,calendar,bd,kt,status,malop,ht,note) values (:course,:teacher,:branch,:calendar,:bd,:kt,:status,:malop,:ht,:note)",[
                    ":course"=>$request->course,
                    ":teacher"=>$request->teacher,
                    ":branch"=>$request->branch,
                    ":calendar"=>$lich,
                    ":bd"=>$request->start,
                    ":kt"=>$end,
                    ":status"=>2,
                    ":malop"=>$malop,
                    ":ht"=>$request->form,
                    ":note"=>$request->note,
                ]);
                $max=DB::select('SELECT max(id) as max_id FROM class');
                $course=$request->course;$bd=$request->start;$kt=$end;$ht=$request->form; $mail=$request->email;
                Mail::send('mail.class',compact('course','bd','kt','malop','lich','ht'),function($email) use($course,$bd,$kt,$malop,$lich,$ht,$mail){
                    $email->subject('THÔNG BÁO LỚP HỌC MỚI');
                    $email->to($mail);
                });
                return redirect('/class/detail_class/class='.''.$max[0]->max_id);
            }
    
            
        }
        else{
            return back()->with('message','Vui lòng kiểm tra thời gian lớp học');
        }
       
    }
    public function save_class(Request $request){
        $start=$request->start;
        $end=$request->end;
        $calendar='';$room='';$lich='';
        $arr=explode('-',$request->calendar);
        array_shift($arr);
        foreach($arr as $row){
            $room=DB::table('room')->whereRaw('id=?',$request->$row)->get()->toArray();
            $calendar=$calendar.'-'.$row.'R'.$request->$row;        
            $lich=$lich.'-'.$row.''.$room[0]->name;
        }
        $nameteacher=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->nameteacher));
        $namebranch=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->namebranch));
        $malop=$namebranch.'-'.$request->course.''.$lich.'-'.date('Ymd',strtotime($start)).''.date('md',strtotime($end)).'-'.$nameteacher;
        
        DB::insert("INSERT INTO class(course,teacher,branch,calendar,bd,kt,status,malop,ht,note) values (:course,:teacher,:branch,:calendar,:bd,:kt,:status,:malop,:ht,:note)",[
                ":course"=>$request->course,
                ":teacher"=>$request->teacher,
                ":branch"=>$request->branch,
                ":calendar"=>$calendar,
                ":bd"=>$request->start,
                ":kt"=>$request->end,
                ":status"=>2,
                ":malop"=>$malop,
                ":ht"=>$request->form,
                ":note"=>$request->note,
        ]);
        $course=$request->course;$bd=$request->start;$kt=$end;$ht=$request->form; $mail=$request->mail;
        Mail::send('mail.class',compact('course','bd','kt','malop','lich','ht'),function($email) use($course,$bd,$kt,$malop,$lich,$ht,$mail){
            $email->subject('THÔNG BÁO LỚP HỌC MỚI');
            $email->to($mail);
        });
        $max=DB::select('SELECT max(id) as max_id FROM class');
        return redirect('/class/detail_class/class='.''.$max[0]->max_id);
        
    }
    //filter class
    public function filter(Request $request){
        if(Auth::user()->type==0){
            if($request->branch=='all' && $request->form=='all' && $request->status=='all' && $request->language=='all'){
                return Redirect::to('/class');
            }
            else{
                $class=DB::table('class');
                if($request->branch!='all'){
                    $class=$class->whereRaw('branch=?',$request->branch);
                }
                if($request->status!='all'){
                    $class=$class->whereRaw('status=?',$request->status);
                }
                if($request->form!='all'){
                    $class=$class->whereRaw('ht=?',$request->form);
                }
                if($request->language!='all'){
                    $arr=array();
                    $course=DB::table('course')->whereRaw('language=?',$request->language)->get()->toArray();
                    foreach($course as $row){
                        array_push($arr,$row->id);
                    }
                    $class=$class->whereIn('course',$arr);
                }
                
            }
            $class=$class->orderByDesc('id')->paginate(10);
            $class->appends(['branch'=>$request->branch,'status'=>$request->status,'form'=>$request->form,'language'=>$request->language]);
            return view('course.detail_course')->with('class',$class);
        }else{
            if( $request->form=='all' && $request->status=='all'){
                return Redirect::to('/class');
            }
            else{
                $class=DB::table('class');
                $class=$class->whereRaw('branch=?',Auth::user()->branch);
                if($request->status!='all'){
                    $class=$class->whereRaw('status=?',$request->status);
                }
                if($request->form!='all'){
                    $class=$class->whereRaw('ht=?',$request->form);
                }
                if($request->language!='all'){
                    $arr=array();
                    $course=DB::table('course')->whereRaw('language=?',$request->language)->get()->toArray();
                    foreach($course as $row){
                        array_push($arr,$row->id);
                    }
                    $class=$class->whereIn('course',$arr);
                }
                
            }
            $class=$class->orderByDesc('id')->paginate(10);
            $class->appends(['branch'=>$request->branch,'status'=>$request->status,'form'=>$request->form,'language'=>$request->language]);
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            return view('course.detail_course',compact('branch'))->with('class',$class);
        }
        
    }
    public function list_class_staff($id){
        if(Auth::user()->type==0){
            $class=DB::table('class')->whereRaw('teacher=?',$id)->orderByDesc('id')->paginate(10);
            $teacher=DB::table('staff')->whereRaw('id=?',$id)->get()->toArray();

        }if(Auth::user()->type==1){
            $teacher=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('id_branch=?',Auth::user()->branch)->get()->toArray();
            $class=DB::table('class')->whereRaw('teacher=?',$teacher[0]->id)->orderByDesc('id')->paginate(10);
        }if(Auth::user()->type==2){
            $teacher=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();
            $class=DB::table('class')->whereRaw('teacher=?',$teacher[0]->id)->orderByDesc('id')->paginate(10);
        }
        return view('staff.staff_class',compact('teacher'))->with('class',$class);
        
    }
   //filter class staff
   public function list_class_filter(Request $request){
        if(Auth::user()->type==0){
            $teacher=DB::table('staff')->whereRaw('id=?',$request->teacher)->get()->toArray();
        }if(Auth::user()->type==1){
            $teacher=DB::table('staff')->whereRaw('id=?',$request->teacher)->whereRaw('id_branch=?',Auth::user()->branch)->get()->toArray();
        
        }if(Auth::user()->type==2){
            $teacher=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();
        }
        if( $request->form=='all' && $request->status=='all'){
            return Redirect::to('/staff/list_class/',$teacher[0]->id);
        }
        else{
            $class=DB::table('class')->whereRaw('teacher=?',$teacher[0]->id);
            if($request->status!='all'){
                $class=$class->whereRaw('status=?',$request->status);
            }
            if($request->form!='all'){
                $class=$class->whereRaw('ht=?',$request->form);
            }
            $class=$class->paginate(10);
            $class->appends(['status'=>$request->status,'form'=>$request->form]);
        }
        return view('staff.staff_class',compact('teacher'))->with('class',$class);
   }
   public function list_class_search(Request $request){
        if(Auth::user()->type==0){
            $teacher=DB::table('staff')->whereRaw('id=?',$request->teacher)->get()->toArray();
        }if(Auth::user()->type==1){
            $teacher=DB::table('staff')->whereRaw('id=?',$request->teacher)->whereRaw('id_branch=?',Auth::user()->branch)->get()->toArray();        
        }if(Auth::user()->type==2){
            $teacher=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();        
        }
        $class=DB::table('class')->whereRaw('teacher=?',$teacher[0]->id);
        $class=$class->where('malop','Like','%'.$request->search.'%')->paginate(10);
        $class->appends(['search'=>$request->search]);
        return view('staff.staff_class',compact('teacher'))->with('class',$class);
   }

   //Export course
   public function export_course(Request $request){
        return Excel::download(new CourseExport, 'Course.xlsx');
   }
   public function import_course(Request $request){
        $path=$request->file('file')->getRealPath();
        Excel::import(new CourseImport,$path);
        return back()->with('success',"Tải file thành công");   
   }
   //edit class
   public function edit_class(Request $request){
        $malop=explode('-',$request->malop);
        echo $malop[count($malop)-2];
        $lich=$malop[0];
        for($i=1;$i<count($malop);$i++){
            if($i==(count($malop)-2)){
                $lich=$lich.'-'.date('Ymd',strtotime($request->start)).''.date('md',strtotime($request->end));
            }else{
                $lich=$lich.'-'.$malop[$i];
            }
        }
        DB::statement("UPDATE class SET malop=?, bd=?,kt=?,note=? where id=?",[$lich,$request->start,$request->end,$request->note,$request->id]);
        return back();
   }
   //delete class
    public function delete_class(Request $request){
        DB::statement("DELETE FROM class where id=?",[$request->id]);
        DB::statement("DELETE FROM list_class where class=?",[$request->id]);
        return redirect('/class');
   }

   //hide course
   public function hide_course(Request $request){
        DB::statement('UPDATE course set status=? where id=?',[2,$request->id]);
        return back();
   }
    //display course
    public function display_course(Request $request){
        DB::statement('UPDATE course set status=? where id=?',[1,$request->id]);
        return back();
    }
     //delete course
    public function delete_course(Request $request){
        DB::statement('DELETE from course  where id=?',[$request->id]);
        $class=DB::table('class')->whereRaw('course=?',$request->id)->get()->toArray();
        foreach($class as $row){
            DB::statement('DELETE from list_class  where class=?',[$row->id]);
        }
        DB::statement('DELETE from class  where course=?',[$request->id]);
        return back();

    }

    //select language
    public function select_language(){
        $languages=DB::table('languages')->get()->toArray();
        return view('languages.index', compact('languages'));
    }
    // change Room
    public function change_room(Request $request){
        $arr=explode('-',$request->calendar);
        array_shift($arr);
        $calendar='';$lich='';
        foreach($arr as $row){
            $key=mb_substr($row,0,4);
            if(isset($request->$key)){   
                $room=DB::table('room')->whereRaw('id=?',$request->$key)->get()->toArray();
                $calendar=$calendar.'-'.$key.'R'.$request->$key;  
            }else{
                echo mb_substr($row,5,strlen($row)-1);
                $room=DB::table('room')->whereRaw('id=?',mb_substr($row,5,strlen($row)-1))->get()->toArray();
                $calendar=$calendar.'-'.$key.'R'.mb_substr($row,5,strlen($row)-1);  
            }
            
                 
            $lich=$lich.'-'.$key.''.$room[0]->name;
        }
        $malop=explode('-',$request->malop);
        $malop=$malop[0].'-'.$malop[1].''.$lich.'-'.$malop[count($malop)-2].'-'.$malop[count($malop)-1];
        DB::statement("UPDATE  class set calendar=?,malop=? where id=?",[$calendar,$malop,$request->id]);
        
        // Mail::send('mail.class',compact('course','bd','kt','malop','lich','ht'),function($email) use($course,$bd,$kt,$malop,$lich,$ht,$mail){
        //     $email->subject('THÔNG BÁO LỚP HỌC MỚI');
        //     $email->to($mail);
        // });
        return back();
        
    }
    public function delete_language(Request $request){
        $course=DB::table('course')->whereRaw('language=?',$request->languages)->get()->toArray();
        foreach($course as $item){
            $class=DB::table('class')->whereRaw('course=?',$item->id)->get()->toArray();
            foreach($class as $class){
                DB::statement('DELETE from list_class where class=?',[$class->id]);
            }
            DB::statement('DELETE from class where course=?',[$item->id]);
        }
        DB::statement('DELETE from course where language=?',[$request->languages]);
        DB::statement('DELETE from languages where name=?',[$request->languages]);
        return back();
    }

}

