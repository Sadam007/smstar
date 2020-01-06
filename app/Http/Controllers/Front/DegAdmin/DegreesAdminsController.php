<?php

namespace App\Libraries;

namespace App\Http\Controllers\Front\DegAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentTb;
use App\Models\ExamCodeTb;
use App\Models\RollNoTb;
use App\Models\DegreeAdminTb;
use App\Models\DegreeAdminAssgnmentTb;
use App\Models\TeacherSubjectAssgnmentTb;
use App\TeacherTb;
use Auth;
use DB;
use Session;
use PDF;

class DegreesAdminsController extends Controller
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
     * @return \Illuminate\Http\ResponseDegreesAdminsController
     */
    public function create()
    {
        $departmentId = Auth('specialuser')->user()->department_id;

        $degrees = DB::table('degree_tbs')
                        ->join('degrees_in_college_tbs', 'degrees_in_college_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->select('degree_tbs.*','degrees_in_college_tbs.degree_id','degrees_in_college_tbs.college_id')
                        ->where('degrees_in_college_tbs.college_id','=',$departmentId)
                        ->orderBy('created_at','DESC')
                        ->get();     

         $degAdmins = DB::table('degree_admin_tbs')
                        ->join('special_user_tbs', 'special_user_tbs.department_id', '=', 'degree_admin_tbs.department_id')
                        ->select('degree_admin_tbs.*','special_user_tbs.id as userId','special_user_tbs.username as addedby')
                        ->orderBy('created_at','DESC')
                        ->where('degree_admin_tbs.department_id' , '=', $departmentId)
                        ->paginate(10)->onEachSide(5); 

        return view('front.colleges.degree-admin')->with(['degrees'=>$degrees,'degAdmins'=>$degAdmins]);     
           
   
                 
        
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
        $password     = $request->username;
        $create = DegreeAdminTb::create([
            'create_user_id' => $user_id,
            'department_id' => $deparment_id,
            'username' => $username,
            'password' => bcrypt($password),
        ]);
        
        if ($create) {
           $arr = array(['Good' => true,'message' => 'Degree Admin has been created successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }    
    }

    public function degreeAdminAssignment(){

        $departmentId = Auth('specialuser')->user()->department_id;
        $user_id      = Auth('specialuser')->user()->id;

        $degrees = DB::table('degree_tbs')
                        ->join('degrees_in_college_tbs', 'degrees_in_college_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->select('degree_tbs.*','degrees_in_college_tbs.degree_id','degrees_in_college_tbs.college_id')
                        ->where('degrees_in_college_tbs.college_id','=',$departmentId)
                        ->orderBy('created_at','DESC')
                        ->get();   

       //dd($user_id);

        $users  = DegreeAdminTb::select('*')
                                ->where('create_user_id', $user_id)
                                ->where('department_id', $departmentId)
                                ->orderBy('created_at','DESC')
                                ->get();
        //dd($users);
        $degreeAdmins  =  DB::table('degree_tbs')
                              ->join('degree_admin_assgnment_tbs','degree_admin_assgnment_tbs.degree_id','=','degree_tbs.DegCode')
                              ->join('degree_admin_tbs','degree_admin_tbs.degree_admin_id','=','degree_admin_assgnment_tbs.degree_admin_id')
                              ->select('degree_tbs.*','degree_admin_assgnment_tbs.degree_id','degree_admin_assgnment_tbs.department_id','degree_admin_assgnment_tbs.is_assigned','degree_admin_tbs.department_id','degree_admin_tbs.username as addedBy','degree_admin_tbs.degree_admin_id')
                              ->where('degree_admin_assgnment_tbs.department_id',$departmentId)
                              ->distinct('degree_admin_assgnment_tbs.degree_id')
                              ->groupBy('degree_tbs.DegCode')
                              ->paginate(10)->onEachSide(5);

      //  dd($degreeAdmins);                      
    
        return view('front.colleges.degree-admin-assignment')->with(['degrees'=>$degrees,'users'=>$users,'degreeAdmins'=>$degreeAdmins]);

    }

    public function degreeAdminAssignmentProcess(Request $request){
       //dd($request->degreeUsers);
        $user_id = $request->specilauserId;
        $department_id = $request->departmentId;
        $degrees_id = $request->degrees;
        $degree_admin_id = $request->degreeUsers;

         $assignment = DegreeAdminAssgnmentTb::select('degree_id')
                                ->where('degree_id', $degrees_id)
                                ->where('department_id', $department_id)
                                ->orderBy('degree_id','DESC')
                                ->first();
        //dd($assignment);                        
        if ($assignment == "") 
            {
                $create = DegreeAdminAssgnmentTb::create([
                    'specialuser_id'=> $user_id,
                    'department_id'=> $department_id,
                    'degree_id'=> $degrees_id,
                    'degree_admin_id'=> $degree_admin_id,
                    'is_assigned' => 1
                ]);
        
                if ($create) {
                $arr = array(['Good' => true,'message' => 'Degree has been assigned to relevant degree admin successfully.'], 200);
                echo json_encode($arr);
                }
                    
        }               
        
    }


    public function loginDegAdmin(){
        return view('front.colleges.degree-admin-login');

    }

    public function DegAdminAuth(Request $request)
    {
        $this->validate($request, [
        'username'=>'required',
        'password'=>'required'
    ]);

   // dd($request->all());    

     $username = $request->username;
     $password = $request->password;
     $remember = $request->remember;



     if(Auth::guard('degAdmin')->attempt(['username'=> $username, 'password'=> $password,'status' => 1], $remember))
        {
         
         //dd(Auth::guard('degAdmin'));
         return redirect()->route('degAdmindashboard');
        }  else {
       
        Session::flash('warning' , 'Invalid Username or Password or your account is inactive');
        return redirect()->back();
        //return redirect()->back()->with('warning', 'Invalid Username or Password');
        }
    }


    public function home()
        {
            $degAdmin_id = Auth('degAdmin')->user()->degree_admin_id;
            $degAdmin_department = Auth('degAdmin')->user()->department_id;
            $status = Auth('degAdmin')->user()->status;


            $colleges = DB::table('degree_admin_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'degree_admin_tbs.department_id')
                        ->select('degree_admin_tbs.*','college_tbs.id as collegeId','college_tbs.name as collegeName')
                        ->orderBy('created_at','DESC')
                        ->where('degree_admin_tbs.department_id' , '=', $degAdmin_department)
                        ->where('degree_admin_tbs.degree_admin_id' , '=', $degAdmin_id)
                        ->where('degree_admin_tbs.status' , '=', 1)
                        ->get();
           // dd($colleges);            

            $examcode  =  ExamCodeTb::where('is_active',1)->pluck('examcode');
            $examcode  =  $examcode[0];

            $degrees = DB::table('degree_tbs')
                        ->join('degree_admin_assgnment_tbs', 'degree_admin_assgnment_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->join('student_tbs','student_tbs.degree_id','=','degree_tbs.DegCode')
                        ->join('roll_no_tbs','roll_no_tbs.regno','=','student_tbs.regno')
                        ->select('degree_tbs.*','degree_admin_assgnment_tbs.degree_id','degree_admin_assgnment_tbs.department_id','degree_admin_assgnment_tbs.degree_admin_id','student_tbs.degree_id','student_tbs.is_active','roll_no_tbs.regno as rollRegNo','roll_no_tbs.colcode','roll_no_tbs.examcode')
                        ->distinct('degree_admin_assgnment_tbs.department_id')
                        ->where('degree_admin_assgnment_tbs.department_id','=',$degAdmin_department)
                        ->where('degree_admin_assgnment_tbs.degree_admin_id','=',$degAdmin_id)
                        ->groupBy('student_tbs.degree_id')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
          
            $examcode  =  ExamCodeTb::where('is_active',1)->pluck('examcode');
            $examcode  =  $examcode[0];

           

            $students  =  RollNoTb::where(['examcode'=> $examcode,'ccode'=>$degAdmin_department])->get();
           



            return view('front.degAdmindashboard')->with(['colleges'=>$colleges,'degrees'=>$degrees]);
    }

    public function teacherSubjectAssigment(Request $request){

        $degAdminId   = Auth('degAdmin')->user()->degree_admin_id;
        $degAdminDept = Auth('degAdmin')->user()->department_id;

        $teachId      =  $request->teachId;
        $subjectcode  =  $request->subjectcode;
        
        $examcode     =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode     =  $examcode[0];

        $checking     = TeacherSubjectAssgnmentTb::select('teach_assign_id')
                                ->where('deg_admin_id'  , $degAdminId)
                                ->where('subject_code'  , $subjectcode)
                                ->orderBy('teach_assign_id'   , 'DESC')
                                ->first();
                           
       if ($checking == "" || $checking == NULL) 
        {
            $assignment   =  TeacherSubjectAssgnmentTb::create([
                            'deg_admin_id'  => $degAdminId,
                            'subject_code'  => $subjectcode,
                            'examcode'      => $examcode,
                            'teacher_id'    => $teachId,
                            'department_id' => $degAdminDept,
                            'is_assigned'   => 1,
            ]);

            if ($assignment) {
                $arr = array(['Good' => true,'message' => 'Subject has been assigned to the relevant teacher.'], 200);
                echo json_encode($arr);
            }
            exit();
        }
        else{
            
            $findId = $checking->teach_assign_id;


            $assignment    = TeacherSubjectAssgnmentTb::find($findId);

            $assignment->deg_admin_id  = $degAdminId;
            $assignment->subject_code  = $subjectcode;
            $assignment->examcode      = $examcode;
            $assignment->teacher_id    = $teachId;
            $assignment->department_id = $degAdminDept;
            $assignment->is_assigned   = 1;
            $$assignment = $assignment->save();

            
            if ($assignment) {
                $arr = array(['Good' => true,'message' => 'Subject has been assigned to the relevant teacher.'], 200);
                echo json_encode($arr);
            }

        }

        

    }

    public function logout()
    {
        Auth::guard('degAdmin')->logout();

        //return redirect()->route('specialuser.logout'); 
        return redirect()->route('degadmin.login'); 
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


    public function degadmininactive(Request $request,$id)
    {
       
       $user_id = Auth('specialuser')->user()->id;
 

       $inactive = DegreeAdminTb::where('create_user_id', $user_id)->findOrFail($id);
       $inactive->status = 1;
       $result = $inactive->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'Degree Admin has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }

    public function degadminactive(Request $request,$id)
    {
 
       $user_id = Auth('specialuser')->user()->id; 
       $active = DegreeAdminTb::where('create_user_id', $user_id)->findOrFail($id);
       $active->status = 0;
       $result = $active->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'Degree Admin has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }

    public function degreesStudents($degree,$department){
        $degAdmin_department = Auth('degAdmin')->user()->department_id;
        $colleges  = $this->getDepartment();
     
        $students  =  StudentTb::select('student_tbs.*')
                                ->where(['degree_id'=>$degree,'department_id'=>$department])
                                ->paginate(10)->onEachSide(5);
                                //->get();
        $examcode  =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode  =  $examcode[0];
        
        $degrees = DB::table('roll_no_tbs')
                            ->join('student_tbs','student_tbs.regno','=','roll_no_tbs.regno')
                            ->join('degree_tbs', 'degree_tbs.DegCode','student_tbs.degree_id')
                            ->select('roll_no_tbs.*','student_tbs.student_id','student_tbs.regno','student_tbs.stdName','student_tbs.stdfName','student_tbs.is_active','degree_tbs.DegCode','degree_tbs.Det1')
                            ->distinct('degree_tbs.regno')
                            ->where('roll_no_tbs.examcode'  , '=',$examcode)
                            ->where('roll_no_tbs.colcode'   , '=',$degAdmin_department)
                            ->where('student_tbs.degree_id' , '=', $degree)
                            ->orderBy('created_at','DESC')
                         //->paginate(10)->onEachSide(5);   
                         ->get();                   
            //dd($degrees);

        return view('front.degadmins.student-list')->with(['students'=>$students,'colleges'=>$colleges,'degrees'=>$degrees]);                        

    }

    public function degreesSemesters($degree){
       $colleges  = $this->getDepartment();

        $semesters  =  DB::select("SELECT DISTINCT semester_id,degree_id FROM subject_tbs WHERE degree_id = '$degree'");

        return view('front.degadmins.semester-list')->with(['colleges'=>$colleges,'semesters'=>$semesters]);
    }

    public function semesterSubjects($semester , $degree){

    $degAdmin_department = Auth('degAdmin')->user()->department_id;

    $colleges  = $this->getDepartment();

    $subjects  =  DB::select("SELECT DISTINCT subject_id,code,Na,degree_id,semester_id FROM subject_tbs WHERE degree_id = '$degree' AND semester_id = '$semester'");

    $teachers  = TeacherTb::where(['department_id'=>$degAdmin_department,'is_active' => 1])->orderBy('name','ASC')->get();

    $assignments  = DB::table('teacher_subject_assgnment_tbs')
                        ->join('teacher_tbs','teacher_tbs.id','=','teacher_subject_assgnment_tbs.teacher_id')
                        ->select('teacher_subject_assgnment_tbs.department_id','teacher_subject_assgnment_tbs.subject_code','teacher_subject_assgnment_tbs.teacher_id','teacher_tbs.*')
                        ->where('teacher_subject_assgnment_tbs.department_id',$degAdmin_department)
                        ->distinct('teacher_tbs.name')
                        ->groupBy('teacher_subject_assgnment_tbs.subject_code')
                        ->get();
    
    return view('front.degadmins.subject-list')->with(['colleges'=>$colleges,'subjects'=>$subjects,'teachers'=>$teachers,'assignments'=>$assignments]);


    }

    public function crossTabDegrees(){
        $degAdmin_id = Auth('degAdmin')->user()->degree_admin_id;
        $degAdmin_department = Auth('degAdmin')->user()->department_id;
        $status = Auth('degAdmin')->user()->status;


        $colleges = DB::table('degree_admin_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'degree_admin_tbs.department_id')
                        ->select('degree_admin_tbs.*','college_tbs.id as collegeId','college_tbs.name as collegeName')
                        ->orderBy('created_at','DESC')
                        ->where('degree_admin_tbs.department_id' , '=', $degAdmin_department)
                        ->where('degree_admin_tbs.degree_admin_id' , '=', $degAdmin_id)
                        ->where('degree_admin_tbs.status' , '=', 1)
                        ->get();

        $degrees = DB::table('degree_tbs')
                        ->join('degree_admin_assgnment_tbs', 'degree_admin_assgnment_tbs.degree_id', '=', 'degree_tbs.DegCode')
                        ->join('student_tbs','student_tbs.degree_id','=','degree_tbs.DegCode')
                        ->join('roll_no_tbs','roll_no_tbs.regno','=','student_tbs.regno')
                        ->select('degree_tbs.*','degree_admin_assgnment_tbs.degree_id','degree_admin_assgnment_tbs.department_id','degree_admin_assgnment_tbs.degree_admin_id','student_tbs.degree_id','student_tbs.is_active','roll_no_tbs.regno as rollRegNo','roll_no_tbs.colcode','roll_no_tbs.examcode')
                        ->distinct('degree_admin_assgnment_tbs.department_id')
                        ->where('degree_admin_assgnment_tbs.department_id','=',$degAdmin_department)
                        ->where('degree_admin_assgnment_tbs.degree_admin_id','=',$degAdmin_id)
                        ->groupBy('student_tbs.degree_id')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
          
            $examcode  =  ExamCodeTb::where('is_active',1)->pluck('examcode');
            $examcode  =  $examcode[0];                

        return view('front.degadmins.crossTabDegrees')->with(['colleges'=>$colleges,'degrees' =>$degrees]);               
    }

    public function crossTabDegreesPdf($degree){

        $degAdmin_department = Auth('degAdmin')->user()->department_id;
        
        $examcode  =  ExamCodeTb::where('is_active',1)->pluck('examcode');
        $examcode  =  $examcode[0]; 

        $student_records=DB::select("SELECT DISTINCT student_tbs.regno,student_tbs.stdName,student_tbs.stdfName,student_tbs.department_id,student_tbs.degree_id,college_tbs.name FROM student_tbs INNER JOIN  college_tbs ON  college_tbs.college_id = student_tbs.department_id WHERE  department_id = $degAdmin_department AND degree_id = $degree");
    
        $all_records = array();
                    
        foreach ($student_records as $record){
            $regno = $record->regno;
            $department_id = $record->department_id;

            //GROUP BY dbo_web_part.OneRTwo

            $student_rollnos = DB::select("SELECT DISTINCT roll_no_tbs.regno,roll_no_tbs.rollno,roll_no_com_dets.subcode,roll_no_com_dets.obt40,subject_tbs.Na,subject_tbs.semester_id,subject_tbs.hours,dbo_web_part.P_name,dbo_web_part.OneRTwo FROM  roll_no_tbs INNER JOIN roll_no_com_dets ON roll_no_com_dets.rollno = roll_no_tbs.rollno LEFT JOIN subject_tbs ON subject_tbs.code   = roll_no_com_dets.subcode LEFT JOIN dbo_web_part ON  dbo_web_part.part = roll_no_tbs.part WHERE roll_no_tbs.regno= $regno  ORDER BY  roll_no_com_dets.rollno");

            $all_records[] = array('students'=>$record,'rollnos'=>$student_rollnos);

        }

        $degrees  =  DB::select("SELECT Det1 FROM `degree_tbs` WHERE DegCode = $degree");   
        $Det1 = $degrees[0]->Det1;    
        $modifyDet1 =  str_replace(" ", "-", $Det1);
        $filename   = $modifyDet1;
            
        // return view('front.degadmins.degrees-pdf', compact('all_records'));

        $pdf = PDF::loadView('front.degadmins.degrees-pdf', compact('all_records','degrees'));
        $pdf->setPaper('A4', 'portrait');       
        return $pdf->stream($filename);
        //return $pdf->download('invoice.pdf');
           
    }

    public  function getDepartment(){
         $degAdmin_id = Auth('degAdmin')->user()->degree_admin_id;
         $degAdmin_department = Auth('degAdmin')->user()->department_id;
         $status = Auth('degAdmin')->user()->status;
         $colleges = DB::table('staff_tbs')
                        ->join('college_tbs', 'college_tbs.college_id', '=', 'staff_tbs.department_id')
                        ->select('staff_tbs.*','college_tbs.id as collegeId','college_tbs.name as collegeName')
                        ->orderBy('created_at','DESC')
                        ->where('staff_tbs.department_id' , '=', $degAdmin_department)
                        //->where('staff_tbs.id' , '=', $degAdmin_id)
                        ->where('staff_tbs.status' , '=', 1)
                        ->where('staff_tbs.id','=',$degAdmin_id)
                        ->get(); 

        //dd($colleges);                
        return $colleges;             
               
    }


    public function degadminProfile(){

        $degAdmin_id = Auth('degAdmin')->user()->degree_admin_id;

        $degadmin    = DegreeAdminTb::find($degAdmin_id);

        return view('front.degadmins.profile')->with('degadmin',$degadmin);

    }

    public function degadminProfileUpdate(Request $request){

    }
}
