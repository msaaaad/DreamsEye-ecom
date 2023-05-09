<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json([
            'brands'        =>$brands,
        ],200);
    }
    public function getActiveBrand()
    {
        $brands = Brand::where('publication_status',1)->get();
        return response()->json([
            'brands'        =>$brands,
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
        $request->validate([
            'brand_name'        =>'required|min:3|unique:brands',
            'publication_status'=>'required',
        ]);
        Brand::create([
            'brand_name'        =>$request->brand_name,
            'slug'              =>slugfy($request->brand_name),
            'publication_status'=>$request->publication_status,
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
        $brand=Brand::where('slug',$slug)->first();
        return response()->json(['brand'=>$brand],200);
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
            'brand_name'        =>'required|min:3|unique:brands',
            'publication_status'=>'required',
        ]);
        $brand=Brand::find($request->id);
        $brand->brand_name        =$request->brand_name;
        $brand->slug              =slugfy($request->brand_name);
        $brand->publication_status=$request->publication_status;
            if($brand->save()){
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
    public function destroy($id)
    {
        $brand=Brand::find($id);
        $brand->delete();
    }
    public function Publish($id){
        $brand=Brand::find($id);
        $brand->publication_status=1;
            if($brand->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $brand=Brand::find($id);
        $brand->publication_status=0;
            if($brand->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
}
