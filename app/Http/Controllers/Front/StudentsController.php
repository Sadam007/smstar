<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use App\Http\Requests\StudentsStoreRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentTb;
use App\Models\StduentCertificatesTb;
use App\Models\CollegeTb;
use App\Models\SessionTb;
use App\Models\DegreeTb;
use App\Models\DistrictTb;
use App\Models\CertificateTb;
use App\Models\DegreesInCollegeTb;
use App\Models\ExamCodeTb;
use App\Models\RollNoTb;
use DB;
use Session;
use Auth;
use PDF;
class StudentsController extends Controller
{

  /* 
   * Student Registration Form.
   */

  public function create()
  {
    $colleges      =  CollegeTb::orderBy('id', 'ASC')->get();
    $sessions      =  SessionTb::orderBy('id', 'DESC')->where('status',1)->first();
    $degrees       =  DegreeTb::orderBy('id', 'ASC')->get();
    $districts     =  DistrictTb::orderBy('id', 'ASC')->get();
    $certificates  =  CertificateTb::orderBy('id', 'ASC')->get();

    $sessions = SessionTb::where('status', '=', 1)
    ->orderBy('id', 'DESC')
    ->first();

    return view('front.students.std-create')->with(['colleges' => $colleges , 'sessions' => $sessions, 'degrees' => $degrees,'districts' => $districts, 'certificates' => $certificates]);
  }

  /* 
   * Student Registration Form Process.
   */

