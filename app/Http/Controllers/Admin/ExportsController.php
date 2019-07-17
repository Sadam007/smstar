<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\StudentTb;
use App\Models\RollNoComDet;
use App\Models\RollNoTb;
use DB;

class ExportsController extends Controller
{
  

    public function exportStudents(){
        return view('backend.exports.studentExport');
    }

    public function exportStudentsProcess(Request $request){
        
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
                    $regno           = $importData[0];
                    $department_id   = $importData[1];
                    $session_id      = $importData[2];
                    $degree_id       = $importData[3];
                    $stdName         = $importData[4];
                    $stdfName        = $importData[5];
                    $dob             = $importData[6];
                    $domicile        = $importData[7];
                    $photo           = "C:\\fakepath\\amjadShahazad.jpg";
                    $address         = $importData[8];
                    $email           = $importData[9];
                    $contact         = $importData[10];
                    $password        = bcrypt("12345678");
                    
                    $create = StudentTb::create([
                                "regno" => $regno,
                                "department_id" => $department_id,
                                "session_id" => $session_id,
                                "degree_id" => $degree_id,
                                "stdName" => $stdName,
                                "stdfName" => $stdfName,
                                "dob" => $dob,
                                "domicile" => $domicile,
                                "photo" => $photo,
                                "address" => $address,
                                "email" => $email,
                                "contact" => $contact,
                                "password" => $password,
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

    public function exportRollnoComDets(){
        return view('backend.exports.rollNoComDetExport');

    }

    public function exportRollnoComDetsProcess(Request $request){
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
                    $rollno           = $importData[0];
                    $examcode   = $importData[1];
                    $subcode      = $importData[2];
                    $FicRollNo       = $importData[3];
                   
                    
                    $create = RollNoComDet::create([
                                "rollno" => $rollno,
                                "examcode" => $examcode,
                                "subcode" => $subcode,
                                "FicRollNo" => $FicRollNo,
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

    public function exportRollnos(){
        return view('backend.exports.rollNoExport');
    }

    public function exportRollnosProcess(Request $request){

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
                    $regno           = $importData[0];
                    $rollno   = $importData[1];
                    $examcode      = $importData[2];
                    $part       = $importData[3];
                    $ccode       = $importData[4];
                    $colcode       = $importData[5];
                   
                    
                    $create = RollNoTb::create([
                                "regno" => $regno,
                                "rollno" => $rollno,
                                "examcode" => $examcode,
                                "part" => $part,
                                "ccode" => $ccode,
                                "colcode" => $colcode,
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
   
    public function dbImportTxt(){
        return view('backend.imports.dbImportTxt');
    }

    public function dbImportTxtProcess(Request $request){
        $file = $request->file('txt_import');
        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath  = $file->getRealPath();
        $fileSize  = $file->getSize();
        $mimeType  = $file->getMimeType();
        $valid_extension = array("txt");
        $maxFileSize = 2097152; 

         if(in_array(strtolower($extension),$valid_extension)){

                $location = 'uploads';  
                $file->move($location,$filename);
                $filepath = public_path($location."/".$filename);
                
                $txt      =  file_get_contents($filepath);
                $queries  = explode(';', $txt);

                foreach($queries as $sql){
                   $netQuery = DB::statement($sql);
                
                }
                
                if ($netQuery) { 
                    unlink(public_path($location."/".$filename));
                    $arr = array(['Good' => true,'message' => 'Data has been successfully imported.'], 200);
                    echo json_encode($arr);
                }

          }
          else{
            return "something went wrong";
          }

    }

    public function dbExportTxt(){

    }
}
