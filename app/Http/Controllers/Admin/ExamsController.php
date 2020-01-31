<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\ExamCodeTb;
use App\CenterCodesTb;
use Auth;
use DB;
use Session;

class ExamsController extends Controller
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
        //
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

    public function examcsv(){
        $exams = DB::table('exam_code_tbs')
                        ->join('users', 'users.id', '=', 'exam_code_tbs.user_id')
                        ->select('exam_code_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
            
        return view('backend.exams.examcsv')->with('exams',$exams);
    }

    public function examcsvpost(Request $request){

        $file = $request->file('csv_import');
        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath  = $file->getRealPath();
        $fileSize  = $file->getSize();
        $mimeType  = $file->getMimeType();
        $valid_extension = array("csv");
        $maxFileSize = 2097152; 
        if(in_array(strtolower($extension),$valid_extension)){
            if($fileSize <= $maxFileSize){
                $location = 'uploads';  
                $file->move($location,$filename);
                $filepath = public_path($location."/".$filename);
                $file = fopen($filepath,"r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );
                        if($i == 0){
                            $i++;
                            continue; 
                        }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                }
                fclose($file);
                foreach($importData_arr as $importData){
                    $user_id      = Auth::id();
                    $examcode     = $importData[0];
                    $description  = $importData[1];
                    $type         = $importData[2];
                    $session      = $importData[3];
                    
                    $create = ExamCodeTb::create([
                                "user_id" => $user_id,
                                "examcode" => $examcode,
                                "description" => $description,
                                "type" => $type,
                                "session" => $session,
                    ]);
                }
                if ($create) { 
                    unlink(public_path($location."/".$filename));
                    $arr = array(['Good' => true,'message' => 'Data has been successfully imported.'], 200);
                    echo json_encode($arr);
                }
                else{
                    return response()->json(['Good' => true,'message' => 'File too large. File must be less than 2MB.'], 200);
                }
            }

          }else{
            return response()->json(['Good' => true,'message' => 'Invalid File Extension'], 200);
          }

    }

     public function examUpdate(Request $request, $id){
        $editExamcode   = $request->editExamcode;
        $editExamname   = $request->editExamname;
        $editExamtype   = $request->editExamtype;

        $findexamcode   = ExamCodeTb::findOrFail($id);

        $findexamcode->examcode  = $editExamcode;
        $findexamcode->description  = $editExamname;
        $findexamcode->type  = $editExamtype;
        $saved   = $findexamcode->save();

        if ($saved) {
            Session::flash('success','Exam code updated successfully');
            return redirect()->route('examcsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }
    }

    public function examDelete($id){
     $deleteExamCode  = ExamCodeTb::findOrFail($id);

        $deleted  = $deleteExamCode->delete();

        if ($deleted) {
            Session::flash('success','Exam Code deleted successfully');
            return redirect()->route('examcsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }
    }

    public function centrecsv(){
         $centers = DB::table('center_codes_tbs')
                        ->join('users', 'users.id', '=', 'center_codes_tbs.user_id')
                        ->select('center_codes_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('center_codes_tbs.ccode','DESC')
                        ->paginate(20)->onEachSide(5);

        return view('backend.exams.centrecsv')->with(['centers' => $centers]);
    }

    public function centrecsvpost(Request $request){
        $file = $request->file('csv_import');
        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath  = $file->getRealPath();
        $fileSize  = $file->getSize();
        $mimeType  = $file->getMimeType();
        $valid_extension = array("csv");
        $maxFileSize = 2097152; 
        if(in_array(strtolower($extension),$valid_extension)){
            if($fileSize <= $maxFileSize){
                $location = 'uploads';  
                $file->move($location,$filename);
                $filepath = public_path($location."/".$filename);
                $file = fopen($filepath,"r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata );
                        if($i == 0){
                            $i++;
                            continue; 
                        }
                    for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                }
                fclose($file);
                foreach($importData_arr as $importData){
                    $user_id        = Auth::id();
                    $ccode          = $importData[0];
                    $examcode       = $importData[1];
                    $cname = $importData[2];            
                    
                    $create = CenterCodesTb::create([
                                "user_id"         => $user_id,
                                "ccode"           => $ccode,
                                "examcode"        => $examcode,
                                "cname"  => $cname,
                                
                    ]);
                }

                if ($create) { 
                    unlink(public_path($location."/".$filename));
                    $arr = array(['Good' => true,'message' => 'Data has been successfully imported.'], 200);
                    echo json_encode($arr);
                }
                else{
                    return response()->json(['Good' => true,'message' => 'File too large. File must be less than 2MB.'], 200);
                }
            }

          }else{
            return response()->json(['Good' => true,'message' => 'Invalid File Extension'], 200);
          }
    }

    public function centerUpdate(Request $request, $id){
        //dd($request->all());
        $centerCode   = $request->centerCode;
        $centerName   = $request->centerName;
        $centerEcode   = $request->centerEcode;

        $findsub   = CenterCodesTb::findOrFail($id);

        $findsub->ccode  = $centerCode;
        $findsub->cname  = $centerName;
        $findsub->examcode  = $centerEcode;
        $saved   = $findsub->save();

        if ($saved) {
            Session::flash('success','Center code updated successfully');
            return redirect()->route('centrecsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }

    }

    public function centerDestroy($id){
        $deleteCenter  = CenterCodesTb::findOrFail($id);

        $deleted  = $deleteCenter->delete();

        if ($deleted) {
            Session::flash('success','Center deleted successfully');
            return redirect()->route('centrecsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }
    }
}
