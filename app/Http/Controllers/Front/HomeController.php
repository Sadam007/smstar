<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SliderTb;
use App\Models\NewsTb;
use App\Models\PortalStaffModelTb;

use DB;
use Image;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Main Page.
     */
    public function index()
    {
        $slides  = SliderTb::where('is_active','=',1)
        			     ->orderBy('created_at', 'DESC')
        			     ->get();

        $news  = NewsTb::limit(10)
                   ->where(['is_active'=>1,'is_archieve'=>0])
                   ->orderBy('created_at', 'DESC')
                   ->get();  

        $controller  = PortalStaffModelTb::where(['designation'=>'Controller','is_active'=>1])
                                            ->get();  

        return view('front.index')->with(['slides'=>$slides,'news'=>$news,'controller'=>$controller]);
    }

    public function controllerDetails(){
      $controller  = PortalStaffModelTb::where(['designation'=>'Controller','is_active'=>1])
                                            ->get();  
       return view('front.controller-details')->with('controller',$controller);                                     
    }

    public function frontShowSlides($id){
      
        $slide  = SliderTb::where(['id'=>$id,'is_active'=>1])->findOrFail($id);

        return view('front.slide-show')->with('slide',$slide);
    }

    public function users()
    {
        return view('front.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSliderImages()
    {
    		$sliderImages = DB::table('slider_tbs')
		    ->join('users', 'users.id', '=', 'slider_tbs.user_id')
		    ->select('slider_tbs.*','users.id as userId','users.name as addedby')
		    ->orderBy('created_at','DESC')
		    ->paginate(10)->onEachSide(5);

        return view('front.generals.slider.add-slider')->with(['sliderImages'=>$sliderImages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSliderImagesProcess(Request $request)
    {
       //dd($request->all());

    	$user_id = Auth::id();
   
      $caption      = $request->caption;
      $sliderBody   = $request->sliderBody;
      $sliderLink   = $request->sliderLink;
      $sliderImage  = $request->sliderImage;
      $is_active    = $request->is_active;

      if ($is_active === "on") {
      		$is_active = 1;
      }
      else{
      	  $is_active = 0;
      }


      $input['imagename'] = time().'.'.$sliderImage->getClientOriginalExtension();
     
      $destinationPath = public_path('/backend');

      $img = Image::make($sliderImage->getRealPath());
      $img->resize(100, 100, function ($constraint) {
           $constraint->aspectRatio();
      })->save($destinationPath.'/'.$input['imagename']);
        
      $finalImage  = $sliderImage->move($destinationPath, $input['imagename']);

      $type = pathinfo($finalImage, PATHINFO_EXTENSION);

      $data = file_get_contents($finalImage); 

      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		  $create  = SliderTb::create([
		  						'caption'   => $caption,
		  						'body'      =>  $sliderBody,
		  						'link'      => $sliderLink,
		  						'img'       => $base64,
		  						'is_active' => $is_active,
		  						'user_id'   => $user_id,
		  					 ]);

		  if ($create) {
		  		
		  		Session::flash("success","Slider added successfully");
		  		unlink($finalImage);
		  		return redirect()->back();
		  }
		  else
		  {

		  		Session::flash("error","Something went wrong");
		  		return redirect()->back();
		  }
  	
   
        
    }

    public function editSliderProcess(Request $request){
      //dd($request->all());

      $editSliderTitle   = $request->editSliderTitle;
      $editSliderBody    = $request->editSliderBody;
      $editSliderLink    = $request->editSliderLink;
      $is_active  = $request->editSliderStatus;
      $avatar  = $request->editiSliderImage;
      $editSliderId      = $request->editSliderId;
      $user_id = Auth::id();

      if ($is_active === "on") {
          $is_active = 1;
      }
      else{
          $is_active = 0;
      }

      if ($request->hasFile('editiSliderImage')) {

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


          $findStaff  =  SliderTb::findOrFail($editSliderId);


          $findStaff->caption = $editSliderTitle;
          $findStaff->body  = $editSliderBody;
          $findStaff->link  = $editSliderLink;
          $findStaff->img  = $base64;
          $findStaff->is_active  = $is_active;
          $findStaff->user_id  = $user_id;
          $saved  = $findStaff->save();
          unlink($finalImage);

        }
        else{
            $oldRecord  =  SliderTb::findOrFail($editSliderId);
            $oldRecord->caption = $editSliderTitle;
            $oldRecord->body = $editSliderBody;
            $oldRecord->link = $editSliderLink;
            $oldRecord->img = $oldRecord->img;
            $oldRecord->is_active = $is_active;
            $oldRecord->user_id = $user_id;
            $saved  = $oldRecord->save();
        }
        if ($saved) {
          
          Session::flash('success','Slider updated successfully');
          return redirect()->route('add.slider-images');
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
    public function sliderShow($id)
    {
    	
    	$sliderImage  =  DB::table('slider_tbs')
    												->join('users','users.id','=','slider_tbs.user_id')
    												->select('slider_tbs.*','users.id','users.name AS author')
    												->where('slider_tbs.id',$id)
    												->first();

    	return view('front.generals.slider.show-slider')->with('sliderImage',$sliderImage);
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
        $delete   =  SliderTb::findOrFail($id);

        $deleted = $delete->delete();

          if ($deleted) {
            Session::flash('success','Slider deleted successfully');
            return redirect()->route('add.slider-images');
          }
          else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
          }    }

    public function slideChangeStatus(Request $request){

    	$switchId   = $request->switchId;
    	$switchVal  = $request->switchVal;
  
    	if($switchVal == 1){
    		 $switchVal  = 0;
    	}
    	else{
    			$switchVal= 1;
    	}

    	$status = SliderTb::where('id', $switchId)->findOrFail($switchId);
    	$status->is_active = $switchVal;
    	$result = $status->save();

    	if($result)
    	{
      	$arr = array(['Good' => true,'message' => 'Slide status updated successfully.'], 200);
      	echo json_encode($arr);
    	}
    	else
    	{
      	return redirect()->back();
    	}

    }

    public function sliderSearch(Request $request){
      $searchVal  = $request->searchVal;
      dd($searchVal);
    }

    public function about(){
      dd("hello");
    }


}
