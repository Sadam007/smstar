<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\DegreeTb;
use Auth;
use DB;
use Session;

class DegreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $degrees = DB::table('degree_tbs')
                        ->join('users', 'users.id', '=', 'degree_tbs.user_id')
                        ->select('degree_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
        return view('backend.degrees.degreecsv')->with('degrees',$degrees);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function degreecsvpost(Request $request){

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
                    $M_Title     = $importData[0];
                    $Det1        = $importData[1];
                    $DegCode     = $importData[2];
                    $user_id     = Auth::id();

                   $create = DegreeTb::create([
                                "user_id" => $user_id,
                                "M_Title" => $M_Title,
                                "Det1"    => $Det1,
                                "DegCode" => $DegCode,
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

    public function singleDegree(){
        return view('backend.degrees.single-degree');
    }

    public function singleDegreeProcess(Request $request){
        
        $this->validate($request, [
            'degTitle' => 'required',
            'degDet' => 'required',
            'degCode' => 'required',
            'degYears' => 'required',
        ]);

    

        $user_id    = Auth::id();
        $degTitle   = strtoupper($request->degTitle);
        $degDet     = ucwords($request->degDet);
        $degCode    = $request->degCode;
        $degYears   = $request->degYears;

        $create = DegreeTb::create([
                        "user_id" => $user_id,
                        "M_Title" => $degTitle,
                        "Det1" => $degDet,
                        "DegCode" => $degCode,
                        "degYears" => $degYears
                    ]);

        Session::flash('success','Degree added successfully.');
        return redirect()->route('degreecsv');


    }

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
         $this->validate($request, [
            'DegCode' => 'required',
            'Det1' => 'required',
            'degYears' => 'required',
           
        ]);


        $update = DegreeTb::find($id);
        $update->DegCode = $request->DegCode;
        $update->Det1 =  ucwords($request->Det1);
        $update->degYears = $request->degYears;
        $update->save();  
        Session::flash('success','Degree updated successfully.');
        return redirect()->route('degreecsv');
    }


    public function degreedel($id)

     {  

        $delete = DegreeTb::find($id);
        $delete->delete();

        Session::flash('success' , 'Record has been deleted successfully');
        return redirect()->back();

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
}
