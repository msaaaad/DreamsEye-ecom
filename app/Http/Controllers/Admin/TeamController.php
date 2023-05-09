<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Image;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return response()->json(['teams'=>$teams],200);
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
        $file = explode(';',$request->profile_picture);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $slug = slugfy($request->member_name);
        $fileName = $slug.'.'.$fileExt;

        $request->validate([
            'member_name'           =>'required',
            'designation'           =>'required',
            'email_address'         =>'required',
            'address'               =>'required',
            'publication_status'    =>'required',
            'profile_picture'     =>'required',
        ]);
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $success = Team::create([
                'member_name'           =>$request->member_name,
                'slug'                  =>$slug,
                'designation'           =>$request->designation,
                'mobile_number'         =>$request->mobile_number,
                'email_address'         =>$request->email_address,
                'address'               =>$request->address,
                'facebook_profile'      =>$request->facebook_profile,
                'instagram'             =>$request->instagram,
                'twitter'               =>$request->twitter,
                'publication_status'    =>$request->publication_status,
                'profile_picture'       =>$fileName,
            ]);
            if ($success) {
               Image::make($request->profile_picture)->save(public_path('uploads/team/').$fileName);
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
    public function show($slug)
    {
        $team=Team::where('slug',$slug)->first();
        return response()->json(['team'=>$team],200);
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
        $slug = slugfy($request->member_name);
        
        $request->validate([
            'member_name'           =>'required',
            'designation'           =>'required',
            'email_address'         =>'required',
            'address'               =>'required',
            'publication_status'    =>'required',
            'profile_picture.*'     =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $team = Team::find($request->id);


        $team->member_name          =$request->member_name;
        $team->designation          =$request->designation;
        $team->mobile_number        =$request->mobile_number;
        $team->email_address        =$request->email_address;
        $team->address              =$request->address;
        $team->facebook_profile     =$request->facebook_profile;
        $team->instagram            =$request->instagram;
        $team->twitter              =$request->twitter;
        $team->slug                 =$slug;


        if($request->profile_picture !== $team->profile_picture){

        $file = explode(';',$request->profile_picture);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $fileName = $slug.'.'.$fileExt;
        $team->profile_picture = $fileName;
           Image::make($request->profile_picture)->save(public_path('uploads/team/').$fileName);
    }
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
        $success = $team->save();

        return response()->json(['success'=>$success],200);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Publish($id){
        $team=Team::find($id);
        $team->publication_status=1;
            if($team->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $team=Team::find($id);
        $team->publication_status=0;
            if($team->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }

    public function destroy($id)
    {
        $team = Team::find($id);
        $fileName = $team->profile_picture;
        if($team->delete()){
            if(file_exists(public_path('uploads/team/'.$fileName))){
                unlink(public_path('uploads/team/'.$fileName));
            }
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);
    }
}
