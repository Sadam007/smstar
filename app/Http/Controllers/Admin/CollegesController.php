<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\CollegeTb;
use App\Models\DegreeTb;
use App\Models\DegreesInCollegeTb;
use Auth;
use DB;
use Session;

class CollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = DB::table('college_tbs')
                        ->join('users', 'users.id', '=', 'college_tbs.user_id')
                        ->select('college_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','ASC')
                        ->paginate(10)->onEachSide(5);  
        $degrees       =  DegreeTb::orderBy('id', 'ASC')->get();                           
        return view('backend.colleges.collegecsv')->with(['colleges' =>$colleges, 'degrees' => $degrees]);
    }

    public function degreesIndex(){

         return view('backend.colleges.collegedegrees');
    }

    public function degreecsvpost(Request $request){
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

                    $college_id  = $importData[0];
                    $degrees_id  = $importData[1];
                    $regStart    = $importData[2];
                    $sets        = $importData[3];
                    $user_idd     = Auth::id();
            
                
                   $create = DegreesInCollegeTb::create([
                                'user_id' => $user_idd,
                                'college_id' => $college_id,
                                'degree_id'  => $degrees_id,
                                'regStart'   => $regStart,
                                'sets'       => $sets,
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

    public function collegecsv(){
        
        return view('backend.colleges.collegecsv');

    }


    public function collegecsvpost(Request $request){

        /*$this->validate($request,[
            'csv_import' => 'required|mimes:csv,txt',
        ]);*/

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
                    $college_id  = $importData[0];
                    $name        = $importData[1];
                    $address     = $importData[2];
                    $district    = $importData[3];
                    $regStart    = $importData[4];
                    $user_id     = Auth::id();

                   $create = CollegeTb::create([
                                "college_id" => $college_id,
                                "user_id" => $user_id,
                                "name" => $name,
                                "address" => $address,
                                "district" => $district,
                                "regStart" => $regStart,
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
        $editCollegeName  = $request->editCollegeName;

        $update  = CollegeTb::findOrFail($id);
        $update->name = $editCollegeName;
        $saved  = $update->save();

        if ($saved) {
          Session::flash("success","Record updated successfully.");
          return redirect()->back();
        }else{
          Session::flash("error","something went wrong.");
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
        $delete   =  CollegeTb::findOrFail($id);

        $deleted = $delete->delete();

          if ($deleted) {
            Session::flash('success','College deleted successfully');
            return redirect()->back();
          }
          else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
          }
    }


    public function collegeDegrees(Request $request){
       //dd($request->all());

        $collegeDegrees  = $request->collegeDegrees;

        
       
        foreach ($collegeDegrees as $key =>  $degee) {

            $user_id     = Auth::id();
            $college     = $request->college_hidden;
            $regStart    = $request->regStart;
            $sets        = $request->sets;

     
            $create = $create = DegreesInCollegeTb::create([
                'user_id' => $user_id,
                'college_id' => $college,
                'degree_id'  => $degee,
                'regStart'   => $regStart,
                'sets'       => $sets,

            ]);
        }
        if ($create) {
          
          Session::flash('success','Degrees(s) has been added successfully');
          return redirect()->route('collegecsv');
        }
        else{
        Session::flash('error','Degrees(s) could not be added');
        return redirect()->route('collegecsv');
        }
        

        
        

    }
}