  public function registerStudents(StudentsStoreRequest $request)
  {

    $validated = $request->validated();
    $stdDepartment   = $request->stdDepartment;

    $stdDegree       = $request->stdDegree;
    $stdName         = $request->stdName;
    $stdfName        = $request->stdfName;
    $stddob          = $request->stddob;
    $stdDomicile     = $request->stdDomicile;
    $stdAddress      = $request->stdAddress;

    $metricSelect    = $request->metricSelect;
    $metricGroup     = $request->metricGroup;
    $metricRollno    = $request->metricRollno;
    $metricYear      = $request->metricYear;
    $metricObtMarks  = $request->metricObtMarks;
    $metricTotMarks  = $request->metricTotMarks;
    $metricInstitue  = $request->metricInstitue;
    $metricBoard     = $request->metricBoard;

    $fscSelect       = $request->fscSelect;
    $fscGroup        = $request->fscGroup;
    $fscRollno       = $request->fscRollno;
    $fscYear         = $request->fscYear;
    $fscObtMarks     = $request->fscObtMarks;
    $fscTotMarks     = $request->fscTotMarks;
    $fscInstitue     = $request->fscInstitue;
    $fscBoard        = $request->fscBoard;

    $bscSelect       = $request->bscSelect;
    $bscGroup        = $request->bscGroup;
    $bscRollno       = $request->bscRollno;
    $bscYear         = $request->bscYear;
    $bscObtMarks     = $request->bscObtMarks;
    $bscTotMarks     = $request->bscTotMarks;
    $bscInstitue     = $request->bscInstitue;
    $bscBoard        = $request->bscBoard;
    $stdEmail        = $request->stdEmail;
    $stdContact      = $request->stdContact;

    $sessions  = DB::table('session_tbs')
    ->join('degree_tbs','degree_tbs.degYears','=','session_tbs.sessYear')
    ->select('session_tbs.id AS sessionId','session_tbs.sessionCode','session_tbs.sessYear','degree_tbs.degYears')
    ->where('degree_tbs.Degcode',$stdDegree)
    ->get();

    $stdSession = $sessions[0]->sessionId;
    $destinationPath = 'uploads/students/';
    $file = $request->file('stdPhoto');
    $featured_new_name = time().$file->getClientOriginalName();
    $file->move($destinationPath,$featured_new_name);
    $stdPhoto = $destinationPath.$featured_new_name;

    $registration = StudentTb::select('regno')
    ->where('degree_id', $stdDegree)
    ->where('department_id', $stdDepartment)
    ->where('session_id', $stdSession)
    ->orderBy('regno','DESC')
    ->first();

    if ($registration == "" ) {

      $DegCode = DegreesInCollegeTb::select('regStart')->where('degree_id', $stdDegree)->first();
      $regStart = $DegCode->regStart;
      $fullSession = $stdSession;
      $shortSession = substr($fullSession, 2,2);
      $regnoo;
      if ($regStart < 10 && $regStart > 0) {
       $regnoo = $shortSession."0000".$regStart;
     }
     else if ($regStart < 100 && $regStart > 9) {
       $regnoo = $shortSession."000".$regStart;
     }
     elseif ($regStart < 1000 && $regStart > 99) {
       $regnoo = $shortSession."00".$regStart;
     }
     elseif ($regStart < 10000 && $regStart > 999) {
       $regnoo = $shortSession."0".$regStart;
     }
     elseif ($regStart < 99999 && $regStart >  9999) {
       $regnoo = $shortSession.$regStart;
     }

     $create = StudentTb::create([
      'regno' => $regnoo,
      'department_id'  => $stdDepartment,
      'session_id'     => $stdSession,
      'degree_id'      => $stdDegree,
      'stdName'        => $stdName,
      'stdfName'       => $stdfName,
      'dob'            => $stddob,
      'domicile'       => $stdDomicile,
      'photo'          => $stdPhoto,
      'address'        => $stdAddress,
      'email'          => $stdEmail,
      'contact'        => $stdContact,
      'password'       => bcrypt("12121212"),
    ]);

     $last_id = $create->student_id;
     $regno = $create->regno;
     $certificates = StduentCertificatesTb::create([
      'regno' => $regnoo, 
      'metric'=> $metricSelect,
      'metricGroup'=>$metricGroup,
      'metricRollNo'=>$metricRollno,
      'metricYear'=>$metricYear,
      'metricObtMarks'=>$metricObtMarks,
      'metricTotMarks'=>$metricTotMarks,
      'metricInstitute'=>$metricInstitue,
      'metricBoard'=>$metricBoard,
      'fsc'=>$fscSelect,
      'fscGroup'=>$fscGroup,
      'fscRollNo'=>$fscRollno,
      'fscYear'=>$fscYear,
      'fscObtMarks'=>$fscObtMarks,
      'fscTotMarks'=>$fscTotMarks,
      'fscInstitute'=>$fscInstitue,
      'fscBoard'=>$fscBoard,
      'bsc'=>$bscSelect,
      'bscGroup'=>$bscGroup,
      'bscRollNo'=>$bscRollno,
      'bscYear'=>$bscYear,
      'bscObtMarks'=>$bscObtMarks,
      'bscTotMarks'=>$bscTotMarks,
      'bscInstitute'=>$bscInstitue,
      'bscBoard'=>$bscBoard,
    ]);
     if ($certificates) {

      $data=   array(
        'name'=>$request->stdName,
        'user_email'=>$request->stdEmail,
        'regno'=>$regno,
        'student_id'=>$last_id,
        'subject'=>"Email Confirmation"
      );
      Mail::send('front.students.email-verifiy', array('data' => $data), function($message) use($data)
      {
        $message->from('sadam.uom7@gmail.com', 'Secrecy UOM.');
        $message->to($data['user_email']);
        $message->subject($data['subject']);
      });

      $arr = array(['Good' => true,'message' => 'Account Registered Scuccessfully.Please check your email for further action.'], 200);
      echo json_encode($arr);
    }

  }   
  else
  {
    $regnoo = ($registration->regno)+1;
    $create = StudentTb::create([
      'regno' => $regnoo,
      'department_id'  => $stdDepartment,
      'session_id'     => $stdSession,
      'degree_id'      => $stdDegree,
      'stdName'        => $stdName,
      'stdfName'       => $stdfName,
      'dob'            => $stddob,
      'domicile'       => $stdDomicile,
      'photo'          => $stdPhoto,
      'address'        => $stdAddress,
      'email'          => $stdEmail,
      'contact'        => $stdContact,
      'password'       => bcrypt("12121212"),
    ]);

    $last_id = $create->id;
    $certificates = StduentCertificatesTb::create([
      'regno' => $regnoo, 
      'metric'=> $metricSelect,
      'metricGroup'=>$metricGroup,
      'metricRollNo'=>$metricRollno,
      'metricYear'=>$metricYear,
      'metricObtMarks'=>$metricObtMarks,
      'metricTotMarks'=>$metricTotMarks,
      'metricInstitute'=>$metricInstitue,
      'metricBoard'=>$metricBoard,
      'fsc'=>$fscSelect,
      'fscGroup'=>$fscGroup,
      'fscRollNo'=>$fscRollno,
      'fscYear'=>$fscYear,
      'fscObtMarks'=>$fscObtMarks,
      'fscTotMarks'=>$fscTotMarks,
      'fscInstitute'=>$fscInstitue,
      'fscBoard'=>$fscBoard,
      'bsc'=>$bscSelect,
      'bscGroup'=>$bscGroup,
      'bscRollNo'=>$bscRollno,
      'bscYear'=>$bscYear,
      'bscObtMarks'=>$bscObtMarks,
      'bscTotMarks'=>$bscTotMarks,
      'bscInstitute'=>$bscInstitue,
      'bscBoard'=>$bscBoard,
    ]);
    if($certificates)
    {

      $data=   array(
        'name'=>$request->stdName,
        'user_email'=>$request->stdEmail,
        'regno'=>$regnoo,
        'student_id'=>$last_id,
        'subject'=>"Email Confirmation"
      );

      Mail::send('front.students.email-verifiy', array('data' => $data), function($message) use($data)
      {
        $message->from('sadam.uom7@gmail.com', 'Secrecy UOM.');
        $message->to($data['user_email']);
        $message->subject($data['subject']);
      });

      $arr = array(['Good' => true,'message' => 'Account Registered Scuccessfully.Please check your email for further action.'], 200);
      echo json_encode($arr);
    }
  }    
}

