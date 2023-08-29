<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
class StudentController extends Controller
{
    
    //create student class
    public function create(Request $request)
    {   
        $count_class=DB::table('class')->whereRaw('id=?',$request->class)->get()->toArray();
        $d=DB::table('student')->whereRaw('id=?',$request->class)->count()+1;
        // $mahv=$count_class[0]->malop.'-'.$d;
        DB::insert("INSERT INTO student (name,nationality,phone,date_of_birth,sex,branch) Values (:name,:natinonality,:phone,:date_of_birth,:sex,:branch)",[
            ":name"=>$request->name,
            ":natinonality"=>$request->natinonality,
            ":phone"=>$request->phone,
            ":date_of_birth"=>$request->date_of_birth,
            ":sex"=>$request->sex,
            ":branch"=>$request->branch,
        ]);
        $max=DB::select('SELECT max(id) as max_id FROM student');
       
        DB::insert("INSERT INTO list_class (class,student,branch) VALUES (:class,:student,:branch)",[
            ":class"=>$request->class,
            ":student"=>$max[0]->max_id,
            ":branch"=>$request->branch,
        ]);
        return back()->with('success','Thêm học viên thành công');
        
    }


    public function select($id){
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $today=$dt->format('Y-m-d'); 
        if(Auth::user()->type==0){
            $list_class=DB::table('list_class')->whereRaw('class=?',$id)->get()->toArray();
            $a=[];
            foreach($list_class as $row){
               array_push($a,$row->student);
            }
            $list_student=[];
            $student=DB::table('student')->get()->toArray();
            foreach($student as $row){
                if(in_array($row->id,$a)){
                    $item=DB::table('student')->whereRaw('id=?',$row->id)->get()->toArray();
                    array_push($list_student,$item);
                }
            }
            
            $count=DB::table('list_class')->whereRaw('class=?',$id)->count();
            $class=DB::table('class')->whereRaw('id=?',$id)->get()->toArray();
           
        }if(Auth::user()->type==1){
            $list_class=DB::table('list_class')->whereRaw('class=?',$id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();
            $a=[];
            foreach($list_class as $row){
               array_push($a,$row->student);
            }
            $list_student=[];
            $student=DB::table('student')->get()->toArray();
            foreach($student as $row){
                if(in_array($row->id,$a)){
                    $item=DB::table('student')->whereRaw('id=?',$row->id)->get()->toArray();
                    array_push($list_student,$item);
                }
            }
            
            $count=DB::table('list_class')->whereRaw('class=?',$id)->whereRaw('branch=?',Auth::user()->branch)->count();
            $class=DB::table('class')->whereRaw('id=?',$id)->get()->toArray();
        }
        if(Auth::user()->type==2){
            $class=DB::table('class')->whereRaw('id=?',$id)->whereRaw('teacher=?',Auth::user()->staff)->get()->toArray();
            $list_class=DB::table('list_class')->whereRaw('class=?',$class[0]->id)->get()->toArray();
            $a=[];
            foreach($list_class as $row){
               array_push($a,$row->student);
            }
            $list_student=[];
            $student=DB::table('student')->get()->toArray();
            foreach($student as $row){
                if(in_array($row->id,$a)){
                    $item=DB::table('student')->whereRaw('id=?',$row->id)->get()->toArray();
                    array_push($list_student,$item);
                }
            }
            
            $count=DB::table('list_class')->whereRaw('class=?',$id)->whereRaw('branch=?',Auth::user()->branch)->count();
            // $class=DB::table('class')->whereRaw('id=?',$id)->get()->toArray();
        }
        $teacher=DB::table('staff')->whereRaw('id=?',$class[0]->teacher)->get()->toArray();
        $branch=DB::table('branch')->whereRaw('id=?',$class[0]->branch)->get()->toArray();
        $course=DB::table('course')->whereRaw('id=?',$class[0]->course)->get()->toArray();
        return view('class.detail_class',compact('list_student','today','count','class','teacher','branch','course'))->with('i',(request()->input('page',1)-1)*10);
       
    }
    //select all
    public function select_all(){
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $list_student=DB::table('student')->orderByDesc('id')->paginate(10);
            return view('student.student',compact('list_student','list_branch'))->with('i',(request()->input('page',1)-1)*10);
        }else{
            $list_student=DB::table('student')->whereRaw('branch=?',Auth::user()->branch)->orderByDesc('id')->paginate(10);
            return view('student.student',compact('list_student'))->with('i',(request()->input('page',1)-1)*10);
        }
        
    }
    //select branch
    public function select_branch($id){
        if(Auth::user()->type==0){
            $list_branch=DB::table('branch')->get()->toArray();
            $branch=DB::table('branch')->whereRaw('id=?',$id)->get()->toArray();
            $list_student=DB::table('student')->whereRaw('branch=?',$id)->orderByDesc('id')->paginate(10);
            return view('student.student',compact('list_student','list_branch','branch'))->with('i',(request()->input('page',1)-1)*10);
        }else{
           return redirect('/student');
        }
        
    }
    //search class
    public function search(Request $request){
        if(Auth::user()->type==0){
            $class=DB::table('class')->whereRaw('id=?',$request->class)->get()->toArray();
        }if(Auth::user()->type==1){
            $class=DB::table('class')->whereRaw('id=?',$request->class)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();
            
        }if(Auth::user()->type==2){
            $class=DB::table('class')->whereRaw('id=?',$request->class)->whereRaw('teacher=?',Auth::user()->staff)->get()->toArray();
        }
        $list_class=DB::table('list_class')->whereRaw('class=?',$class[0]->id)->get()->toArray();
        $a=[];
        foreach($list_class as $row){
           array_push($a,$row->student);
        }
        $list_student=[];
        $student=DB::table('student')->where('name','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%')->orWhere('sex','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%')->orWhere('nationality','like','%'.$request->search.'%')->get()->toArray();
        foreach($student as $row){
            if(in_array($row->id,$a)){
                $item=DB::table('student')->whereRaw('id=?',$row->id)->get()->toArray();
                array_push($list_student,$item);
            }
        }
       
        $count=DB::table('list_class')->whereRaw('class=?',$class[0]->id)->count();
        $teacher=DB::table('staff')->whereRaw('id=?',$class[0]->teacher)->get()->toArray();
        $branch=DB::table('branch')->whereRaw('id=?',$class[0]->branch)->get()->toArray();
        $course=DB::table('course')->whereRaw('id=?',$class[0]->course)->get()->toArray();
        return view('class.detail_class',compact('list_student','count','class','teacher','branch','course'));
      
    }
    //detail_student
    public function detail_student($id){
        if(Auth::user()->type==0){
            $student=DB::table('student')->whereRaw('id=?',$id)->get()->toArray();
            $list_class=DB::table('list_class')->whereRaw('student=?',$id)->get()->toArray();

        }else{
            $student=DB::table('student')->whereRaw('branch=?',Auth::user()->branch)->whereRaw('id=?',$id)->get()->toArray();
            $list_class=DB::table('list_class')->whereRaw('student=?',$id)->get()->toArray();
        }
        return view('student.detail_student',compact('student','list_class'));
        
    }
    //update_student
    public function update_student(Request $request){
        DB::statement("UPDATE student SET phone=? WHERE id =?", [$request->phone,$request->id]);
        return back()->with('success','Chỉnh sửa số điện thoại thành công');
    }
    //search all
    public function search_all(Request $request){
        $search=$request->search;  $list_branch=DB::table('branch')->get()->toArray();$branch='';
        if(Auth::user()->type==0){
            $list_student=DB::table('student');
            if(isset($request->branch)){
                $list_student=$list_student->whereRaw('branch=?',$request->branch);
                $branch=DB::table('branch')->whereRaw('id=?',$request->branch)->get()->toArray();
            }

        }else{
            $list_student=DB::table('student')->whereRaw('branch=?',Auth::user()->branch);
        }
        $list_student=$list_student->where(function($query) use ($search)
        { $query->where('name','like','%'.$search.'%')->orWhere('phone','like','%'.$search.'%')->orWhere('sex','like','%'.$search.'%')->orWhere('nationality','like','%'.$search.'%');})->paginate(10);
        $list_student->appends(['search'=>$search]);
        return view('student.student',compact('list_branch','branch'))->with('list_student', $list_student);
    }
    //insert student 
    public function insert_student($id){
        if(Auth::user()->type==0){
            $class=DB::table('class')->whereRaw('id=?',$id)->get()->toArray();
            $list_student=DB::table('student')->whereRaw('branch=?',$class[0]->branch)->paginate(10);
        }else{
            $class=DB::table('class')->whereRaw('id=?',$id)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();
            $list_student=DB::table('student')->whereRaw('branch=?',Auth::user()->branch)->paginate(10);
        }
        return view('student.insert_student',compact('class'))->with('list_student',$list_student);
    }
  
