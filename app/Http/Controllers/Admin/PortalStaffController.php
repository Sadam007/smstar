<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PortalStaffModelTb;

use DB;
use Image;
use Auth;
use Session;

class PortalStaffController extends Controller
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
        $portalUsers = DB::table('portal_staff_model_tbs')
            ->join('users', 'users.id', '=', 'portal_staff_model_tbs.user_id')
            ->select('portal_staff_model_tbs.*','users.id as userId','users.name as addedby')
            ->orderBy('created_at','DESC')
            ->paginate(10)->onEachSide(5);
        
        return view('backend.portalstaffs.create')->with(['portalUsers'=>$portalUsers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff_title        =  ucwords($request->staff_title);
        $staff_name         =  ucwords($request->staff_name);
        $staff_designation  =  ucwords($request->staff_designation);
        $staff_email        = $request->staff_email;
        $staff_message      =  $request->staff_message;
        $avatar             =  $request->avatar;
        $is_active          =  $request->is_active;
        $user_id = Auth::id();

        if ($is_active === "on") {
          $is_active = 1;
        }
        else{
            $is_active = 0;
        }

        if ($request->hasFile('avatar')) {
          $input['imagename'] = time().'.'.$avatar->getClientOriginalExtension();
     
          $destinationPath = public_path('/backend');

          $img = Image::make($avatar->getRealPath());
          $img->resize(100, 100, function ($constraint) {
               $constraint->aspectRatio();
          })->save($destinationPath.'/'.$input['imagename']);
            
          $finalImage  = $avatar->move($destinationPath, $input['imagename']);

          $type = pathinfo($finalImage, PATHINFO_EXTENSION);

          $data = file_get_contents($finalImage); 

          $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        $create  = PortalStaffModelTb::create([
                  'title' => $staff_title,
                  'name'  => $staff_name,
                  'email' => $staff_email,
                  'designation' => $staff_designation,
                  'message' => $staff_message,
                  'avatar' => $base64,
                  'is_active' => $is_active,
                  'user_id' => $user_id,
                 ]);

        if ($create) {
          Session::flash('success','Staff added successfully');
          return redirect()->back();
        }
        else{
          Session::flash('error','Something went wrong');
          return redirect()->back();
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
        $staffdetails = PortalStaffModelTb::findOrFail($id)->get();

        return view('backend.portalstaffs.show')->with(['staffdetails'=>$staffdetails]);
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

    public function editPortalStaffProcess(Request $request){

       $this->validate($request,[
          'edit_avatar' => 'mimes:jpeg,png,jpg,pdf,PDF,JPG,JPEG,PNG|max:1024'
        ]);

        $edit_staff_title       = ucwords($request->edit_staff_title);
        $edit_staff_name        = ucwords($request->edit_staff_name);
        $edit_staff_designation = ucwords($request->edit_staff_designation);
        $edit_staff_message     = $request->edit_staff_message;
        $edit_staff_email       = $request->edit_staff_email;
        $avatar                 = $request->edit_avatar;
        $is_active              = $request->edit_is_active;
        $edit_staffId           = $request->edit_staffId;
        $user_id = Auth::id();
       // dd($request->all());
        if ($is_active === "on") {
          $is_active = 1;
        }
        else{
            $is_active = 0;
        }

        if ($request->hasFile('edit_avatar')) {

          $input['imagename'] = time().'.'.$avatar->getClientOriginalExtension();
     
          $destinationPath = public_path('/backend');

          $img = Image::make($avatar->getRealPath());
          $img->resize(100, 100, function ($constraint) {
               $constraint->aspectRatio();
          })->save($destinationPath.'/'.$input['imagename']);
            
          $finalImage  = $avatar->move($destinationPath, $input['imagename']);

          $type = pathinfo($finalImage, PATHINFO_EXTENSION);

          $data = file_get_contents($finalImage); 

          $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


          $findStaff  =  PortalStaffModelTb::findOrFail($edit_staffId);


          $findStaff->title = $edit_staff_title;
          $findStaff->name  = $edit_staff_name;
          $findStaff->email  = $edit_staff_email;
          $findStaff->designation  = $edit_staff_designation;
          $findStaff->message  = $edit_staff_message;
          $findStaff->avatar  = $base64;
          $findStaff->is_active  = $is_active;
          $findStaff->user_id  = $user_id;
          $saved  = $findStaff->save();
          unlink($finalImage);

        }
        else{
            $oldRecord  =  PortalStaffModelTb::findOrFail($edit_staffId);
            $oldRecord->title = $edit_staff_title;
            $oldRecord->name = $edit_staff_name;
            $oldRecord->email = $edit_staff_email;
            $oldRecord->designation = $edit_staff_designation;
            $oldRecord->message = $edit_staff_message;
            $oldRecord->avatar = $oldRecord->avatar;
            $oldRecord->is_active = $is_active;
            $oldRecord->user_id = $user_id;
            $saved  = $oldRecord->save();
        }
        if ($saved) {
        Session::flash('success','Record updated successfully');
        return redirect()->route('add.portal-staff');
      }
        else{
          Session::flash('error','Something went wrong');
          return redirect()->back();
      }
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
        $delete   =  PortalStaffModelTb::findOrFail($id);

        $deleted = $delete->delete();

          if ($deleted) {
            Session::flash('success','Staff deleted successfully');
            return redirect()->route('add.portal-staff');
          }
          else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
          }
    }

    public function portalStaffChangeStatus(Request $request){
      $switchId   = $request->switchId;
      $switchVal  = $request->switchVal;
  
      if($switchVal == 1){
         $switchVal  = 0;
      }
      else{
          $switchVal= 1;
      }

      $status = PortalStaffModelTb::where('pstaff_id', $switchId)->findOrFail($switchId);
      $status->is_active = $switchVal;
      $result = $status->save();

      if($result)
      {
        $arr = array(['Good' => true,'message' => 'Staff status updated successfully.'], 200);
        echo json_encode($arr);
      }
      else
      {
        return redirect()->back();
      }
    }
}
