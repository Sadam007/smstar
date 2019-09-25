<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\SessionTb;
use Auth;
use DB;
use Session;
class SessionsController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = DB::table('session_tbs')
                        ->join('users', 'users.id', '=', 'session_tbs.user_id')
                        ->select('session_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);
        return view('backend.sessions.sessioncsv')->with('sessions',$sessions);
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

     /* ---------------------------
        Loading CSV uploading file 
     */    
    public function sessioncsv(){
        
        return view('backend.sessions.sessioncsv');

    }

    /* ---------------------------
        Processing CSV uploading file 
     */ 
    public function sessioncsvprocess(Request $request){

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
                    $SeCode    = $importData[0];
                    $Session   = $importData[1];
                    $status    = $importData[2];
                    $startDate = $importData[3];
                    $EndDate   = $importData[4];
                    $user_id   = Auth::id();
                    $create = SessionTb::create([
                                "user_id" => $user_id,
                                "sessionCode" => $SeCode,
                                "session" => $Session,
                                "status" => $status,
                                "startDate" => $startDate,
                                "endDate" => $EndDate,
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


    public function singleSession(){
        return view('backend.sessions.single-session');
    }

    public function singleSessionProcess(Request $request){
        $this->validate($request, [
            'sessionFormat' => 'required',
            'sessYears' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);



        $user_id    = Auth::id();

        $sessStart  = $request->startDate;
        $sessEnd    = $request->endDate;

        $sessCodeStart  = explode('/', $sessStart);
        $sessCodeEnd    = explode('/', $sessEnd);

        $sessCodeStart  = $sessCodeStart[2];
        $sessCodeEnd    = $sessCodeEnd[2];

        $shortSessStart = substr($sessCodeStart, 2,2);
        $shortSessEnd   = substr($sessCodeEnd, 2,2);

        $sessionCode    = $shortSessStart.$shortSessEnd;
        $session        = $request->sessionFormat;
        $sessYears      = $request->sessYears;

        $startDate      = $request->startDate;
        $endDate        = $request->endDate;

    
        
        $create = SessionTb::create([
                        "user_id" => $user_id,
                        "sessionCode" => $sessionCode,
                        "session" => $session,
                        "status" => 0,
                        "sessYear" => $sessYears,
                        "startDate" => $startDate,
                        "endDate" => $endDate,
                    ]);

        Session::flash('success','Session added successfully.');
        return redirect()->route('sessioncsv');
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
        
        $this->validate($request, [
            'sessionCode' => 'required',
            'session' => 'required',
            'status' => 'required',
        ]);
        $update = SessionTb::find($id);
        $update->sessionCode = $request->sessionCode;
        $update->session = $request->session;
        $update->status = $request->status;
        $update->save();  
        Session::flash('success','Session updated successfully.');
        return redirect()->route('sessioncsv');
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
    public function sessiondel($id)

     {  

        $delete = SessionTb::find($id);
        $delete->delete();

        Session::flash('success' , 'Record has been deleted successfully');
        return redirect()->back();

     }

    public function sessiondel1($value='')
     {
         # code...
     }
}
