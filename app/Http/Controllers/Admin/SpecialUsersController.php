<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\CollegeTb;
use App\Models\SpecialUserTb;
use App\TeacherTb;
use Auth;
use DB;
use Session;
class SpecialUsersController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialusers = DB::table('special_user_tbs')
                        ->join('users', 'users.id', '=', 'special_user_tbs.user_id')
                        ->select('special_user_tbs.*','users.id as userId','users.name as addedby')
                        ->orderBy('created_at','DESC')
                        ->paginate(10)->onEachSide(5);

        $colleges  =  CollegeTb::orderBy('id', 'ASC')->get();
        return view('backend.specialusers.create')->with(['colleges' => $colleges ,'specialusers'=>$specialusers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $deparment_id = $request->department;
        $username     = strtolower($request->username);
        $password     = $request->username . "@123";
        $create = SpecialUserTb::create([
            'user_id' => $user_id,
            'department_id' => $deparment_id,
            'username' => $username,
            'password' => bcrypt($password),
        ]);

        if ($create) {
           $arr = array(['Good' => true,'message' => 'College User has been created successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }


    }

    public function loginSpecialUser()
    {
        return view('front.specialusers.login');
    }


    public function specialUserAuth(Request $request)
    {
     $this->validate($request, [
        'username'=>'required',
        'password'=>'required'
    ]);
     $username = $request->username;
     $password = $request->password;
     $remember = $request->remember;



     if(Auth::guard('specialuser')->attempt(['username'=> $username, 'password'=> $password,'status' => 1], $remember))
        {
         
         return redirect()->route('sdashboard');
        }  else {
       
        Session::flash('warning' , 'Invalid Username or Password or your account is inactive');
        return redirect()->back();
        //return redirect()->back()->with('warning', 'Invalid Username or Password');
        }
    }

    public function logout()
    {
        Auth::guard('specialuser')->logout();

        //return redirect()->route('specialuser.logout'); 
        return redirect()->route('specialuser.login'); 
    }
     public function home()
          {
            return view('front.sdashboard');
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

     public function teachersList(){

        $user_id = Auth('specialuser')->user()->id; 
        $department_id = Auth('specialuser')->user()->department_id;

        $teachers = TeacherTb::where('department_id', $department_id)->paginate(10)->onEachSide(5);
        return view('front.colleges.teachers')->with('teachers',$teachers);
    }

    public function teacheractive(Request $request,$id)
    {
       
       $user_id = Auth('specialuser')->user()->id;
       $deparment_id = Auth('specialuser')->user()->department_id; 
       $active = TeacherTb::where('id', $id)->findOrFail($id);
       $active->is_active = 0;
       $result = $active->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }
     public function teacherinactive(Request $request,$id)
    {
       
       $user_id = Auth('specialuser')->user()->id;
       $deparment_id = Auth('specialuser')->user()->department_id; 
       $active = TeacherTb::where('id', $id)->findOrFail($id);
       $active->is_active = 1;
       $result = $active->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }

    public function userinactive(Request $request,$id)
    {
       
       $user_id = Auth::user()->id;

       $inactive = SpecialUserTb::where('user_id', $user_id)->findOrFail($id);
       $inactive->status = 1;
       $result = $inactive->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }


    public function useractive(Request $request,$id)
    {
       
    $user_id = Auth::user()->id;
       $active = SpecialUserTb::where('user_id', $user_id)->findOrFail($id);
       $active->status = 0;
       $result = $active->save();

       if ($result) {
           $arr = array(['Good' => true,'message' => 'User status has been changed successfully.'], 200);
            echo json_encode($arr);
        }
        else{
             return redirect()->back();
        }
    }


    public function specialuserProfile(){

        $user_id = Auth::user()->id;

        $colAdmin    = SpecialUserTb::find($user_id);

        return view('front.specialusers.profile')->with('colAdmin',$colAdmin);

    }

    public function specialuserProfileUpdate(Request $request){


        $specialuserName         = $request->specialuserName;
        $specialuserPassword     = $request->specialuserPassword;
        $specialuserNewPassword  = $request->specialuserNewPassword;

        $user_id = Auth::user()->id;

        $specialuser    = SpecialUserTb::find($user_id);
        $oldPass   = $specialuser->password;

        if (Hash::check($request->specialuserPassword, $specialuser->password)) { 
           $specialuser->fill([

            'password' => Hash::make($request->specialuserNewPassword)
            ])->save();

        $arr = array(['Good' => true,'message' => 'Profile Updated Successfully'], 200);
        echo json_encode($arr);

        }
        else{

            $arr = array(['Good' => true,'message' => 'Current Password is not matched'], 200);
                echo json_encode($arr);
        }

    }
}
