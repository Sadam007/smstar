<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\CollegeTb;
use App\Models\RollNoComDet;
use App\TeacherTb;
use App\Models\ExamCodeTb;
use DB;
use Session;
use Auth;


class TeachersController extends Controller
{
    
    /*
     * Teacher Sign up.
     */

    public function create()
    {

        $colleges =  CollegeTb::orderBy('id', 'ASC')->get();
        return view('front.teachers.create')->with('colleges' , $colleges);
    }

    /*
     * Teacher Sign up Process.
     */

    public function registerTeachers(Request $request)
    {

      $this->validate($request, [
       'department' => 'required',
       'fullname'   => 'required',
       'mobile'     => 'required|unique:teacher_tbs',
       'password'   => 'required|min:8'
      ]); 

      TeacherTb::create([
          'department_id'=> $request->department,
          'name'         => $request->fullname,
          'mobile'       => $request->mobile,
          'password'     => bcrypt($request->password),
          'is_active'    => 0,
      ]);

      Session::flash('success', 'Your account has been created');
      return redirect()->back();

    }

    /*
     * Teacher Sign In.
     */

    public function TeacherAuth(Request $request)
    {
      $this->validate($request, [
          'lmobile'=>'required',
          'lpassword'=>'required'
      ]);    

     $mobile   = $request->lmobile;
     $password = $request->lpassword;
     $remember = $request->remember;

     if(Auth::guard('teacher')->attempt(['mobile'=> $mobile, 'password'=> $password,'is_active' => 1], $remember)){
       return redirect()->route('tdashboard');
      } else {
          Session::flash('warning' , 'Invalid Username or Password or account status is inactive');
        return redirect()->back();
      }
    }

    /*
     * Teacher Dashboard.
     */

    public function home()
    {
      $teachId   = Auth('teacher')->user()->id;
      $teachDept = Auth('teacher')->user()->department_id;
      $status    = Auth('teacher')->user()->is_active;
    
      $subjects  =  DB::table('subject_tbs')
                       ->join('teacher_subject_assgnment_tbs','teacher_subject_assgnment_tbs.subject_code','=','subject_tbs.code')
                       ->join('degree_tbs','degree_tbs.DegCode','=','subject_tbs.degree_id')
                       ->select('subject_tbs.*','teacher_subject_assgnment_tbs.teacher_id','teacher_subject_assgnment_tbs.subject_code','teacher_subject_assgnment_tbs.department_id','teacher_subject_assgnment_tbs.examcode','degree_tbs.DegCode','degree_tbs.Det1')
                       ->where('teacher_subject_assgnment_tbs.teacher_id', $teachId)
                       ->distinct('subject_tbs.subject_code')
                       ->paginate(10)->onEachSide(5);
  
      return view('front.tdashboard')->with(['subjects'=>$subjects]);
    }

    /*
     * Returning 40 % Marks.
     */

    public function subjectforty($subject,$code)
    {

      $teachId    =  Auth('teacher')->user()->id;
      $teachDept  =  Auth('teacher')->user()->department_id;
      $status     =  Auth('teacher')->user()->is_active;

      $examcode   =  ExamCodeTb::where('is_active',1)->pluck('examcode');
      $examcode   =  $examcode[0];

      $results40  =  DB::table('roll_no_com_dets')
                        ->join('subject_tbs','subject_tbs.code','=','roll_no_com_dets.subcode')
                        ->join('roll_no_tbs','roll_no_tbs.rollno','=','roll_no_com_dets.rollno')
                        ->join('student_tbs','student_tbs.regno','=','roll_no_tbs.regno')
                        ->select('roll_no_com_dets.*','subject_tbs.subject_id','subject_tbs.code','subject_tbs.Na','subject_tbs.semester_id','roll_no_tbs.rollno','roll_no_tbs.regno','student_tbs.regno','student_tbs.stdName','student_tbs.stdfName')
                        ->where(['roll_no_com_dets.subcode'=> $code])
                        ->get();

      return view('front.teachers.student-40')->with(['results40' => $results40]);                    
 
    }

    /*
     * Processing 40 % Marks.
     */

    public function subjectfortyprocess(Request $request)
    {

      $comId      =  $request->comId;
      $mks40      =  $request->mks40;
      $rollno     =  $request->rollno;
      $examcode   =  $request->examcode;

      $update = RollNoComDet::find($comId);
      $update->obt40 = $mks40;
      $save = $update->save();
      
      if ($save) {
        $arr = array(['Good' => true,'message' => 'Marks entered successfully'], 200);
        echo json_encode($arr);      
      }

    }

    /*
     * Teacher Profile.
     */


    public function teacherProfile(){



      $teacherId  = Auth('teacher')->user()->id;

      $teacher  = TeacherTb::find($teacherId);

      return view('front.teachers.profile')->with('teacher',$teacher);
    }

    /*
     * Teacher Profile Processs.
     */

    public function teacherProfileUpdate(Request $request){

    
        $teacherName         = $request->teacherName;
        $teacherMobile        = $request->teacherMobile;
        $teacherPassword     = $request->teacherPassword;
        $teacherNewPassword  = $request->teacherNewPassword;

        $teacherId  = Auth('teacher')->user()->id;

        $teacher    = TeacherTb::find($teacherId);
        $oldPass   = $teacher->password;

        if (Hash::check($request->teacherPassword, $teacher->password)) { 
           $teacher->fill([

            'password' => Hash::make($request->teacherNewPassword)
            ])->save();

        $arr = array(['Good' => true,'message' => 'Profile Updated Successfully'], 200);
        echo json_encode($arr);

        }
        else{

            $arr = array(['Good' => true,'message' => 'Current Password is not matched'], 200);
                echo json_encode($arr);
        }




        
    }

    /*
     * Teacher Logout.
     */

    public function logout()
    {
      Auth::guard('teacher')->logout();

      return redirect()->route('teacher.create'); 
    }
}
