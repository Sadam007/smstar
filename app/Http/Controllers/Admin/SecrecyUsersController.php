<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

      $degrees    =  DB::table('student_tbs')
                        ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
                        ->join('roll_no_tbs','roll_no_tbs.regno','=', 'student_tbs.regno')
                        ->select('student_tbs.degree_id','degree_tbs.id','degree_tbs.M_Title','degree_tbs.Det1','degree_tbs.DegCode','roll_no_tbs.rollno','roll_no_tbs.examcode',DB::raw("COUNT(roll_no_tbs.ccode) AS centerDegrees"))
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
          $nestedData['centerDegrees'] = $degree->centerDegrees;

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
    $examcode   =  $request->examcode;

      $subjects = DB::table('subject_tbs')
      ->join('degree_tbs', 'degree_tbs.DegCode', '=', 'subject_tbs.degree_id')
      ->join('roll_no_com_dets','roll_no_com_dets.subcode','=','subject_tbs.code')
      ->select('subject_tbs.*','degree_tbs.DegCode','degree_tbs.degYears','roll_no_com_dets.subcode')
      ->where(['degree_tbs.DegCode'=>$degCode,'roll_no_com_dets.examcode'=>$examcode])
      ->distinct('subject_tbs.Na')
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

          $subjects_count    = DB::select("SELECT COUNT(subcode) AS totalSubjects FROM roll_no_com_dets WHERE subcode = '$subject->code'");

          $totalSubjects  =  $subjects_count[0]->totalSubjects;


          $nestedData['totalSubjects'] = $totalSubjects;



          $assignedCounts    =  DB::select("SELECT COUNT(subcode) AS assigedCounts FROM  teacher_exam_center_assignment_tbs WHERE subcode = '$subject->code' AND is_assigned = 1");

          $assigedCounts    = $assignedCounts[0]->assigedCounts;

          $nestedData['assigedCounts'] =  $assigedCounts;




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

  public function examsStudentsCounts(Request $request)
  {
  		
  		$examcode 	= $request->examcode;   
  		$DegCode 		= $request->DegCode;
  		$subject    = $request->subject;
  		$ccode      = $request->ccode; 
				

			$stdCounts  = DB::select("SELECT DISTINCT COUNT(roll_no_com_dets.rollno) AS stdTotalCount, roll_no_com_dets.rollno, roll_no_com_dets.examcode, roll_no_com_dets.subcode, roll_no_tbs.part, roll_no_tbs.ccode,roll_no_tbs.colcode,dbo_web_part.OneRTwo, roll_no_tbs.regno, exam_code_tbs.session, roll_no_com_dets.FicRollno, dbo_web_part.tp FROM roll_no_tbs INNER JOIN dbo_web_part ON roll_no_tbs.part = dbo_web_part.part INNER JOIN
                         roll_no_com_dets ON roll_no_tbs.rollno = roll_no_com_dets.rollno AND roll_no_tbs.examcode = roll_no_com_dets.examcode INNER JOIN college_tbs ON roll_no_tbs.colcode = college_tbs.college_id INNER JOIN exam_code_tbs ON roll_no_tbs.examcode = exam_code_tbs.examcode INNER JOIN center_codes_tbs ON roll_no_tbs.ccode = center_codes_tbs.ccode AND roll_no_tbs.examcode = center_codes_tbs.examcode WHERE roll_no_com_dets.subcode = '$subject' AND roll_no_com_dets.examcode = '$examcode' AND roll_no_tbs.ccode = '$ccode'"); 											
								
  	$data = array();

      if(count($stdCounts) > 0)
      {
        foreach ($stdCounts as $stdcount)
        {

          $nestedData['stdTotalCount']  = $stdcount->stdTotalCount;
          $nestedData['rollno']         = $stdcount->rollno;
          $nestedData['examcode']       = $stdcount->examcode;
          $nestedData['subcode']        = $stdcount->subcode;
          $nestedData['part']           = $stdcount->part;
          $nestedData['ccode']          = $stdcount->ccode;
          $nestedData['colcode']        = $stdcount->colcode;
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


  public function secrecyProfile()
  {
      $secUserId  = Auth('secrecyuser')->user()->sec_user_id;

      $secuser    = SecrecyTb::find($secUserId);

      return view('front.secrecyusers.profile')->with('secuser',$secuser);

  }

  public function secrecyProfileUpdate(Request $request)
  {

        $secuserName         = $request->secuserName;
        $secuserPassword     = $request->secuserPassword;
        $secuserNewPassword  = $request->secuserNewPassword;

        $secUserId  = Auth('secrecyuser')->user()->sec_user_id;

        $secuser    = SecrecyTb::find($secUserId);
        $oldPass   = $secuser->password;

        if (Hash::check($request->secuserPassword, $secuser->password)) { 
           $secuser->fill([

            'password' => Hash::make($request->secuserNewPassword)
            ])->save();

        $arr = array(['Good' => true,'message' => 'Profile Updated Successfully'], 200);
        echo json_encode($arr);

        }
        else{

            $arr = array(['Good' => true,'message' => 'Current Password is not matched'], 200);
                echo json_encode($arr);
        }

  }
}
