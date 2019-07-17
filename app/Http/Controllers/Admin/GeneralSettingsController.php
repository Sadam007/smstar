<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\DistrictTb;
use App\Models\CertificateTb;
use Auth;
use DB;
use Session;

class GeneralSettingsController extends Controller
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

    public function createDistrict(){
        return view('backend.general.create-district');
    }

    public function districtProcess(Request $request){

        $user_id     = Auth::id();
        $district = $request->district;
        
        $create = DistrictTb::create([
            'user_id' => $user_id,
            'name'    => $district
        ]);

        if ($create) { 
            
            $arr = array(['Good' => true,'message' => 'District added successfully.'], 200);
                    echo json_encode($arr);
        }
        else{
            return response()->json(['Bad' => true,'message' => 'District can not be added'], 200);
        }
    }

    public function createCertificate(){
        return view('backend.general.create-certificate');
    }

    public function certificateProcess(Request $request){

        $user_id     = Auth::id();
        $certificate = $request->certificate;
        
        $create = CertificateTb::create([
            'user_id' => $user_id,
            'name'    => $certificate
        ]);

        if ($create) { 
            
            $arr = array(['Good' => true,'message' => 'Certificate added successfully.'], 200);
                    echo json_encode($arr);
        }
        else{
            return response()->json(['Bad' => true,'message' => 'Certificate can not be added'], 200);
        }
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
}