    ///search_addstudent
    public function search_addstudent(Request $request){
        $search=$request->search;
        if(Auth::user()->type==0){
            $class=DB::table('class')->whereRaw('id=?',$request->class)->get()->toArray();
            if($request->search==''){
                return redirect('/class/insert_student/class='.''.$request->class);
            }
            $list_student=DB::table('student')->whereRaw('branch=?',$class[0]->branch);
            $list_student=$list_student->where('name','like','%'.$request->search.'%')->orWhere('sex','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%')->orWhere('nationality','like','%'.$request->search.'%')->paginate(4);
        }
        else{
            $class=DB::table('class')->whereRaw('id=?',$request->class)->whereRaw('branch=?',Auth::user()->branch)->get()->toArray();
            $student=DB::table('student')->whereRaw('branch=?',Auth::user()->branch);
            $list_student=$student->where(function($query) use ($search)
            { $query->where('name','like','%'.$search.'%')->orWhere('phone','like','%'.$search.'%')->orWhere('sex','like','%'.$search.'%')->orWhere('nationality','like','%'.$search.'%');})->paginate(10);
            $student=DB::table('student')->where('branch=?',Auth::user()->branch);
        }
        $list_student->appends(['search'=>$search,'class'=>$request->class]);
        return view('student.insert_student',compact('class'))->with('list_student',$list_student);
    }
    //add_studen_class
    public function add_student(Request $request){
        $list_class=DB::table('list_class')->whereRaw('class=?',$request->class)->whereRaw('student=?',$request->student)->get()->toArray();
        if(empty($list_class)){
            DB::insert("INSERT INTO list_class (class,student,branch) VALUES (:class,:student,:branch)",[
                ":class"=>$request->class,
                ":student"=>$request->student,
                ":branch"=>$request->branch,
            ]);
            return back()->with('success','Thêm học viên thành công');
        }else{
            return back()->with('error','Học viên đã tham gia lớp học');
        }
    }

      //student Branch save
    public function save_studentBranch(Request $request){
        DB::insert("INSERT INTO student (name,nationality,phone,date_of_birth,sex,branch) Values (:name,:natinonality,:phone,:date_of_birth,:sex,:branch)",[
            ":name"=>$request->name,
            ":natinonality"=>$request->natinonality,
            ":phone"=>$request->phone,
            ":date_of_birth"=>$request->date_of_birth,
            ":sex"=>$request->sex,
            ":branch"=>$request->branch,
        ]);
        return back()->with('success','Thêm học viên thành công');
    }
      //Export course
    public function export_student(Request $request){
        return Excel::download(new StudentExport, 'List_Student.xlsx');
    }
    public function import_student(Request $request){
        $path=$request->file('file')->getRealPath();
        Excel::import(new \App\Imports\StudentImport,$path);
        return back()->with('success',"Tải file thành công");   
    }
    //delete student
    public function delete_student(Request $request){
        DB::statement("DELETE from student where id=?",[$request->id]);
        DB::statement("DELETE from list_class where student=?",[$request->id]);
        return redirect('/student');
    }
}
