<?php

namespace App\Http\Middleware;

use App\Models\StudentTb;
use Closure;
use Auth;

class protectStudentLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //dd(Auth::guard('student'));

        $regno    = Auth::guard('student')->user()->regno;
        $password = Auth::guard('student')->user()->password;
        $status   = Auth::guard('student')->user()->is_active;

        $checking = StudentTb::select('regno','password') 
                                ->where(['regno'=> $regno,'password'=>$password])
                                ->first();                      

        $checkregno    = $checking->regno;                        
        $checkpassword = $checking->password;                        

         if($regno !== $checkregno && $password !== $checkpassword)
            {
                return redirect('/student/login');
                
            }
            
        return $next($request);
    }
}
