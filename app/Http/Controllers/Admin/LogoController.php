<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Image;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::all();
        return response()->json([
            'logos'        =>$logos
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
        $file = explode(';',$request->logo_image);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $fileName = date('ymdhms_').'.'.$fileExt;
        $request->validate([
            
            'logo_image'       =>'required',
        ]);
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $success = Logo::create([
                'publication_status'=>$request->publication_status,
                'logo_image'       =>$fileName,
            ]);
            if ($success) {
               Image::make($request->logo_image)->save(public_path('uploads/logo/').$fileName);
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
        $logo=Logo::find($id)->first();
        return response()->json(['logo'=>$logo],200);

        
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
    public function update(Request $request)
    {
       $success = false;
        $request->validate([
            
            'logo_image'       =>'required',
        ]);
        $logo=Logo::find($request->id);
            if($request->logo_image !== $logo->logo_image){
        $file = explode(';',$request->logo_image);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $fileName = date('ymdhms_').'.'.$fileExt;
        $logo->logo_image = $fileName;

           Image::make($request->logo_image)->save(public_path('uploads/logo/').$fileName);
            }
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $success = $logo->save();

                return response()->json(['success'=>$success],200);
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
        $logo = Logo::find($id);
        $fileName = $logo->logo_image;
        if($logo->delete()){
            if(file_exists(public_path('uploads/logo/'.$fileName))){
                unlink(public_path('uploads/logo/'.$fileName));
            }
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);

    }
    public function Publish($id){
        $logo=Logo::find($id);
        $logo->publication_status=1;
            if($logo->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $logo=Logo::find($id);
        $logo->publication_status=0;
            if($logo->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
}
