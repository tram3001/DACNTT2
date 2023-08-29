<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PhpParser\Parser\Tokens;
use Response;


class AuthController extends Controller
{   
    //form login
    public function formlogin(){
        
        return view('login');
    }
    public function login(Request $request)
    {   
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password])) {
                //password_verify($request->name,bcrypt($request->password))
            if(Auth::user()->change_pass==0){
                return redirect('/change_password');
            }
            if(Auth::user()->type!=2){
                return redirect('/branch');
            }if(Auth::user()->type==2){
                return redirect('/calendar/staff/week');
            }
        }
        else{
            return back()->with('error','Sai thông tin đăng nhập');
        }
          
        
    }
   
    public function logout(){
        auth()->logout();
        return redirect('/login');
    }
    public function change_password(){
        if(Auth::check()){
            return view('change_password');
        }return redirect('login');
        
    }
    public function save_password(Request $request){
        if($request->password!=$request->confim_password){
            return back()->with('error','Mật khẩu nhập lại không trùng khớp');
        }else{
            if(password_verify($request->password,Auth::user()->password)){
                return back()->with('error','Mật khẩu mới trùng mật khẩu cũ');
            }else{
                $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/";
                $string = $request->password;
                if(preg_match($regex,$string) and strlen($string)>=8){
                    DB::statement("UPDATE users SET password=?,change_pass=? WHERE name =?", [bcrypt($request->password),1,$request->name]);
                    auth()->logout();
                    return redirect('/login');
                }else{
                    return back()->with('error','Sai định dạng mật khẩu');
                }
                
            }
        }
       
    }
    //reset password
    public function reset_pass(Request $request){
        $count=DB::table('users')->whereRaw('name=?',$request->name)->count();
        if($count!=0){
            DB::statement("UPDATE users SET password=?,change_pass=? WHERE name =?", [bcrypt($request->name),0,$request->name]);
        }else{
            DB::insert("INSERT INTO users (name,password,change_pass,phone,branch,type,staff) VALUES(:name,:password,:change_pass,:phone,:branch,:type,:staff)",[
                ":name"=>$request->name,
                ":password"=>bcrypt($request->name),
                ":change_pass"=>0,
                ":phone"=>'',
                ":branch"=>$request->branch,
                ":type"=>2,
                ":staff"=>$request->staff,
            ]);   
        }
        
        return back()->with('success','Cập nhật thành công');
        
    }
    //reset pass staff
    // public function reset_staff(Request $request){
    //     DB::statement("UPDATE users SET password=?,change_pass=? WHERE staff =?", [bcrypt($request->password),0,$request->branch]);
    //     return Redirect::to('/branch')->with('success','Cập nhật thành công');
        
    // }
  
}
