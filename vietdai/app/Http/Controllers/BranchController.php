<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
// use StaffImport;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Exports\StaffExport;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;
class BranchController extends Controller
{
    //
    public function home(){
       
        return view('home');
    }
    public function branch(){
        if(Auth::user()->type==0){
            $branch=DB::table('branch')->get()->toArray();
            return view('branch.branch',compact('branch'));
        }if(Auth::user()->type==1){
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            $room=DB::table('room')->whereRaw('id_branch=?',Auth::user()->branch)->count();
            $teacher=DB::table('staff')->whereRaw('id_branch=?',Auth::user()->branch);
            $count_teacher=$teacher->count();
            $count_class=DB::table('class')->whereRaw('branch=?',Auth::user()->branch)->whereRaw('status=?',1)->count();
            return view('branch.detail_branch',compact('room','branch','count_teacher','count_class'));
        }
       
    }
     //Search Branch
     public function search_branch(Request $request){
        if(Auth::user()->type==0){
            $branch=DB::table('branch')->where('name','Like','%'.$request->search.'%')->orWhere('id','Like','%'.$request->search.'%')->orWhere('address','Like','%'.$request->search.'%')->get()->toArray();
            return view('branch.branch',compact('branch'));
        }
        
     }
     //Create branch
    public function create_branch(Request $request){
        DB::table('branch')->insert(array(
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address
        ));
        $max=DB::select('SELECT max(id) as max_id FROM branch');
        $namebranch=preg_replace('/\b(\w)|./u', '$1', strtoupper($request->name));
        $name_account='CN'.''.$max[0]->max_id.''.$namebranch;
        DB::insert("INSERT INTO users (name,password,change_pass,phone,branch,type) VALUES(:name,:password,:change_pass,:phone,:branch,:type)",[
            ":name"=>$name_account,
            ":password"=>bcrypt($name_account),
            ":change_pass"=>0,
            ":phone"=>$request->phone,
            ":branch"=>$max[0]->max_id,
            ":type"=>1
        ]);
        return redirect('/branch');
    }
    //delete branch
    public function delete_branch(Request $request){
        DB::statement('DELETE from room where id_branch=?',[$request->id]);
        DB::table('branch')->where('id',$request->id)->delete();
        DB::statement('DELETE from class where branch=?',[$request->id]);
        DB::statement('DELETE from list_class where branch=?',[$request->id]);
        DB::statement('DELETE from student where branch=?',[$request->id]);
        DB::statement('DELETE from staff where id_branch=?',[$request->id]);
        return redirect('/branch');
    }