  /* 
   * Student Login Form.
   */

  public function studentLogin()
  {
    return view('front.students.login');
  }

  /* 
   * Student Login Form Process.
   */

  public function StudentAuth(Request $request)
  {
    $this->validate($request, [
      'regno'=>'required',
      'lpassword'=>'required'
    ]); 

    $regno = $request->regno;
    $password = $request->lpassword;
    $remember = $request->remember;

    if(Auth::guard('student')->attempt(['regno'=> $regno, 'password'=> $password], $remember))
      {
        return redirect()->route('stddashboard');
      } 
      else {
        Session::flash('warning' , 'Invalid Username or Password');
        return redirect()->back();
      }
    }

  /* 
   * Student Dashboard.
   */
  public function home()
  {

    return view('front.stddashboard');
  }

  /* 
   * Student Logout.
   */
  public function logout()
  {
    Auth::guard('student')->logout();

    return redirect()->route('login.student'); 
  }
  
  /* 
   * Check College Degrees.
   */

  public function checkCollegesDegrees(Request $request)
  {
    
    $checkDept = $request->deptValue;
    if ($checkDept)
    {
      $degrees = DB::table('degree_tbs')
      ->join('degrees_in_college_tbs', 'degrees_in_college_tbs.degree_id', '=', 'degree_tbs.DegCode')
      ->select('degree_tbs.*','degrees_in_college_tbs.degree_id','degrees_in_college_tbs.college_id')
      ->where('degrees_in_college_tbs.college_id','=',$checkDept)
      ->orderBy('created_at','DESC')
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
          "Message" => 'No degree found in this college',
        );
        echo json_encode($json_data); 
      }    
    }
    else
    {
      echo "The selected department is not found";
    }    
  }

  /* 
   * View Student Examination Enrollment.
   */

  public function ViewEnrolledExams()
  {
    
    $student_id     =  Auth('student')->user()->student_id;
    $regno          =  Auth('student')->user()->regno;

    $students = DB::table('student_tbs')
    ->join('college_tbs', 'college_tbs.college_id', '=', 'student_tbs.department_id')
    ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
    ->select('student_tbs.*','college_tbs.college_id','college_tbs.name as CollegeName','degree_tbs.M_Title','degree_tbs.Det1')
    ->where(['student_tbs.student_id'=>$student_id,'student_tbs.regno' => $regno])
    ->orderBy('created_at','DESC')
    ->get();                 

    $exams = DB::table('exam_code_tbs')
    ->join('roll_no_tbs', 'roll_no_tbs.examcode', '=', 'exam_code_tbs.examcode')
    ->select('exam_code_tbs.*','roll_no_tbs.examcode','roll_no_tbs.regno','roll_no_tbs.result','roll_no_tbs.rollno')
    ->where(['roll_no_tbs.regno' => $regno])
    ->distinct('roll_no_tbs.examcode')
    ->groupBy('roll_no_tbs.examcode')
    ->orderBy('created_at','DESC')
    ->get();                  
    
    return view('front.students.examenrolled')->with(['students'=>$students,'exams'=>$exams]);

  }

  /* 
   * Student All DateSheets.
   */

  public function ViewStudentDateSheet($examid , $examcode,$exam)
  {
    
    $student_id     =  Auth('student')->user()->student_id;
    $regno          =  Auth('student')->user()->regno;
    $department_id  =  Auth('student')->user()->department_id;
    $session_id     =  Auth('student')->user()->session_id;
    $degree_id      =  Auth('student')->user()->degree_id;

    $students       = DB::table('student_tbs')
    ->join('college_tbs', 'college_tbs.college_id', '=', 'student_tbs.department_id')
    ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
    ->select('student_tbs.*','college_tbs.college_id','college_tbs.name as CollegeName','degree_tbs.M_Title','degree_tbs.Det1')
    ->where(['student_tbs.student_id'=>$student_id,'student_tbs.regno' => $regno])
    ->orderBy('created_at','DESC')
    ->get();    

    $datesheets     = DB::select("SELECT subject_tbs.Na,subject_tbs.semester_id, student_datesheet_tbs.ds_date, student_datesheet_tbs.ds_time, student_datesheet_tbs.ds_day, center_codes_tbs.cname, subject_tbs.semester_id, RollNo_Com_Det_Part_View.rollno FROM student_datesheet_tbs INNER JOIN RollNo_Com_Det_Part_View ON student_datesheet_tbs.examcode = RollNo_Com_Det_Part_View.examcode AND student_datesheet_tbs.subcode = RollNo_Com_Det_Part_View.subcode AND student_datesheet_tbs.part = RollNo_Com_Det_Part_View.part INNER JOIN subject_tbs ON RollNo_Com_Det_Part_View.subcode = subject_tbs.code INNER JOIN center_codes_tbs ON RollNo_Com_Det_Part_View.ccode = center_codes_tbs.ccode AND RollNo_Com_Det_Part_View.examcode = center_codes_tbs.examcode 
      WHERE RollNo_Com_Det_Part_View.regno = $regno AND RollNo_Com_Det_Part_View.examcode = $examcode ORDER BY student_datesheet_tbs.ordr");

    return view('front.students.stdDatesheet')->with(['students' => $students,'datesheets'=>$datesheets]);
  }

  /* 
   * Student Detailed Marks Certificate.
   */

  public function ViewStudentDMC()
  {
    $student_id     =  Auth('student')->user()->student_id;
    $regno          =  Auth('student')->user()->regno;
    $department_id  =  Auth('student')->user()->department_id;
    $session_id     =  Auth('student')->user()->session_id;
    $degree_id      =  Auth('student')->user()->degree_id;

    $students       = DB::table('student_tbs')
    ->join('college_tbs', 'college_tbs.college_id', '=', 'student_tbs.department_id')
    ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
    ->join('session_tbs','session_tbs.sessionCode','student_tbs.session_id')
    ->select('student_tbs.*','college_tbs.college_id','college_tbs.name as CollegeName','degree_tbs.M_Title','degree_tbs.Det1','session_tbs.session')
    ->where(['student_tbs.student_id'=>$student_id,'student_tbs.regno' => $regno])
    ->orderBy('created_at','DESC')
    ->get(); 

    $dmcs           = DB::select("SELECT subject_tbs.Na,subject_tbs.hours,subject_tbs.semester_id,subject_tbs.Marks,roll_no_com_dets.obtTot,roll_no_com_dets.resStatus,roll_no_tbs.rollno,roll_no_tbs.regno,roll_no_tbs.resultStatus as finalStatus FROM subject_tbs INNER JOIN roll_no_com_dets ON subject_tbs.code = roll_no_com_dets.subcode INNER JOIN roll_no_tbs ON roll_no_tbs.rollno  =  roll_no_com_dets.rollno WHERE roll_no_tbs.regno = $regno
     ");

    $rollno = $dmcs[0]->rollno;

    $dmcss = DB::select("SELECT DISTINCT percent_marks_view.*, dbo_gpa_rulestb_new.GPA, dbo_gpa_rulestb_new.Grade FROM dbo_gpa_rulestb_new INNER JOIN percent_marks_view ON dbo_gpa_rulestb_new.Marks = percent_marks_view.obtPercent WHERE percent_marks_view.regno = $regno");

    return view('front.students.stdDmc')->with(['students' => $students,'dmcs' => $dmcss]);
  }

  /* 
   * Student Apply for Rechecking.
   */

  public function ViewStudentApplyForRechecking()
  {
    return "STudent Apply For Rechecking CODE GOES HERE";
  }

  /* 
   * Student Email Verification.
   */

  public function emailVerify($id,$regno)
  {
    $forms  = DB::table('student_tbs')
    ->join('stduent_certificates_tbs', 'stduent_certificates_tbs.regno', '=', 'student_tbs.regno')
    ->join('district_tbs','district_tbs.id','=','student_tbs.domicile')
    ->join('college_tbs','college_tbs.college_id','=','student_tbs.department_id')
    ->join('session_tbs','session_tbs.id','student_tbs.session_id','session_tbs.Years')
    ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
    ->select('student_tbs.*','stduent_certificates_tbs.*','district_tbs.name AS dom','college_tbs.name AS collegeName','session_tbs.session','degree_tbs.Det1')
    ->where(['student_tbs.student_id'=>$id,'student_tbs.regno'=>$regno])
    ->get();                  
    
    $regno = $forms[0]->regno;                  
    $stdName = $forms[0]->stdName;                  
    $email = $forms[0]->email;                  

    $modifyDet1 =  str_replace(" ", "-", $regno);
    $filename   = $modifyDet1;                   

    $pdf = PDF::loadView('front.students.email-form', compact('forms','forms')); 
    $pdf->setPaper('A4', 'portrait');       
    $output = $pdf->output($filename);

    $pdfFile = $regno."-RegistrationForm.pdf";
    
    $path = file_put_contents($pdfFile, $output);

    $deleteForm = public_path($pdfFile);

    $data=  array(
      'name'=>$stdName,
      'user_email'=>$email,
      'regno'=>$regno,
      'subject'=>"Email Confirmation",
      'email_body'=>"<span>Please contact with the relevant clerk in order to activate your account.</span>",
      'attachment'=>$deleteForm
    );

    try
    {
      Mail::send([], array('data' => $data), function($message) use($data)
      {
        $message->from('sadam.uom7@gmail.com', 'Secrecy UOM.');
        $message->to($data['user_email']);
        $message->subject($data['subject']);
        $message->setBody($data['email_body'], 'text/html');
        $message->attach($data['attachment']);
      });

    }
    catch(JWTException $exception)
    {
      $this->serverstatuscode = "0";
      $this->serverstatusdes = $exception->getMessage();
    }

    if (Mail::failures())
      {
        $this->statusdesc  =   "Error sending mail";
        $this->statuscode  =   "0";

      }
      else
      {
        $verify = StudentTb::where(['student_id' =>$id,'regno'=>$regno])->findOrFail($id);
        $verify->is_email = 1;
        $verify = $verify->save();

        Session::flash('emailConfirm' , 'Email Confirmed. Please check your email for further action.');
        unlink($deleteForm);
        return redirect()->route('homepage');
      }
      return response()->json(compact('this'));
    }


    public function studentProfile(){

      $student_id  = Auth('student')->user()->student_id;

      $student  = StudentTb::find($student_id);


      return view('front.students.profile')->with('student',$student);
    }

    public function studentProfileUpdate(Request $request){


        $studentName         = $request->studentName;
        $studentMobile       = $request->studentMobile;
        $studentPassword     = $request->studentPassword;
        $studentNewPassword  = $request->studentNewPassword;

       

        $student_id  = Auth('student')->user()->student_id;

        $student  = StudentTb::find($student_id);

        $oldPass   = $student->password;

        if (Hash::check($request->studentPassword, $student->password)) { 
           $student->fill([

            'password' => Hash::make($request->studentNewPassword)
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
