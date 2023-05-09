<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Product;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return response()->json(['subcategories'=>$subcategories],200);
    }
    public function ActiveSubCategory()
    {
        $subCategories = SubCategory::where('publication_status',1)->with('category','supersubcategory')->get();
        return response()->json(['subCategories'=>$subCategories],200);
    }
    public function ActiveFrontSubCategory($category)
    {
        $subCategories = SubCategory::find($category)->where('category_id',$category)->where('publication_status',1)->with('category','supersubcategory')->get();
        return response()->json(['subCategories'=>$subCategories],200);
    }
    public function getSubCat($category)
    {
        $subCategories = SubCategory::where('category_id',$category)->get();
        return response()->json(['subCategories'=>$subCategories],200);
    }

    public function getSubCatProduct($id){
        $subCategoryProducts = Product::where('subcategory_id',$id)
            ->where('publication_status',1)
            ->with('subcategory')
            ->get();
            foreach($subCategoryProducts as $product){
            $product->product_image = json_decode($product->product_image);
            }
            return response()->json(['subCategoryProducts'=>$subCategoryProducts],200);
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
            'subcategory_name'      =>'required',
            'publication_status'    =>'required',
        ]);
        SubCategory::create([
            'category_id'           =>$request->category_id,
            'subcategory_name'      =>$request->subcategory_name,
            'slug'                  =>slugfy($request->subcategory_name),
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
        $subcategory=SubCategory::where('slug',$slug)->first();
        return response()->json(['subcategory'=>$subcategory],200);
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
            'subcategory_name'      =>'required',
            'publication_status'    =>'required',
        ]);
        $subcategory = SubCategory::find($request->id);
        $subcategory->category_id       =$request->category_id;
        $subcategory->subcategory_name  =$request->subcategory_name;
        $subcategory->subcategory_name  =slugfy($request->subcategory_name);
        $subcategory->publication_status=$request->publication_status;
        if ($subcategory->save()) {
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
        $subcategory=SubCategory::find($id);
        $subcategory->publication_status=1;
            if($subcategory->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $subcategory=SubCategory::find($id);
        $subcategory->publication_status=0;
            if($subcategory->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
    }
}
