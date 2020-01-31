<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NewsTb;

use DB;
use Image;
use Auth;
use Session;

class NewsController extends Controller
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
        $news = DB::table('news_tbs')
            ->join('users', 'users.id', '=', 'news_tbs.user_id')
            ->select('news_tbs.*','users.id as userId','users.name as addedby')
            ->orderBy('created_at','DESC')
            ->paginate(10)->onEachSide(5);
        return view('front.generals.news.create')->with(['news'=>$news]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newsProcess(Request $request)
    {
        $this->validate($request,[
            'news_title'=>'required',
            'newsBody'=>'required',
            'is_active'=>'required',
            'newsAttachments.*' => 'mimes:jpeg,png,jpg,pdf,PDF,JPG,JPEG,PNG|max:5120'
        ]);

        $user_id = Auth::id();
        $news_title    = $request->news_title;
        $newsBody      = $request->newsBody;
        $is_active     = $request->is_active;

        if ($is_active === "on") {
            $is_active = 1;
          }
          else{
              $is_active = 0;
        }

        $filesArr = array();

        if ($request->hasFile('newsAttachments')) {

        foreach($request->file('newsAttachments') as $file){

        	$filenamewithextension = str_replace(' ','-', $file->getClientOriginalName());
        	$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        	$extension = $file->getClientOriginalExtension();
        	$filenametostore = $filename.'_'.uniqid().'.'.$extension;

        	$destinationPath = public_path('/documents/news');

        	$file->move($destinationPath,$filenametostore);
        	$filesArr[]=$filenametostore;

        } 
    	}

    	$news  = NewsTb::create([
        					'title' => $news_title,
        					'body'  => $newsBody,
        					'attachment' => json_encode($filesArr),
        					'is_active' => $is_active,
        					'user_id' => $user_id,
        				 ]);

        if ($news) {
        	Session::flash('success','News added successfully');
       		return redirect()->back();
        }
        else{
        	Session::flash('error','Something went wrong');
       		return redirect()->back();
        }
    }

    public function editNewsProcess(Request $request){

      $this->validate($request,[
            'editNewsTitle'=>'required',
            'editNewsBody'=>'required',
            'newsStatus'=>'required',
            'editNewsAttachments.*' => 'mimes:jpeg,png,jpg,pdf,PDF,JPG,JPEG,PNG|max:5120'
        ]);

      $editNewsId     = $request->editNewsId;
      $editNewsTitle  = $request->editNewsTitle;
      $editNewsBody   = $request->editNewsBody;
      $editNewsAttachments   = $request->editNewsAttachments;
      $newsStatus     = $request->newsStatus;
      $user_id = Auth::id();

      //dd($request->all());

      if ($newsStatus === "on") {
            $newsStatus = 1;
      }
      else{
          $newsStatus = 0;
      }

      $filesArr = array();

        if ($request->hasFile('editNewsAttachments')) {

          foreach($request->file('editNewsAttachments') as $file){

            $filenamewithextension = str_replace(' ','-',$file->getClientOriginalName());
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            $destinationPath = public_path('/documents/news');

            $file->move($destinationPath,$filenametostore);
            $filesArr[]=$filenametostore;
          }

          $deleteFiles  = NewsTb::findOrFail($editNewsId);

          $attachedFiles  = json_decode($deleteFiles->attachment);

          foreach ($attachedFiles as $file) {
            $deletePath = public_path('/documents/news');

            unlink($deletePath.'/'.$file);
          }
          $findNews             = NewsTb::findOrFail($editNewsId);
          $findNews->title      = $editNewsTitle;
          $findNews->body       = $editNewsBody;
          $findNews->attachment = json_encode($filesArr);
          $findNews->is_active  = $newsStatus;
          $findNews->user_id    = $user_id;
          $saved  = $findNews->save();
        }
       else{
          $oldFiles = NewsTb::findOrFail($editNewsId);

          $oldFiles->title      = $editNewsTitle;
          $oldFiles->body       = $editNewsBody;
          $oldFiles->attachment = $oldFiles->attachment;
          $oldFiles->is_active  = $newsStatus;
          $oldFiles->user_id    = $user_id;
          $saved  = $oldFiles->save();
        } 
      if ($saved) {
        Session::flash('success','News updated successfully');
        return redirect()->route('add.news');
      }
        else{
          Session::flash('error','Something went wrong');
          return redirect()->back();
      }

      
      
    }

    public function showNews($id){
    	$news  =  DB::table('news_tbs')
    								->join('users','users.id','=','news_tbs.user_id')
    								->select('news_tbs.*','users.id','users.name AS author')
    								->where('news_tbs.news_id',$id)
    								->first();
									
    	return view('front.generals.news.show-news')->with('news',$news);
    }
    public function frontAllNews(){
    		$allNews  =  DB::table('news_tbs')
    								->join('users','users.id','=','news_tbs.user_id')
    								->select('news_tbs.*','users.id','users.name AS author')
                                    ->where(['is_active'=>1,'is_archieve'=>0])
    								->orderBy('created_at','DESC')
                    ->paginate(8)->onEachSide(5);

        $allNews1  =  DB::table('news_tbs')
                    ->join('users','users.id','=','news_tbs.user_id')
                    ->select('news_tbs.*','users.id','users.name AS author')
                                    ->where(['is_active'=>1,'is_archieve'=>1])
                    ->orderBy('created_at','DESC')
                    ->paginate(8)->onEachSide(5);                            

        return view('front.generals.news.all-news')->with(['allNews'=>$allNews,'allNews1'=>$allNews1]);        
    }

    public function frontShowNews($id){
    	 $news  = NewsTb::where(['news_id'=>$id,'is_active'=>1])->findOrFail($id);

        return view('front.generals.news.show')->with('news',$news);
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
          $deleteFiles  = NewsTb::findOrFail($id);

          $attachedFiles  = json_decode($deleteFiles->attachment);
          foreach ($attachedFiles as $file) {
            $destinationPath = public_path('/documents/news');
            unlink($destinationPath.'/'.$file);
          }

          $deleted = $deleteFiles->delete();

          if ($deleted) {
            Session::flash('success','News deleted successfully');
            return redirect()->route('add.news');
          }
          else{
            Session::flash('error','Something went wrong');
            return redirect()->back();
          }
    }

    public function newsChangeStatus(Request $request){

    	$switchId   = $request->switchId;
    	$switchVal  = $request->switchVal;
  
    	if($switchVal == 1){
    		 $switchVal  = 0;
    	}
    	else{
    			$switchVal= 1;
    	}

    	$status = NewsTb::where('news_id', $switchId)->findOrFail($switchId);
    	$status->is_active = $switchVal;
    	$result = $status->save();

    	if($result)
    	{
      	$arr = array(['Good' => true,'message' => 'News status updated successfully.'], 200);
      	echo json_encode($arr);
    	}
    	else
    	{
      	return redirect()->back();
    	}

    }

    public function newsChangeStatusArchieves(Request $request){
      $switchId   = $request->switchId;
      $switchVal  = $request->switchVal;
  
      if($switchVal == 1){
         $switchVal  = 0;
      }
      else{
          $switchVal= 1;
      }

      $status = NewsTb::where('news_id', $switchId)->findOrFail($switchId);
      $status->is_archieve = $switchVal;
      $result = $status->save();

      if($result)
      {
        $arr = array(['Good' => true,'message' => 'News status changed as archieved.'], 200);
        echo json_encode($arr);
      }
      else
      {
        return redirect()->back();
      }
    }
}
