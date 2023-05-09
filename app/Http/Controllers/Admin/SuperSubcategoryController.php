<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UltraSubCat;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class SuperSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $superSubCats=DB::table('ultra_sub_cats')
        //         ->join('categories','ultra_sub_cats.category_id','=','categories.id')
        //         ->join('sub_categories','ultra_sub_cats.sub_category_id','=','sub_categories.id')
        //         ->select('ultra_sub_cats.*','categories.id','categories.category_name','sub_categories.id','sub_categories.subcategory_name')
        //         ->get();
        $superSubCats = UltraSubCat::with('category','subcategory')->get();
        return response()->json(['superSubCats'=>$superSubCats],200);
    }
    public function getSuperSubCatProduct($id){
        $superSubCategoryProducts = Product::where('ultra_sub_category_id',$id)
            ->where('publication_status',1)
            ->with('ultrasubcategory')
            ->get();
            foreach($superSubCategoryProducts as $product){
            $product->product_image = json_decode($product->product_image);
            }
            return response()->json(['superSubCategoryProducts'=>$superSubCategoryProducts],200);
    }
    public function superSubcats($subCategory)
    {
        $superSubcats = UltraSubCat::where('sub_category_id',$subCategory)->get();
        return response()->json(['superSubcats'=>$superSubcats],200);
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
            'category_id'           =>'required',
            'sub_category_id'       =>'required',
            'ultra_sub_category_name'=>'required',
            'publication_status'    =>'required',
        ]);
        UltraSubCat::create([
            'category_id'           =>$request->category_id,
            'sub_category_id'       =>$request->sub_category_id,
            'ultra_sub_category_name'=>$request->ultra_sub_category_name,
            'slug'                  =>slugfy($request->ultra_sub_category_name),
            'publication_status'    =>$request->publication_status,
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
        $supersubcategory=UltraSubCat::where('slug',$slug)->first();
        return response()->json(['supersubcategory'=>$supersubcategory],200);
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
            'category_id'           =>'required',
            'sub_category_id'       =>'required',
            'ultra_sub_category_name'=>'required',
            'publication_status'    =>'required',
        ]);
        $supersubcategory = UltraSubCat::find($request->id);
        $supersubcategory->category_id      =$request->category_id;
        $supersubcategory->sub_category_id  =$request->sub_category_id;
        $supersubcategory->ultra_sub_category_name=$request->ultra_sub_category_name;
        $supersubcategory->publication_status=$request->publication_status;
        if ($supersubcategory->save()) {
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
        $superSubCat=UltraSubCat::find($id);
        $superSubCat->publication_status=1;
            if($superSubCat->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $superSubCat=UltraSubCat::find($id);
        $superSubCat->publication_status=0;
            if($superSubCat->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function destroy($id)
    {
        $superSubCat = UltraSubCat::find($id);
        $superSubCat->delete();
    }

    public function ActiveFrontSuperSubCategory($subcategory){
        $SuperSubCategories = UltraSubCat::where('sub_category_id',$subcategory)->get();
        return response()->json(['SuperSubCategories'=>$SuperSubCategories],200);
    }
}
