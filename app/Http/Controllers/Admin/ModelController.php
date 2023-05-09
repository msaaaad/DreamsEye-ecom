<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use Image;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $models = Actor::with('category')->get();
        return response()->json([
            'models'        =>$models
        ],200);
    }
    public function frontModel()
    {
        
        $models = Actor::where('banner_status',1)->with('category')->orderBy('id','DESC')->take(1)->first();
        return response()->json([
            'models'        =>$models
        ],200);
    }
    public function middleModel()
    {
        
        $middleModels = Actor::where('banner_status',0)->where('publication_status',1)->with('category')->orderBy('id','DESC')->take(2)->get();
        return response()->json([
            'middleModels'        =>$middleModels
        ],200);
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
        $file = explode(';',$request->model_image);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $fileName = date('ymdhms_').'.'.$fileExt;
        $request->validate([
            'category_id'       =>'required',
            'publication_status'=>'required',
            'model_image'       =>'required',
        ]);
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $success = Actor::create([
                'category_id'       =>$request->category_id,
                'publication_status'=>$request->publication_status,
                'model_image'       =>$fileName,
            ]);
            if ($success) {
               Image::make($request->model_image)->save(public_path('uploads/models/').$fileName);
            }
            return response()->json(['success'=>$success],200);
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
        $model = Actor::find($id);
        $fileName = $model->model_image;
        if($model->delete()){
            if(file_exists(public_path('uploads/models/'.$fileName))){
                unlink(public_path('uploads/models/'.$fileName));
            }
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);

    }
    public function Publish($id){
        $model=Actor::find($id);
        $model->publication_status=1;
            if($model->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function PublishBanner($id){
        $model=Actor::find($id);
        $model->banner_status=1;
            if($model->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $model=Actor::find($id);
        $model->publication_status=0;
            if($model->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function UnpublishBanner($id){
        $model=Actor::find($id);
        $model->banner_status=0;
            if($model->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
}
