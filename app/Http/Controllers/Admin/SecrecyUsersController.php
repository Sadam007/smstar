<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\SecrecyTb;
use App\Models\DegreeTb;
use App\Models\SubjectTb;
use App\Models\ExamCodeTb;
use App\Models\TeacherExamCenterAssignmentTb;
use App\TeacherTb;
use Auth;
use DB;
use Session;

class SecrecyUsersController extends Controller
{
    

    // public function __construct()
    //         {
    //             $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    //         }

    public function create()
    {
         $secrecyusers = DB::table('secrecy_tbs')
                        ->join('users', 'users.id', '=', 'secrecy_tbs.user_id')
                        ->select('secrecy_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
        return view('backend.secrecyusers.create')->with(['secrecyusers'=>$secrecyusers]);            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id       = Auth::user()->id;
        $username     = strtolower($request->username);
        $password     = $request->username;
        $create = SecrecyTb::create([
            'user_id' => $user_id,
            'username' => $username,
            'password' => bcrypt($password),
        ]);

        if ($create) {
           $arr = array(['Good' => true,'message' => 'Secrecy User has been created successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }

    public function loginSecrecyUser()
    {
        return view('front.secrecyusers.login');
    }

    public function secrecyUserAuth(Request $request)
    {
 
        $this->validate($request, [
            'username'=>'required',
            'password'=>'required'
        ]);
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;

        if(Auth::guard('secrecyuser')->attempt(['username'=> $username, 'password'=> $password,'status' => 1], $remember))
        {
        
        Session::flash('success' , 'You are logged in successfully');
         return redirect()->route('secdashboard');
        }  else {
       
        Session::flash('warning' , 'Invalid Username or Password or your account is inactive');
        return redirect()->back();
        //return redirect()->back()->with('warning', 'Invalid Username or Password');
        }
    }

    public function home()
    {
        
        //$degrees = DegreeTb::all();

        $degrees = DegreeTb::select('*')
                            ->groupBy('M_Title')
                            ->orderBy('M_Title')
                            ->paginate(15)->onEachSide(5); 
    
        return view('front.secdashboard')->with(['degrees'=>$degrees]);

    }

    public function logout()
    {
        Auth::guard('secrecyuser')->logout();
        Session::flash('success' , 'You are logged out successfully');
        return redirect()->route('secrecyuser.login'); 

        // $id   = Auth('secrecyuser')->user()->sec_user_id;
        // $user = Auth::guard('secrecyuser');
 
        // $userToLogout = SecrecyTb::find($id);
        //     Auth::setUser($userToLogout);

        // Auth::logout();
    }
    
    public function userinactive(Request $request,$id)
    {
       
       $user_id = Auth::user()->id;

       $inactive = SecrecyTb::where('user_id', $user_id)->findOrFail($id);
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
    public function useractive(Request $request,$id)
    {
     
       $user_id = Auth::user()->id;
       $active = SecrecyTb::where('user_id', $user_id)->findOrFail($id);
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


    public function subjectsList($subject){

        $subjects = SubjectTb::where(['degree_id'=>$subject,'is_active'=>1])
                                ->orderBy('semester_id', 'ASC')
                                ->paginate(15)->onEachSide(5);                      
        if ($subjects) {
            
            return view('front.secrecyusers.subject-list')->with(['subjects'=>$subjects]);
        }
        else{
            Session::flash('error','No subject found in this degree.');
            return redirect()->back();
        }
    }

    public function examcenters($code){

        $examcode =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode = $examcode[0];

        $centers  = DB::table('roll_no_com_dets')
                        ->join('roll_no_tbs','roll_no_tbs.rollno','=','roll_no_com_dets.rollno')
                        ->join('centre_code_tbs','centre_code_tbs.ccode','roll_no_tbs.ccode')
                        ->select('roll_no_com_dets.*','roll_no_tbs.rollno','roll_no_tbs.examcode','roll_no_tbs.part','roll_no_tbs.ccode','roll_no_tbs.colcode','centre_code_tbs.ccode','centre_code_tbs.examcode','centre_code_tbs.name_of_centre',DB::raw("COUNT(roll_no_com_dets.roll_no_com_det_id) as stdCount"))
                        ->where(['roll_no_com_dets.subcode'=>$code,'roll_no_tbs.examcode'=>$examcode,'centre_code_tbs.examcode'=>$examcode])
                        ->distinct('roll_no_tbs.ccode')
                        ->paginate(15)->onEachSide(5);


    //DB::raw('SUM(roll_no_com_dets.is_active) as activeCount, COUNT(student_tbs.is_active = "1") as active')

       // $teachers = TeacherTb::orderBy('id')->get(); 
       //dd($centers);
        $teachers = DB::table('teacher_tbs')
                        ->join('college_tbs','college_tbs.college_id','=','teacher_tbs.department_id')
                        ->select('teacher_tbs.*','college_tbs.college_id','college_tbs.address')
                        ->orderBy('teacher_tbs.id')
                        ->get();
        //dd($teachers);                

         $assignments  = DB::table('teacher_exam_center_assignment_tbs')
                        ->join('teacher_tbs','teacher_tbs.id','=','teacher_exam_center_assignment_tbs.examiner_id')
                        ->join('college_tbs','college_tbs.college_id','=','teacher_tbs.department_id')
                        ->select('teacher_exam_center_assignment_tbs.examcode','teacher_exam_center_assignment_tbs.subcode','teacher_exam_center_assignment_tbs.ccode','teacher_exam_center_assignment_tbs.examiner_id','teacher_exam_center_assignment_tbs.sec_user_id','teacher_tbs.*','college_tbs.college_id','college_tbs.address')

                        ->distinct('teacher_tbs.name')
                        ->groupBy('teacher_exam_center_assignment_tbs.subcode')
                        ->get();
                    
        return view('front.secrecyusers.examcenters')->with(['centers'=>$centers,'assignments'=>$assignments,'teachers'=>$teachers]);
    }

    public function teacherExamcenterAssigment(Request $request)
    {
        //dd($request->all());


        $secrecyuserId   = Auth('secrecyuser')->user()->sec_user_id;
        //$degAdminDept = Auth('secrecyuser')->user()->department_id;


        $teachId      =  $request->teachId;
        $centercode   =  $request->centercode;
        $subcode      =  $request->subcode;
        
        $examcode     =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode     =  $examcode[0];

        $checking     = TeacherExamCenterAssignmentTb::select('teach_center_id')
                                ->where('ccode'  , $centercode)
                                ->where('subcode'  , $subcode)
                                ->orderBy('teach_center_id'   , 'DESC')
                                ->first();
        //dd($checking);                
       if ($checking == "" || $checking == NULL) 
        {
            $assignment   =  TeacherExamCenterAssignmentTb::create([
                            'examcode'      => $examcode,
                            'subcode'    => $subcode,
                            'ccode'         => $centercode,
                            'examiner_id'   => $teachId,
                            'sec_user_id'   => $secrecyuserId,
                            'is_assigned'   => 1,
            ]);

            if ($assignment) {
                $arr = array(['Good' => true,'message' => 'Examcenter has been assigned to the relevant teacher.'], 200);
                echo json_encode($arr);
            }
            exit();
        }
        else{
            
            $findId = $checking->teach_center_id;


            $assignment    = TeacherExamCenterAssignmentTb::find($findId);

            $assignment->examcode     = $examcode;
            $assignment->subcode      = $subcode;
            $assignment->ccode        = $centercode;
            $assignment->examiner_id  = $teachId;
            $assignment->sec_user_id  = $secrecyuserId;
            $assignment->is_assigned  = 1;
            $$assignment = $assignment->save();

            
            if ($assignment) {
                $arr = array(['Good' => true,'message' => 'Examcenter has been assigned to the relevant teacher.'], 200);
                echo json_encode($arr);
            }

        }
    }
}
