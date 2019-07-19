<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\StudentsStoreRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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
class StudentsController extends Controller
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
        $colleges      =  CollegeTb::orderBy('id', 'ASC')->get();
        $sessions      =  SessionTb::orderBy('id', 'ASC')->get();
        $degrees       =  DegreeTb::orderBy('id', 'ASC')->get();
        $districts     =  DistrictTb::orderBy('id', 'ASC')->get();
        $certificates  =  CertificateTb::orderBy('id', 'ASC')->get();

        return view('front.students.create')->with(['colleges' => $colleges , 'sessions' => $sessions, 'degrees' => $degrees,'districts' => $districts, 'certificates' => $certificates]);
    }

    public function studentLogin(){
        return view('front.students.login');
    }

public function registerStudents(StudentsStoreRequest $request){

        $validated = $request->validated();
        $stdDepartment   = $request->stdDepartment;
        $stdSession      = $request->stdSession;
        $sessionId       = $request->sessionId;
        $stdDegree       = $request->stdDegree;
        $stdName         = $request->stdName;
        $stdfName        = $request->stdfName;
        $stddob          = $request->stddob;
        $stdDomicile     = $request->stdDomicile;
        $stdPhoto        = $request->stdPhoto;
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
        //dd($request->all());

        //$registration = DB::select("SELECT regno FROM `student_tbs` WHERE degree_id='$stdDegree' AND department_id='$stdDepartment' AND session_id='$stdSession'");

        $registration = StudentTb::select('regno')
                                ->where('degree_id', $stdDegree)
                                ->where('department_id', $stdDepartment)
                                ->where('session_id', $sessionId)
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
            'session_id'     => $sessionId,
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
            if ($certificates) {
                $arr = array(['Good' => true,'message' => 'Account Registered Scuccessfully.'], 200);
                echo json_encode($arr);
            }
        

        }   
        else{
            $regnoo = ($registration->regno)+1;
            $create = StudentTb::create([
            'regno' => $regnoo,
            'department_id'  => $stdDepartment,
            'session_id'     => $sessionId,
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
            if ($certificates) {
                $arr = array(['Good' => true,'message' => 'Account Registered Scuccessfully.'], 200);
                echo json_encode($arr);
            }
        }    
    }

    public function StudentAuth(Request $request)
   {
        $this->validate($request, [
        'regno'=>'required',
        'lpassword'=>'required'
   ]);     
     $regno = $request->regno;
     $password = $request->lpassword;
     $remember = $request->remember;


     if(Auth::guard('student')->attempt(['regno'=> $regno, 'password'=> $password], $remember)){
      

      return redirect()->route('stddashboard');
      //return view("front.stddashboard");
      } else {
          Session::flash('warning' , 'Invalid Username or Password');
        return redirect()->back();
      }
    }
     public function home()
      {
      
        return view('front.stddashboard');
      }
  public function logout()
  {
    Auth::guard('student')->logout();

    return redirect()->route('login.student'); 
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function checkCollegesDegrees(Request $request)
    {
        $checkDept = $request->deptValue;
        if ($checkDept) {
            $degrees = DB::table('degree_tbs')
                        ->join('degrees_in_college_tbs', 'degrees_in_college_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->select('degree_tbs.*','degrees_in_college_tbs.degree_id','degrees_in_college_tbs.college_id')
                        ->where('degrees_in_college_tbs.college_id','=',$checkDept)
                        ->orderBy('created_at','DESC')
                        ->get();    
            $data = array();                   
            if (count($degrees) > 0) {
               foreach ($degrees as $degree) {
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
            else{
             $json_data = array(
                            "Good" => false,
                            "Message" => 'No degree found in this college',
                        );
                echo json_encode($json_data); 
            }    
        }
        else {
            echo "The selected department is not found";
        }    
    }

    public function ViewEnrolledExams(){
      
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
      Examcode Function
    */

    /*public function ViewExamCodes($rollno , $examcode){

      $student_id     =  Auth('student')->user()->student_id;
      $regno          =  Auth('student')->user()->regno;

      $students       = DB::table('student_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'student_tbs.department_id')
                        ->select('student_tbs.*','college_tbs.college_id','college_tbs.name as CollegeName')
                        ->where(['student_id'=>$student_id,'regno' => $regno])
                        ->orderBy('created_at','DESC')
                        ->get();

      $rollnos        = DB::table('roll_no_tbs')
                        ->join('roll_no_com_dets','roll_no_com_dets.examcode','=','roll_no_tbs.examcode')       
                        ->join('subject_tbs','subject_tbs.code','=','roll_no_com_dets.subcode')
                        ->join('center_codes_tbs','center_codes_tbs.examcode','roll_no_tbs.examcode')
                        ->select('roll_no_tbs.rollno','roll_no_tbs.examcode','subject_tbs.code','subject_tbs.semester_id','center_codes_tbs.cname')
                        ->where(['roll_no_tbs.regno' => $regno ,'roll_no_tbs.examcode' => $examcode])
                        ->groupBy('roll_no_tbs.rollno')
                        ->get();

      

      dd($rollnos);                              
                        
    
      return view('front.students.examenrollnos')->with(['students'=>$students,'rollnos' => $rollnos]);              
    }*/

    public function ViewStudentDateSheet($examid , $examcode,$exam){

        $student_id     =  Auth('student')->user()->student_id;
        $regno          =  Auth('student')->user()->regno;
        $department_id  =  Auth('student')->user()->department_id;
        $session_id     =  Auth('student')->user()->session_id;
        $degree_id      =  Auth('student')->user()->degree_id;

        /*$examcode       =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode       =  $examcode[0];*/

        $students       = DB::table('student_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'student_tbs.department_id')
                        ->join('degree_tbs','degree_tbs.DegCode','=','student_tbs.degree_id')
                        ->select('student_tbs.*','college_tbs.college_id','college_tbs.name as CollegeName','degree_tbs.M_Title','degree_tbs.Det1')
                        ->where(['student_tbs.student_id'=>$student_id,'student_tbs.regno' => $regno])
                        ->orderBy('created_at','DESC')
                        ->get();    

        $datesheets   = DB::select("SELECT subject_tbs.Na,subject_tbs.semester_id, student_datesheet_tbs.ds_date, student_datesheet_tbs.ds_time, student_datesheet_tbs.ds_day, center_codes_tbs.cname, subject_tbs.semester_id, RollNo_Com_Det_Part_View.rollno
                        FROM student_datesheet_tbs INNER JOIN RollNo_Com_Det_Part_View ON student_datesheet_tbs.examcode = RollNo_Com_Det_Part_View.examcode AND student_datesheet_tbs.subcode = RollNo_Com_Det_Part_View.subcode AND student_datesheet_tbs.part = RollNo_Com_Det_Part_View.part INNER JOIN
                         subject_tbs ON RollNo_Com_Det_Part_View.subcode = subject_tbs.code INNER JOIN
                         center_codes_tbs ON RollNo_Com_Det_Part_View.ccode = center_codes_tbs.ccode AND 
                         RollNo_Com_Det_Part_View.examcode = center_codes_tbs.examcode 
                         WHERE RollNo_Com_Det_Part_View.regno = $regno AND RollNo_Com_Det_Part_View.examcode = $examcode ORDER BY student_datesheet_tbs.ordr");

        return view('front.students.stdDatesheet')->with(['students' => $students,'datesheets'=>$datesheets]);


    }

    public function ViewStudentDMC(){
        $student_id     =  Auth('student')->user()->student_id;
        $regno          =  Auth('student')->user()->regno;
        $department_id  =  Auth('student')->user()->department_id;
        $session_id     =  Auth('student')->user()->session_id;
        $degree_id      =  Auth('student')->user()->degree_id;

         $students      = DB::table('student_tbs')
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
        //dd($rollno);

        /*$dmcss  = DB::table('percent_marks_view')
                        ->join('dbo_gpa_rulestb_new', 'dbo_gpa_rulestb_new.Marks', '=', 'percent_marks_view.obtPercent')
                        ->select('percent_marks_view.*','dbo_gpa_rulestb_new.GPA','dbo_gpa_rulestb_new.Marks')
                        ->where(['percent_marks_view.regno' => $regno,'percent_marks_view.rollno' => $rollno])
                        ->orderBy('percent_marks_view.semester_id')
                        ->get();  */
        /*$dmcss = DB::select("SELECT DISTINCT percent_marks_view.Na,percent_marks_view.hours,percent_marks_view.obtTot,percent_marks_view.obtPercent,percent_marks_view.rollno,dbo_gpa_rulestb_new.GPA,percent_marks_view.resStatus,dbo_gpa_rulestb_new.Marks FROM percent_marks_view INNER JOIN dbo_gpa_rulestb_new ON percent_marks_view.Marks = dbo_gpa_rulestb_new.Marks WHERE percent_marks_view.regno = $regno GROUP BY percent_marks_view.obtPercent ORDER BY percent_marks_view.semester_id");*/

        $dmcss = DB::select("SELECT DISTINCT percent_marks_view.*, dbo_gpa_rulestb_new.GPA, dbo_gpa_rulestb_new.Grade FROM dbo_gpa_rulestb_new INNER JOIN percent_marks_view ON dbo_gpa_rulestb_new.Marks = percent_marks_view.obtPercent WHERE percent_marks_view.regno = $regno");
        //dd($dmcss);

      return view('front.students.stdDmc')->with(['students' => $students,'dmcs' => $dmcss]);
    }

    public function ViewStudentApplyForRechecking(){
        return "STudent Apply For Rechecking CODE GOES HERE";
    }
    
}