    public function edit(Request $request){
        
        $branch=DB::table('branch')->where('id',$request->id)->update(
            [ 'name' => $request->name,
              'address'=> $request->address,
              'phone'=>$request->phone,
            ]
               
        );
        
      
        return redirect('/branch');
    }
    //Chi tiết chi nhánh
    public function detail_branch($id){
        if(Auth::user()->type==0){
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $today=$dt->format('m-Y'); 
            $month=$dt->month; 
            $branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            $room=DB::table('room')->whereRaw('id_branch=?',$id)->count();
            $teacher=DB::table('staff')->whereRaw('id_branch=?',$id);
            $count_teacher=$teacher->count();
            $count_class=DB::table('class')->whereRaw('branch=?',$id)->whereRaw('status=?',1)->count();
            return view('branch.detail_branch',compact('room','today','month','branch','count_teacher','count_class'));
        }
    }
   
  
    //room
    public function room(){
        if(Auth::user()->type==0){
            $room=DB::table('room')->get()->toArray();
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$list_branch[0]->id)->get()->toArray();
            return view('branch.room',compact('room','branch','list_branch'));
        }if(Auth::user()->type==1){
            $room=DB::table('room')->whereRaw('id_branch=?',Auth::user()->branch)->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            return view('branch.room',compact('room','branch'));
        }
        
    }
    //room branch
    public function room_branch($id){
        if(Auth::user()->type==0){
            $room=DB::table('room')->whereRaw('id_branch=?',$id)->get()->toArray();
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            return view('branch.room',compact('room','branch','list_branch'));
        }else{
            return redirect('/room');
        }
        
    }
    public function create_room(Request $request){
       $number=$request->number;
        $count_room=DB::table('room')->where('id_branch',$request->branch)->count();
        for($i=0;$i<$number;$i++){
            $count_room=$count_room+1;
            $name='P'."".$count_room;
            DB::table('room')->insert(
                array(
                    'name'=>$name,
                    'id_branch'=>$request->branch,
                    'status'=>1
                )
            );
        }
       return back();
       
    }
    //staff
    //create_staff
    public function create_staff(){
        if(Auth::user()->type!=2){
            $language=DB::table('languages')->get()->toArray();
            $branch=DB::table('branch')->get()->toArray();
            return view('staff.create_staff',compact('branch','language'))->with('i',(request()->input('page',1)-1)*10);
        }
       
    }
    public function insert_staff(Request $request){
        $language=DB::table('languages')->get()->toArray();
        $a="";
        foreach ($language as $row){
            $b=$row->id;
            if(isset($request->$b)){
                $a=$a."-".$request->$b;
            }
        }
        $calendar='';
        for($i=2;$i<9;$i++){
            for($j=1;$j<8;$j++){
                $c='T'.''.$i.''.'C'.''.$j;
                if(isset($request->$c)){
                        $calendar=$calendar.'-'.$c;
                }
            }
        }
        $email=DB::table('staff')->whereRaw('email=?',$request->email)->count();
        $phone=DB::table('staff')->whereRaw('phone=?',$request->phone)->count();
        $cccd=DB::table('staff')->whereRaw('cccd=?',$request->cccd)->count();
        if($email!=0||$phone!=0||$cccd!=0){
            return back()->with('error','Trùng thông tin email/ số điện thoại/ cccd');
        }
        DB::insert("INSERT INTO staff (name,phone,email,date_birthday,id_branch,languages,calendar,sex,address,form_work,cccd,address1,status)
        VALUES(:name,:phone,:email,:date_birthday,:id_branch,:languages,:calendar,:sex,:address,:form_work,:cccd,:address1,:status)", [ 
               ":name"        => $request->name,
               ":phone"         => $request->phone , 
               ":email"       => $request->email,
               ":date_birthday" => $request->date_of_birth,
               ":id_branch" => $request->branch,
               ":languages" => $a,
               ":calendar"  =>$calendar,
               ":sex"=>$request->sex,
               ":address"=>$request->address,
               ":form_work"=>$request->form_work,
                ":cccd"=>$request->cccd,
                ":address1"=>$request->address1,
                ":status"=>1


            ]
        );
        $max=DB::select('SELECT max(id) as max_id FROM staff');
        DB::insert("INSERT INTO users (name,password,change_pass,phone,branch,type,staff) VALUES(:name,:password,:change_pass,:phone,:branch,:type,:staff)",[
            ":name"=>$request->email,
            ":password"=>bcrypt($request->email),
            ":change_pass"=>0,
            ":phone"=>$request->phone,
            ":branch"=>$request->branch,
            ":type"=>2,
            ":staff"=>$max[0]->max_id,
        ]);   
           
        return redirect('/staff');
    }
    //update_staff
    public function update_staff(Request $request){
        $language=DB::table('languages')->get()->toArray();
        $a="";
        foreach ($language as $row){
            $b=$row->id;
            if(isset($request->$b)){
                $a=$a."-".$request->$b;
               
            }
        }
        
        DB::statement("UPDATE staff 
        SET address=?,phone=?,email=?,id_branch=?,languages=?,form_work=?,cccd=?,address1=? 
        WHERE id =?", [$request->address,$request->phone,$request->email,$request->branch,$a,$request->form_work,$request->cccd,$request->address1,$request->id]);
        return back();
    }
    public function staff(){
        if(Auth::user()->type==0){
            $list=DB::table('staff')->whereRaw("status=?",1)->orderByDesc("id")->paginate(10);
            $list_branch=DB::table('branch')->get()->toArray();
            $name="DANH SÁCH GIÁO VIÊN";
     
        }if(Auth::user()->type==1){
            $list=DB::table('staff')->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw("status=?",1)->orderByDesc("id")->paginate(10);
            $list_branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            $name="DANH SÁCH GIÁO VIÊN";
        }
       
        return view('staff.list_staff',compact('list','list_branch','name'))->with('i',(request()->input('page',1)-1)*10);
    }
    //calendar
    public function calendar($id){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->get()->toArray();     
            $room_calendar=DB::table('class')->whereRaw('branch=?',$staff[0]->id_branch);
            $teacher=$staff[0];
        }if(Auth::user()->type==1){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();     
            $teacher=$staff[0];
        }
        $dt=Carbon::now();
        $class=DB::table('class')->whereRaw('teacher=?',$teacher->id)->get()->toArray();
        return view('staff.staff_calendar', compact('teacher','class','dt'));
    }
      //calendar week
    public function calendar_week(Request $request){
        $dt=$request->dt;$dt=Carbon::parse($dt);
        $next=0;$back=0;
        if(isset($request->next)){
            $next=$request->next+1;
            $dt=$dt->addWeeks($next);
        }
        if(isset($request->back)){
            $back=$request->back+1;
            $dt=$dt->subWeeks($back);
        }
        if(Auth::user()->type==0){
            $staff=DB::table('staff')->whereRaw('id=?',$request->id)->get()->toArray();     
            $teacher=$staff[0];
        }if(Auth::user()->type==1){
            $staff=DB::table('staff')->whereRaw('id=?',$request->id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();     
            $teacher=$staff[0];
        }if(Auth::user()->type==2){
            $staff=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();     
            $teacher=$staff[0];
        }
       
        $class=DB::table('class')->whereRaw('teacher=?',$teacher->id)->get()->toArray();
        return view('staff.staff_calendar', compact('teacher','class','dt'));
    }
    //General calendar staff
    public function general_calendar_staff($id){
        if(Auth::user()->type==0){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->get()->toArray();     
            $room_calendar=DB::table('class')->whereRaw('branch=?',$staff[0]->id_branch);
            $teacher=$staff[0];
        }if(Auth::user()->type==1){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();     
            $teacher=$staff[0];
        }if(Auth::user()->type==2){
            $staff=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();     
            $teacher=$staff[0];
        }
        $class=DB::table('class')->whereRaw('teacher=?',$teacher->id);
        $class=$class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();
        return view('staff.staff_general_calendar', compact('teacher','class'));
    }
    public function edit_calendar($id){
        if(Auth::user()->type==0){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->get()->toArray();     
            $room=DB::table('room')->whereRaw('id_branch=?',$staff[0]->id_branch);
            $room_calendar=DB::table('class')->whereRaw('branch=?',$staff[0]->id_branch);
            $teacher=$staff[0];
        }if(Auth::user()->type==1){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();     
            $room=DB::table('room')->whereRaw('id_branch=?',$staff[0]->id_branch);
            $room_calendar=DB::table('class')->whereRaw('branch=?',$staff[0]->id_branch);
            $teacher=$staff[0];
        }
        $dt=Carbon::now();
        $class=DB::table('class')->whereRaw('teacher=?',$teacher->id)->get()->toArray();
        return view('staff.edit_calendar', compact('room','room_calendar','teacher','class'));
    }
    public function save_calendar(Request $request){
        $calendar='';
        for($i=2;$i<9;$i++){
            for($j=1;$j<8;$j++){
                $c='T'.''.$i.''.'C'.''.$j;
                if(isset($request->$c)){
                        $calendar=$calendar.'-'.$c;
                }
                }
        } 
        DB::statement("UPDATE staff SET calendar=? WHERE id =?", [$calendar,$request->id]);
        return redirect('calendar/staff='.$request->id);
    }
    // public function create_calendar($id){
    //     $staff=DB::table('staff')->where('id',$id)->get()->toArray();
    //     return view('staff.calendar',compact('staff'));
    // }
    //insert calendar for staff
    public function insert_calendar(Request $request){
        $mon="";$tue="";$wed="";$thu="";
        $fri="";$sat="";$sun="";
        for ($i=1;$i<9;$i++){
            $hai="hai".''.$i;
            $ba="ba".''.$i;
            $bon="bon".''.$i;$nam="nam".''.$i;
            $sau="sau".''.$i;$bay="bay".''.$i;$cn="cn".''.$i;
            if(isset($request->$hai)){
                $mon=$mon.'-'.$request->$hai;
            }
            if(isset($request->$ba)){
                $tue=$tue.'-'.$request->$ba;
            }
            if(isset($request->$bon)){
                $wed=$wed.'-'.$request->$bon;
            }
            if(isset($request->$nam)){$thu=$thu.'-'.$request->$nam;}
            if(isset($request->$sau)){$fri=$fri.'-'.$request->$sau;}
            if(isset($request->$bay)){$sat=$sat.'-'.$request->$bay;}
            if(isset($request->$cn)){$sun=$sun.'-'.$request->$cn;}
        }
        
        $calendar=DB::insert("INSERT INTO calendar values (:id,:name,:id_branch,:t2,:t3,:t4,:t5,:t6,:t7,:cn)",[
            ":id"=>$request->id,
            
        ]);
    }
    public function filter_staff(Request $request){
        if(Auth::user()->type==0){
            if($request->branch=='all' && $request->form=='all' && $request->language=='all'){
                return back();
            }
            else{
                $staff=DB::table('staff')->whereRaw('status=?',1);
                if($request->branch!='all'){
                    $staff=$staff->whereRaw('id_branch=?',$request->branch);
                }
                if($request->language!='all'){
                    $staff=$staff->where('languages','Like','%'.$request->language.'%');
                }
                if($request->form_work!='all'){
                    $staff=$staff->where('form_work','Like','%'.$request->form_work.'%');
                }
                           
            }
            $list=$staff->paginate(10);
            $list->appends(['branch'=>$request->branch,'form'=>$request->form,'language'=>$request->language]);
            $list_branch=DB::table('branch')->get()->toArray();
        }if(Auth::user()->type==1){
            if( $request->form=='all' && $request->language=='all'){
                return back();
            }
            else{
                $staff=DB::table('staff');
                $staff=$staff->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw('status=?',1);
                if($request->language!='all'){
                    $staff=$staff->where('languages','Like','%'.$request->language.'%');
                }
                if($request->form_work!='all'){
                    $staff=$staff->where('form_work','Like','%'.$request->form_work.'%');
                }
                           
            }
            $list=$staff->paginate(10);
            $list->appends(['branch'=>$request->branch,'form'=>$request->form,'language'=>$request->language]);
            $list_branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        return view('staff.list_staff',compact('list_branch'))->with('list',$list);
    }
    //search staff
    public function search_staff(Request $request){
        if(Auth::user()->type==0){
            $search=$request->search;
            $list_branch=DB::table('branch')->get()->toArray();
            $staff=DB::table('staff')->whereRaw('status=?',1);
            if($request->branch!='all'){
                $staff=$staff->whereRaw('id_branch=?',$request->branch);
            }
            if($request->language!='all'){
                $staff=$staff->where('languages','Like','%'.$request->language.'%');
            }
            if($request->form_work!='all'){
                $staff=$staff->where('form_work','Like','%'.$request->form_work.'%');
            }
            $list=$staff->where(function($query) use ($search)
            { $query->where('name','Like','%'.$search.'%')->orWhere('id','Like','%'.$search.'%')
                ->orWhere('address','Like','%'.$search.'%')->orWhere('phone','Like','%'.$search.'%')
                ->orWhere('sex','Like','%'.$search.'%')->orWhere('cccd','Like','%'.$search.'%')
                ->orWhere('address1','Like','%'.$search.'%')->orWhere('languages','Like','%'.$search.'%');})->paginate(10);
            $list->appends(['search'=>$request->search]);
        }if(Auth::user()->type==1){
            $list_branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            if($request->search==""){
               return redirect('/staff');
            }else{
                $search=$request->search;
                $staff=DB::table('staff')->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw('status=?',1);
                if($request->language!='all'){
                    $staff=$staff->where('languages','Like','%'.$request->language.'%');
                }
                if($request->form_work!='all'){
                    $staff=$staff->where('form_work','Like','%'.$request->form_work.'%');
                }
                $list=$staff->where(function($query) use ($search)
                { $query->where('name','Like','%'.$search.'%')->orWhere('id','Like','%'.$search.'%')
                    ->orWhere('address','Like','%'.$search.'%')->orWhere('phone','Like','%'.$search.'%')
                    ->orWhere('sex','Like','%'.$search.'%')->orWhere('cccd','Like','%'.$search.'%')
                    ->orWhere('address1','Like','%'.$search.'%')->orWhere('languages','Like','%'.$search.'%');})->paginate(10);
                $list->appends(['search'=>$search]);
            }
        }
        
        return view('staff.list_staff',compact('list_branch'))->with('list',$list);
    }
    //detail staff
    public function detail_staff($id){
        if(Auth::user()->type==0){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$staff[0]->id_branch)->get()->toArray();
        }if(Auth::user()->type==1){
            $staff=DB::table('staff')->whereRaw('id=?',$id)->whereRaw('id_branch=?',Auth::user()->branch)->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$staff[0]->id_branch)->get()->toArray();
        }
        if(Auth::user()->type==2){
            $staff=DB::table('staff')->whereRaw('id=?',Auth::user()->staff)->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$staff[0]->id_branch)->get()->toArray();
        }
        return view('staff.detail_staff',compact('staff','branch'));
    }
    public function export_staff(Request $request){
        return Excel::download(new StaffExport, 'Listteachers.xlsx');
    }
    public function import_staff(Request $request){
        $path=$request->file('file')->getRealPath();
        Excel::import(new StaffImport,$path);
        return back();
    }
    //calendar branch
    public function general_calendar(){
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$list_branch[0]->id)->get()->toArray();
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        $teacher=DB::table('staff')->whereRaw('id_branch=?',$branch[0]->id)->get()->toArray();
        return view('branch.General_calendar',compact('teacher','list_branch','branch'));
    }
    public function search_calendarB($id){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            $teacher=DB::table('staff')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
            return view('branch.General_calendar',compact('teacher','list_branch','branch'));
        }if(Auth::user()->type==1){
           return redirect('/general_calendar');
        }
       
    }

    //Calendar theo tuần
    public function calendar_branch(){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$list_branch[0]->id)->get()->toArray();
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        $teacher=DB::table('staff')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();$next=0;
        $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id)->get()->toArray();
        return view('branch.calendar_branch',compact('teacher','list_branch','class','branch','dt','next'));
    }
    public function calendar_branch_week(Request $request){
        $dt=$request->dt;$dt=Carbon::parse($dt);
        $next=0;$back=0;
        if(isset($request->next)){
            $next=$request->next+1;
            $dt=$dt->addWeeks($next);
        }
        if(isset($request->back)){
            $back=$request->back+1;
            $dt=$dt->subWeeks($back);
        }
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$request->idbranch)->get()->toArray();
           
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            // $name_branch=$list_branch[0]->name;
        }
        $teacher=DB::table('staff')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
        $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id)->get()->toArray();
        return view('branch.calendar_branch',compact('teacher','list_branch','class','branch','dt','next','back'));
    }
    public function search_calendar($id){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            $teacher=DB::table('staff')->whereRaw('id_branch=?',$id)->whereRaw('status=?',1)->get()->toArray();$next=0;
            $class=DB::table('class')->whereRaw('branch=?',$id)->get()->toArray();
            return view('branch.calendar_branch',compact('teacher','list_branch','class','branch','dt','next'));
        } return redirect('/calendar_branch');
       
    }
   
    //calendar branch room
    public function calendar_room(){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=$branch=DB::table('branch')->whereRaw('id=?',$list_branch[0]->id)->get()->toArray();
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        $room=DB::table('room')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
        $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id)->get()->toArray();
        return view('branch.calendar_room',compact('room','list_branch','class','dt','branch'));
    }
    public function calendar_roomB($id){
        $dt=Carbon::now();
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=$branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            $room=DB::table('room')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
            $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id)->get()->toArray();
            return view('branch.calendar_room',compact('room','list_branch','class','dt','branch'));
        }if(Auth::user()->type==1){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=$branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            $room=DB::table('room')->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw('status=?',1)->get()->toArray();
            $class=DB::table('class')->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();
            return view('branch.calendar_room',compact('room','list_branch','class','dt','branch'));
        }
        
    }
    //calendar room week
    public function calendar_rom_week(Request $request){
        $dt=$request->dt;$dt=Carbon::parse($dt);
        $next=0;$back=0;
        if(isset($request->next)){
            $next=$request->next+1;
            $dt=$dt->addWeeks($next);
        }
        if(isset($request->back)){
            $back=$request->back+1;
            $dt=$dt->subWeeks($back);
        }
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=$branch=DB::table('branch')->whereRaw('id=?',$request->idbranch)->get()->toArray();
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        $room=DB::table('room')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
        $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id)->get()->toArray();
        return view('branch.calendar_room',compact('room','list_branch','class','dt','branch'));
    }
    public function calendar_rom_general($id){
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=$branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
        }if(Auth::user()->type==1){
            $list_branch='';
            $branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
        }
        $room=DB::table('room')->whereRaw('id_branch=?',$branch[0]->id)->whereRaw('status=?',1)->get()->toArray();
        $class=DB::table('class')->whereRaw('branch=?',$branch[0]->id);
        $class=$class->where(function($query) {$query->where('status',1)->orwhere('status',2);})->get()->toArray();
        return view('branch.general_calendar_room',compact('room','list_branch','class','branch'));
    }

    //hide room
    public function hide_room(Request $request){
        DB::statement("UPDATE room set status=? where id=?",[2,$request->id]);
        return back();
    }

    //display room
    public function display_room(Request $request){
        DB::statement("UPDATE room set status=? where id=?",[1,$request->id]);
        return back();
    }

    //delete room
    public function delete_room(Request $request){
        DB::statement("DELETE from room where id=?",[$request->id]);
        return back();
    }

    //edit room
    public function edit_room(Request $request){
        DB::statement("UPDATE room set name=? where id=?",[$request->name,$request->id]);
        return back();
    }
    //hide teacher
    public function hide_teacher(Request $request){
        DB::statement("UPDATE staff set status=? where id=?",[2,$request->id]);
        return back();
    }

    //list hide teacher
    public function list_hide_teacher(){
        if(Auth::user()->type==0){
            $list=DB::table('staff')->whereRaw("status=?",2)->orderByDesc("id")->paginate(10);
            $list_branch=DB::table('branch')->get()->toArray();
            $name="DANH SÁCH GIÁO VIÊN";
     
        }else{
            $list=DB::table('staff')->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw("status=?",2)->orderByDesc("id")->paginate(10);
            $list_branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            $name="DANH SÁCH GIÁO VIÊN";
        }
       
        return view('staff.staff_hide',compact('list','list_branch','name'))->with('i',(request()->input('page',1)-1)*10);
    }
    //display teacher
    public function display_teacher(Request $request){
        DB::statement("UPDATE staff set status=? where id=?",[1,$request->id]);
        return back();
    }
    //Search hide teacher
    public function search_hide_teacher(Request $request){
        if(Auth::user()->type==0){
            $search=$request->search;
            $list_branch=DB::table('branch')->get()->toArray();
            $staff=DB::table('staff')->whereRaw('status=?',2);
            $list=$staff->where(function($query) use ($search)
            { $query->where('name','Like','%'.$search.'%')->orWhere('id','Like','%'.$search.'%')
                ->orWhere('address','Like','%'.$search.'%')->orWhere('phone','Like','%'.$search.'%')
                ->orWhere('sex','Like','%'.$search.'%')->orWhere('cccd','Like','%'.$search.'%')
                ->orWhere('address1','Like','%'.$search.'%')->orWhere('languages','Like','%'.$search.'%');})->paginate(10);
            $list->appends(['search'=>$request->search]);
        }else{
            $list_branch=DB::table('branch')->whereRaw('id=?',Auth::user()->branch)->get()->toArray();
            if($request->search==""){
               return redirect('/staff');
            }else{
                $search=$request->search;
                $staff=DB::table('staff')->whereRaw('id_branch=?',Auth::user()->branch)->whereRaw('status=?',2);
                $list=$staff->where(function($query) use ($search)
                { $query->where('name','Like','%'.$search.'%')->orWhere('id','Like','%'.$search.'%')
                    ->orWhere('address','Like','%'.$search.'%')->orWhere('phone','Like','%'.$search.'%')
                    ->orWhere('sex','Like','%'.$search.'%')->orWhere('cccd','Like','%'.$search.'%')
                    ->orWhere('address1','Like','%'.$search.'%')->orWhere('languages','Like','%'.$search.'%');})->paginate(10);
                $list->appends(['search'=>$search]);
            }
        }
        
        return view('staff.staff_hide',compact('list_branch'))->with('list',$list);
    }
    
}
