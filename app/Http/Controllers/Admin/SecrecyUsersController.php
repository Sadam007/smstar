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
  /* 
   * Secrecy User Registration Form.
   */
  public function create()
  {
    $secrecyusers = DB::table('secrecy_tbs')
    ->join('users', 'users.id', '=', 'secrecy_tbs.user_id')
    ->select('secrecy_tbs.*','users.id as userId','users.name as addedby')
    ->orderBy('created_at','DESC')
    ->paginate(10)->onEachSide(5);
    return view('backend.secrecyusers.create')->with(['secrecyusers'=>$secrecyusers]);            
  }

  /* 
   * Secrecy User Registration Form Process.
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

    if($create)
    {
     $arr = array(['Good' => true,'message' => 'Secrecy User has been created successfully.'], 200);
     echo json_encode($arr);
   }
   else{
    return redirect()->back();
  }
}

  /* 
   * Secrecy User Login Form.
   */

  public function loginSecrecyUser()
  {
    return view('front.secrecyusers.login');
  }

  /* 
   * Secrecy User Login Form Process.
   */

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
      }
      else
      {
        Session::flash('warning' , 'Invalid Username or Password or your account is inactive');
        return redirect()->back(); 
      }
    }

  /* 
   * Secrecy User Dashboard.
   */

  public function home()
  {

    $degrees = DegreeTb::select('*')
    ->groupBy('M_Title')
    ->orderBy('M_Title')
    ->paginate(15)->onEachSide(5); 
    return view('front.secdashboard')->with(['degrees'=>$degrees]);
  }

  /* 
   * Secrecy User Logout.
   */

  public function logout()
  {

    Auth::guard('secrecyuser')->logout();
    Session::flash('success' , 'You are logged out successfully');
    return redirect()->route('secrecyuser.login'); 
  }

  /* 
   * Secrecy User Inactive.
   */
  
  public function userinactive(Request $request,$id)
  {
    
    $user_id = Auth::user()->id;
    $inactive = SecrecyTb::where('user_id', $user_id)->findOrFail($id);
    $inactive->status = 1;
    $result = $inactive->save();

    if($result)
    {
      $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
      echo json_encode($arr);
    }
    else
    {
      return redirect()->back();
    }
  }

  /* 
   * Secrecy User Active.
   */

  public function useractive(Request $request,$id)
  {

    $user_id = Auth::user()->id;
    $active = SecrecyTb::where('user_id', $user_id)->findOrFail($id);
    $active->status = 0;
    $result = $active->save();

    if($result)
    {
      $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
      echo json_encode($arr);
    }
    else
    {
      return redirect()->back();
    }
  }

  /* 
   * Secrecy User Subjects List.
   */


  public function subjectsList($subject)
  {

    $subjects = SubjectTb::where(['degree_id'=>$subject,'is_active'=>1])
    ->orderBy('semester_id', 'ASC')
    ->paginate(15)->onEachSide(5);                      
    
    if($subjects)
    {
      return view('front.secrecyusers.subject-list')->with(['subjects'=>$subjects]);
    }
    else
    {
      Session::flash('error','No subject found in this degree.');
      return redirect()->back();
    }
  }

  /* 
   * Secrecy User Exam Centers.
   */

  public function examcenters($code)
  {

    $examcode =  ExamCodeTb::where('is_active',1)->pluck('examcode');
    $examcode = $examcode[0];

    $centers  = DB::table('roll_no_com_dets')
    ->join('roll_no_tbs','roll_no_tbs.rollno','=','roll_no_com_dets.rollno')
    ->join('centre_code_tbs','centre_code_tbs.ccode','roll_no_tbs.ccode')
    ->select('roll_no_com_dets.*','roll_no_tbs.rollno','roll_no_tbs.examcode','roll_no_tbs.part','roll_no_tbs.ccode','roll_no_tbs.colcode','centre_code_tbs.ccode','centre_code_tbs.examcode','centre_code_tbs.name_of_centre',DB::raw("COUNT(roll_no_com_dets.roll_no_com_det_id) as stdCount"))
    ->where(['roll_no_com_dets.subcode'=>$code,'roll_no_tbs.examcode'=>$examcode,'centre_code_tbs.examcode'=>$examcode])
    ->distinct('roll_no_tbs.ccode')
    ->paginate(15)->onEachSide(5);


    $teachers = DB::table('teacher_tbs')
    ->join('college_tbs','college_tbs.college_id','=','teacher_tbs.department_id')
    ->select('teacher_tbs.*','college_tbs.college_id','college_tbs.address')
    ->orderBy('teacher_tbs.id')
    ->get();              

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
    $secrecyuserId   = Auth('secrecyuser')->user()->sec_user_id;
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
    
    if($checking == "" || $checking == NULL) 
    {
      $assignment   =  TeacherExamCenterAssignmentTb::create([
        'examcode'      => $examcode,
        'subcode'    => $subcode,
        'ccode'         => $centercode,
        'examiner_id'   => $teachId,
        'sec_user_id'   => $secrecyuserId,
        'is_assigned'   => 1,
      ]);

      if ($assignment)
      {
        $arr = array(['Good' => true,'message' => 'Examcenter has been assigned to the relevant teacher.'], 200);
        echo json_encode($arr);
      }
      exit();
    }
    else
    {
      $findId = $checking->teach_center_id;
      $assignment    = TeacherExamCenterAssignmentTb::find($findId);
      $assignment->examcode     = $examcode;
      $assignment->subcode      = $subcode;
      $assignment->ccode        = $centercode;
      $assignment->examiner_id  = $teachId;
      $assignment->sec_user_id  = $secrecyuserId;
      $assignment->is_assigned  = 1;
      $$assignment = $assignment->save();

      if ($assignment)
      {
        $arr = array(['Good' => true,'message' => 'Examcenter has been assigned to the relevant teacher.'], 200);
        echo json_encode($arr);
      }
    }
  }


  public function LatestExams(){

    $exams     =  ExamCodeTb::orderBy('exam_id','desc')->take(3)->get();

    return view('front.secrecyusers.exams')->with(['exams'=>$exams]);

  }

  public function examsdegrees(Request $request){

      $examcode   =  $request->examcode;

      $degrees = DB::table('student_tbs')
      ->join('roll_no_tbs', 'roll_no_tbs.regno', '=', 'student_tbs.regno')
      ->join('degree_tbs','degree_tbs.DegCode','student_tbs.degree_id')
      ->select('roll_no_tbs.rollno','roll_no_tbs.examcode','student_tbs.degree_id','degree_tbs.id','degree_tbs.M_Title','degree_tbs.Det1','degree_tbs.DegCode')
      ->where('roll_no_tbs.examcode','=',$examcode)
      ->distinct('degree_tbs.Det1')
      ->groupBy('degree_tbs.DegCode')
      ->orderBy('degree_tbs.Det1','ASC')
      ->get(); 

      $data = array();  

      if(count($degrees) > 0)
      {
        foreach ($degrees as $degree)
        {
          $nestedData['id']      = $degree->id;
          $nestedData['M_Title'] = $degree->M_Title;
          $nestedData['Det1']    = $degree->Det1;
          $nestedData['DegCode'] = $degree->DegCode;
          
          $data[] = $nestedData;
        }

        $json_data = array(
          "Good" => true,
          "Message" => 'Data Found Successfully',
          "data" => $data
        );
        echo json_encode($json_data); 
      }

      else
      {
        $json_data = array(
          "Good" => false,
          "Message" => 'No degree found in this examcode',
        );
        echo json_encode($json_data); 
      }      
  }

  public function examsdegreesSubjects(Request $request){
    
    $degCode   =  $request->degCode;

      $subjects = DB::table('subject_tbs')
      ->join('degree_tbs', 'degree_tbs.DegCode', '=', 'subject_tbs.degree_id')
      ->select('subject_tbs.*','degree_tbs.DegCode','degree_tbs.DegCode','degree_tbs.degYears')
      ->where('degree_tbs.DegCode','=',$degCode)
      ->orderBy('subject_tbs.Na','ASC')
      ->get(); 

      $data = array();  

      if(count($subjects) > 0)
      {
        foreach ($subjects as $subject)
        {
          $nestedData['subject_id']      = $subject->subject_id;
          $nestedData['code'] = $subject->code;
          $nestedData['Na'] = $subject->Na;
          $nestedData['degYears']    = $subject->degYears;
          $nestedData['DegCode'] = $subject->DegCode;
          $data[] = $nestedData;
        }

        $json_data = array(
          "Good" => true,
          "Message" => 'Data Found Successfully',
          "data" => $data
        );
        echo json_encode($json_data); 
      }

      else
      {
        $json_data = array(
          "Good" => false,
          "Message" => 'No subject found in this degree',
        );
        echo json_encode($json_data); 
      }      
  }

  public function examsdegreesSubjectColleges(Request $request){

    $examcode   = $request->examcode;
    $degCode    = $request->degCode;
    $subject    = $request->subject;

    /*$colleges = DB::table('roll_no_com_dets')
      ->join('roll_no_tbs', 'roll_no_tbs.rollno', '=', 'roll_no_com_dets.rollno')
      ->join('student_tbs','student_tbs.regno','=','roll_no_tbs.regno')
      ->join('college_tbs','college_tbs.college_id','student_tbs.department_id')
      ->select('college_tbs.name','college_tbs.college_id')
      ->distinct('college_tbs.name')
      ->where(['roll_no_com_dets.subcode'=>$subject,'roll_no_com_dets.examcode'=>$examcode])
      ->orderBy('college_tbs.name','ASC')
      ->get(); */


      $colleges = DB::table('roll_no_com_dets')
      ->join('roll_no_tbs', 'roll_no_tbs.rollno', '=', 'roll_no_com_dets.rollno')
      ->join('student_tbs','student_tbs.regno','=','roll_no_tbs.regno')
      ->leftjoin('center_codes_tbs','center_codes_tbs.examcode','roll_no_tbs.examcode')
      ->select('center_codes_tbs.cname','center_codes_tbs.ccode')
      ->distinct('center_codes_tbs.cname')
      ->where(['roll_no_com_dets.subcode'=>$subject,'roll_no_com_dets.examcode'=>$examcode,'student_tbs.degree_id'=>$degCode])
      ->orderBy('center_codes_tbs.cname','ASC')
      ->get(); 


      $data = array();

      if(count($colleges) > 0)
      {
        foreach ($colleges as $college)
        {
          $nestedData['ccode']      = $college->ccode;
          $nestedData['cname'] = $college->cname;
          $data[] = $nestedData;
        }

        $json_data = array(
          "Good" => true,
          "Message" => 'Data Found Successfully',
          "data" => $data
        );
        echo json_encode($json_data); 
      }

      else
      {
        $json_data = array(
          "Good" => false,
          "Message" => 'Exam Center not found',
        );
        echo json_encode($json_data); 
      }

  }

  public function examsdegreesSubjectCollegesAssignment(Request $request)

  {
    $examcode  = $request->examcode;
    $degCode   = $request->degCode;
    $subject   = $request->subject;
    $ccode     = $request->ccode;


    $assignments    =  DB::table('roll_no_com_dets')
    ->join('teacher_exam_center_assignment_tbs','teacher_exam_center_assignment_tbs.examcode','=',
      'roll_no_com_dets.examcode')
    ->join('subject_tbs','subject_tbs.code','=','teacher_exam_center_assignment_tbs.subcode')
    ->join('teacher_tbs','teacher_tbs.id','teacher_exam_center_assignment_tbs.examiner_id')
    ->leftjoin('college_tbs','college_tbs.college_id','=','teacher_tbs.department_id')
    ->select('teacher_exam_center_assignment_tbs.examcode','teacher_exam_center_assignment_tbs.subcode','teacher_exam_center_assignment_tbs.ccode','teacher_exam_center_assignment_tbs.examiner_id','teacher_exam_center_assignment_tbs.is_assigned','teacher_tbs.id AS teacher_id','teacher_tbs.name AS teacher_name','college_tbs.name AS college')
    ->distinct('subject_tbs.Na')
    ->where(['teacher_exam_center_assignment_tbs.examcode' => $examcode ,'teacher_exam_center_assignment_tbs.subcode'=>$subject,'teacher_exam_center_assignment_tbs.ccode'=>$ccode])
    ->groupBy('teacher_exam_center_assignment_tbs.subcode')
    ->get();

    $data = array();

      if(count($assignments) > 0)
      {
        foreach ($assignments as $assignment)
        {
          $nestedData['is_assigned']      = $assignment->is_assigned;
          $nestedData['teacher_id']       = $assignment->teacher_id;
          $nestedData['teacher_name']     = $assignment->teacher_name;
          $nestedData['college']     = $assignment->college;
          $data[] = $nestedData;
        }

        $json_data = array(
          "Good" => true,
          "Message" => 'Data Found Successfully',
          "data" => $data
        );
        echo json_encode($json_data); 
      }

      else
      {
        $json_data = array(
          "Good" => false,
          "Message" => 'Subject is not assigned',
        );
        echo json_encode($json_data); 
      }

  }


  public function examsSearchTeacher(Request $request)
  {
    // dd($request->all());

    $searchVal  = $request->searchVal;

    $teachers = DB::table('teacher_tbs')
    ->join('college_tbs','college_tbs.college_id','=','teacher_tbs.department_id')
    ->select('teacher_tbs.id','teacher_tbs.department_id','teacher_tbs.name','teacher_tbs.mobile','college_tbs.college_id','college_tbs.name AS collegeName')
    ->where('teacher_tbs.name','LIKE','%'.$searchVal."%")
    ->orWhere('college_tbs.name','LIKE','%'.$searchVal."%")
    ->get();

    $data = array();

      if(count($teachers) > 0)
      {
        foreach ($teachers as $teacher)
        {

          $nestedData['id']             = $teacher->id;
          $nestedData['department_id']  = $teacher->department_id;
          $nestedData['name']           = $teacher->name;
          $nestedData['mobile']         = $teacher->mobile;
          $nestedData['collegeName']         = $teacher->collegeName;
          $data[] = $nestedData;
          
          $json_data = array(
          "Good" => true,
          "Message" => 'Data Found Successfully',
          "data" => $data
        );
        
      }

       echo json_encode($json_data);
    
    }
    else
      {
        $json_data = array(
          "Good" => false,
          "Message" => 'No result found',
        );
        echo json_encode($json_data); 
      }
  }

  public function examsSearchTeacherAssignment(Request $request)
  {

    $secUserId  = Auth::user()->sec_user_id;
    $examcode   = $request->examcode;
    $subject    = $request->subject;
    $ccode      = $request->ccode;
    $teacherId  = $request->teacherId;

     $checking     = TeacherExamCenterAssignmentTb::select('*')
    ->where(['examcode'=>$examcode,'subcode'=>$subject,'ccode'=>$ccode])
    ->get();        
    
    if(count($checking) == 0) 
    {
     
      $assignment   =  TeacherExamCenterAssignmentTb::create([
        'examcode'      => $examcode,
        'subcode'       => $subject,
        'ccode'         => $ccode,
        'examiner_id'   => $teacherId,
        'sec_user_id'   => $secUserId,
        'is_assigned'   => 1,
      ]);

      if ($assignment)
      {
        $arr = array(['Good' => true,'message' => 'Paper assigned successfully'], 200);
        echo json_encode($arr);
      }

    }
    else{

        $arr = array(['Good' => false,'message' => 'Paper already assigned'], 200);
        echo json_encode($arr);
    }
  }
}
