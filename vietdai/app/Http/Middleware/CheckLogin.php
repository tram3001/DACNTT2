<?php

namespace App\Http\Middleware;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $dt = Carbon::now('Asia/Ho_Chi_Minh');
            $today=$dt->format('Y-m-d');
            $class=DB::table('class')->get()->toArray();
            foreach($class as $item){
                $kt=$item->kt;
                $bd=$item->bd;
                if(strtotime($kt)<strtotime($today) && $item->status==1){
                    DB::statement("UPDATE class set status=? Where id=?",[0,$item->id]);
                }
                if(strtotime($bd)==strtotime($today) && $item->status==2){
                    DB::statement("UPDATE class set status=? Where id=?",[1,$item->id]);
                }
            }
            if(Auth::user()->change_pass==1){
                return $next($request);
            }else{
                return  redirect('change_password');
            }
           
        }
        return redirect('login');
     
        
    }
}
