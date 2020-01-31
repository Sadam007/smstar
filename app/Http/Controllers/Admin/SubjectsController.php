<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\SubjectTb;
use Auth;
use DB;
use Session;

class SubjectsController extends Controller
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


    public function subjectcsv(){

        $subjects = DB::table('subject_tbs')
                        ->join('users', 'users.id', '=', 'subject_tbs.user_id')
                        ->select('subject_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
            
        return view('backend.subjects.subjectcsv')->with('subjects',$subjects);
    }

    public function subjectscsvpost(Request  $request){
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
                    $user_id   = Auth::id();
                    $code      = $importData[0];
                    $Na        = $importData[1];
                    $Marks     = $importData[2];
                    $sname     = $importData[3];
                    $hours     = $importData[4];
                    $Pmarks    = $importData[5];
                    $sname2    = $importData[6];
                    $degree_id    = $importData[7];
                    $semester_id    = $importData[8];

                    
                    $create = SubjectTb::create([
                                "user_id" => $user_id,
                                "code" => $code,
                                "Na" => $Na,
                                "Marks" => $Marks,
                                "sname" => $sname,
                                "hours" => $hours,
                                "Pmarks" => $Pmarks,
                                "sname2" => $sname2,
                                "degree_id" => $degree_id,
                                "semester_id" => $semester_id,
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
        $edit_subcode   = $request->edit_subcode;
        $edit_subname   = $request->edit_subname;
        $edit_submarks  = $request->edit_submarks;

        $findsub   = SubjectTb::findOrFail($id);

        $findsub->code  = $edit_subcode;
        $findsub->Na  = $edit_subname;
        $findsub->Marks  = $edit_submarks;
        $saved   = $findsub->save();

        if ($saved) {
            Session::flash('success','Subject updated successfully');
            return redirect()->route('subjectcsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteSubject  = SubjectTb::findOrFail($id);

        $deleted  = $deleteSubject->delete();

        if ($deleted) {
            Session::flash('success','Subject deleted successfully');
            return redirect()->route('subjectcsv');
        }
        else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
        }
    }
}
