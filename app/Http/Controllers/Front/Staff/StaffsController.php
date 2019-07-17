<?php

namespace App\Http\Controllers\Front\Staff;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\CollegeTb;
use App\Models\StudentTb;
use App\Models\ExamCodeTb;
use App\Models\RollNoTb;
use App\Models\RollNoComDet;
use App\Models\SubjectTb;
use App\StaffTb;
use Auth;
use DB;
use Session;


class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departmentId = Auth('specialuser')->user()->department_id;

        $staffusers = DB::table('staff_tbs')
                        ->join('special_user_tbs', 'special_user_tbs.id', '=', 'staff_tbs.user_id')
                        ->select('staff_tbs.*','special_user_tbs.id as userId','special_user_tbs.username as addedby')
                        ->orderBy('created_at','DESC')
                        ->where('staff_tbs.department_id' , '=', $departmentId)
                        ->paginate(10)->onEachSide(5);

        return view('front.colleges.create')->with('staffusers',$staffusers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->specilauserId;
        $deparment_id = $request->departmentId;
        $username     = strtolower($request->username);
        $password     = $request->username . "@123";
        $create = StaffTb::create([
            'user_id' => $user_id,
            'department_id' => $deparment_id,
            'username' => $username,
            'password' => bcrypt($password),
        ]);

        if ($create) {
           $arr = array(['Good' => true,'message' => 'College  has been created successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }

    }

    public function clerkLogin()
    {
        return view('front.clerks.login');
    }


    public function clerkAuth(Request $request)
    {
     $this->validate($request, [
        'username'=>'required',
        'password'=>'required'
    ]);
     $username = $request->username;
     $password = $request->password;
     $remember = $request->remember;


     if(Auth::guard('clerk')->attempt(['username'=> $username, 'password'=> $password,'status' => 1], $remember))
        {
            $clerk_id      =  Auth::guard('clerk')->user()->id;
            $user_id       =  Auth::guard('clerk')->user()->user_id;
            $department_id =  Auth::guard('clerk')->user()->department_id;
            $username      =  Auth::guard('clerk')->user()->username;


            $clerks = DB::table('staff_tbs')
                            ->where('id', '=',$clerk_id)
                            ->where('user_id', '=',$user_id)
                            ->where('department_id', '=',$department_id)
                            ->where('username', '=',$username)
                            ->get();                
        
            foreach ($clerks as $clerk) {
               $clerk_id           = $clerk->id;
               $user_id            = $clerk->user_id;
               $department_id      = $clerk->department_id;
               $username           = $clerk->username;
               $password_change_at = $clerk->password_change_at;

               if ($password_change_at === null) {
 
            
                return view('front.clerks.firsLogin')->with(['clerk_id' => $clerk_id,'user_id' => $user_id,'department_id' => $department_id,'username' => $username]);

               }
               else{
                   return redirect()->route('cdashboard');
               }
            }   

         
        }  else {
       
        Session::flash('warning' , 'Invalid Username or Password or your account is inactive');
        return redirect()->back();
        //return redirect()->back()->with('warning', 'Invalid Username or Password');
        }
    }

    public function clerkFirstProcess(Request $request){
        $clerk_id      = $request->clerk_id;
        $user_id       = $request->user_id;
        $department_id = $request->department_id;
        $username      = $request->username;
        $cpassword     = $request->cpassword;
        $npassword     = $request->npassword;
        $ncpassword    = $request->ncpassword;
        $remember      = $request->flremember;

        $clerk = StaffTb::find($clerk_id);
        $oldPass = $clerk->password;

        if (Hash::check($request->cpassword, $clerk->password)) { 
           $clerk->fill([
            'password' => Hash::make($request->npassword),
            'password_change_at'=>1,
            ])->save();

           Session::flash('success', 'Your password has been changed successfully.Please Login with new password.');
            return redirect()->route('clerk.login');

        } else {
            Session::flash('warning', 'Current Password does not match');
            return view('front.clerks.firsLogin')->with(['clerk_id' => $clerk_id,'user_id' => $user_id,'department_id' => $department_id,'username' => $username]);
        } 

    }

    public function clerkFirstLogin(){

         return view('front.clerks.firsLogin');
    }

    public function logout()
    {
        Auth::guard('clerk')->logout();

        return redirect()->route('clerk.logout'); 
    }

     public function home(){

           $clerk_id = Auth('clerk')->user()->id;
           $clerk_department = Auth('clerk')->user()->department_id;
           $status = Auth('clerk')->user()->status;

           $colleges = DB::table('staff_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'staff_tbs.department_id')
                        ->select('staff_tbs.*','college_tbs.id as collegeId','college_tbs.name as collegeName')
                        ->orderBy('created_at','DESC')
                        ->where('staff_tbs.department_id' , '=', $clerk_department)
                        ->where('staff_tbs.id' , '=', $clerk_id)
                        ->where('staff_tbs.status' , '=', 1)
                        ->get();
                        
           $degrees = DB::table('degree_tbs')
                        ->join('degrees_in_college_tbs', 'degrees_in_college_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->join('student_tbs','student_tbs.degree_id','=','degree_tbs.DegCode')
                        ->select('degree_tbs.*','degrees_in_college_tbs.degree_id','degrees_in_college_tbs.college_id','student_tbs.degree_id','student_tbs.is_active',DB::raw("COUNT(student_tbs.student_id) as degCount"),DB::raw('SUM(student_tbs.is_active) as activeCount, COUNT(student_tbs.is_active = "1") as active'))
                        ->distinct('degrees_in_college_tbs.college_id')
                       ->where(['degrees_in_college_tbs.college_id'=>$clerk_department,'student_tbs.department_id'=>$clerk_department])
                        ->groupBy('student_tbs.degree_id')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
       

            return view('front.cdashboard')->with(['colleges'=>$colleges,'degrees'=>$degrees]);


          }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function staffuserinactive(Request $request,$id)
    {
       
       $user_id = Auth('specialuser')->user()->id;
 

       $inactive = StaffTb::where('user_id', $user_id)->findOrFail($id);
       $inactive->status = 1;
       $result = $inactive->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }


     public function staffuseractive(Request $request,$id)
    {
 
       $user_id = Auth('specialuser')->user()->id; 
       $active = StaffTb::where('user_id', $user_id)->findOrFail($id);
       $active->status = 0;
       $result = $active->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }


    // Students Degree List


    public function degreesStudents($degree,$department){


        $clerk_id = Auth('clerk')->user()->id;
        $clerk_department = Auth('clerk')->user()->department_id;
        $status = Auth('clerk')->user()->status;

           $colleges = DB::table('staff_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'staff_tbs.department_id')
                        ->select('staff_tbs.*','college_tbs.id as collegeId','college_tbs.name as collegeName')
                        ->orderBy('created_at','DESC')
                        ->where('staff_tbs.department_id' , '=', $clerk_department)
                        ->where('staff_tbs.id' , '=', $clerk_id)
                        ->where('staff_tbs.status' , '=', 1)
                        ->get();
        
        $students  =  StudentTb::select('student_tbs.*')
                                ->where(['degree_id'=>$degree,'department_id'=>$department])
                                ->paginate(10)->onEachSide(5);
        return view('front.clerks.student-list')->with(['students'=>$students,'colleges'=>$colleges]);                        

    }

    public function studentinactive(Request $request)

    {
        $clerk_department = Auth('clerk')->user()->department_id;

        
        $stdId =  $request->stdId;
        $stdReg =  $request->stdReg;
        $stdDeg =  $request->stdDeg;

        //dd($stdDeg);

        $subjects  = SubjectTb::where('degree_id',$stdDeg)->where('semester_id',1)->get();

    
        $examcode =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode = $examcode[0];

        $inactive = StudentTb::where('student_id', $stdId)->first();

        $inactive->is_active = 1;

        $result = $inactive->save();

        $rollno = 101;
        $rollnos;
        $checkRollno = RollNoTb::select('rollno')
                                ->where('examcode', $examcode)
                                ->orderBy('rollno','DESC')
                                ->first();
        if ($checkRollno == "" ||  $checkRollno == null) {
            $rollnos = RollNoTb::create([
                'regno'    => $stdReg,
                'rollno'   => $rollno,
                'examcode' => $examcode,
                'part'     => 1,
                'ccode'    => $clerk_department,
                'colcode'  => $clerk_department,

            ]);

            foreach ($subjects as $subject) {
                $subcode  = $subject->code;
                
                $detrollnos  = RollNoComDet::create([
                'rollno'     => $rollno,
                'regno'      => $stdReg,
                'examcode'   => $examcode,
                'subcode'    => $subcode,
                'FicRollNo'  => $subcode
              ]);
            }
            
            if ($rollnos) {
                $arr = array(['Good' => true,'message' => 'Student status has been changed successfully.'], 200);
                echo json_encode($arr);
            }
            
        }
         else{
            $rollno = ($checkRollno->rollno)+1;
            $rollnos = RollNoTb::create([
                'regno'    => $stdReg,
                'rollno'   => $rollno,
                'examcode' => $examcode,
                'part'     => 1,
                'ccode'    => $clerk_department,
                'colcode'  => $clerk_department,

            ]);
            foreach ($subjects as $subject) {
                $subcode  = $subject->code;
                
                $detrollnos  = RollNoComDet::create([
                'rollno'     => $rollno,
                'regno'      => $stdReg,
                'examcode'   => $examcode,
                'subcode'    => $subcode,
                'FicRollNo'  => $subcode
              ]);
            }
          
            if ($rollnos) {
                $arr = array(['Good' => true,'message' => 'Student status has been changed successfully.'], 200);
                echo json_encode($arr);
            }
         }  
    }

    public function studentactive(Request $request)

    {

        $stdId      =  $request->hiddenStudentActive;
        $stdReg     =  $request->hiddenRegnoActive;
        
        $delete     = RollNoTb::where('regno',$stdReg)->get();
        $rollno     = $delete[0]->rollno;

        $examcode   =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode   = $examcode[0];

        $collection = RollNoComDet::where(['rollno'=> $rollno,'examcode'=>$examcode])->get(['roll_no_com_det_id']);
        
        $save       = RollNoComDet::destroy($collection->toArray());

        $inactive   = StudentTb::where('student_id', $stdId)->first();

        $inactive->is_active = 0;

        $result     = $inactive->save();

        $delete     = RollNoTb::where('regno',$stdReg)->delete();

        if ($result) {
        $arr = array(['Good' => true,'message' => 'Student status has been changed successfully.'], 200);
        echo json_encode($arr);
        }
        else{
        return redirect()->back();
        }
    }
    
}
