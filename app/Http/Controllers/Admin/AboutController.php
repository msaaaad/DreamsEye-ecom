<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::orderBy('id','ASC')->take(1)->get();
        return response()->json(['abouts'=>$abouts],200);
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
        $request->validate([
            'about_us'          =>'required',
            'choice_us'         =>'required',
            'address'           =>'required',
            'publication_status'=>'required',
        ]);

        About::create([
            'about_us'          =>$request->about_us,
            'slug'          =>slugfy($request->about_us),
            'choice_us'         =>$request->choice_us,
            'address'           =>$request->address,
            'publication_status'=>$request->publication_status,
            'facebook_page'     =>$request->facebook_page,
            'facebook_group'    =>$request->facebook_group,
            'instagram'         =>$request->instagram,
            'twitter'           =>$request->twitter,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $about=About::where('slug',$slug)->first();
        return response()->json(['about'=>$about],200);
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
         $request->validate([
            'about_us'          =>'required',
            'choice_us'         =>'required',
            'address'           =>'required',
            'publication_status'=>'required',
        ]);

        $about = About::find($request->id);

        $about->about_us            =$request->about_us;
        $about->choice_us           =$request->choice_us;
        $about->address             =$request->address;
        $about->publication_status  =$request->publication_status;
        $about->facebook_page       =$request->facebook_page;
        $about->facebook_group      =$request->facebook_group;
        $about->instagram           =$request->instagram;
        $about->twitter             =$request->twitter;

        if ($about->save()) {
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Publish($id){
        $about=About::find($id);
        $about->publication_status=1;
            if($about->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $about=About::find($id);
        $about->publication_status=0;
            if($about->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }

    public function destroy($id)
    {
        
        $about = About::find($id);
        $about->delete();
    }
}
