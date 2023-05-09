<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Helpers\Validator;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories'        =>$categories
        ],200);
    }
    public function getActiveCategory()
    {
        $categories = Category::where('publication_status',1)->with('supersubcategory','subcategory','subcategory.supersubcategory')->orderBy('category_name')->get();
        return response()->json([
            'categories'        =>$categories
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

        $file = explode(';',$request->category_image);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $slug = slugfy($request->category_name);
        $fileName = $slug.'.'.$fileExt;
        $mimes = ['jpeg','png','jpg','gif','svg'];
        $request->validate([
            'category_name'     =>'required|min:3|max:20|unique:categories',
            'publication_status'=>'required',
            'category_image'    =>'required',
        ]);
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $success = Category::create([
                'category_name'     =>$request->category_name,
                'slug'              =>$slug,
                'publication_status'=>$request->publication_status,
                'category_image'    =>$fileName,
            ]);
            if ($success) {
               Image::make($request->category_image)->save(public_path('uploads/category/').$fileName);
            }
            return response()->json(['success'=>$success],200);
        }
        else{
            return response()->json(['error'=>'error'],500);
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
        $category=Category::where('slug',$slug)->first();
        return response()->json(['category'=>$category],200);

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
        $slug = slugfy($request->category_name);
        $file = explode(';',$request->category_image);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $fileName = $slug.'.'.$fileExt;
        $request->validate([
            'category_name'     =>'required|min:3|max:20',
            'publication_status'=>'required',
            'category_image'    =>'required',
        ]);
        $category=Category::find($request->id);
        
            $category->category_name     =$request->category_name;
            $category->slug              =$slug;
            $category->publication_status=$request->publication_status;

        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            
            if($request->category_image !== $category->category_image){

        $category->category_image = $fileName;
           Image::make($request->category_image)->save(public_path('uploads/category/').$fileName);
        }
    }
    $success = $category->save();

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
        $category = Category::find($id);
        $fileName = $category->category_image;
        if($category->delete()){
            if(file_exists(public_path('uploads/category/'.$fileName))){
                unlink(public_path('uploads/category/'.$fileName));
                // $subcategory = SubCategory::where('category_id',$id)->get();
                // SubCategory::destroy($subcategory->toArray());
            }
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);

    }
    public function Publish($id){
        $category=Category::find($id);
        $category->publication_status=1;
            if($category->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $category=Category::find($id);
        $category->publication_status=0;
            if($category->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function relatedProduct($id){
        $categoryProducts=Product::find($id)
            ->where('publication_status',1)
            ->get();
            foreach($categoryProducts as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['categoryProducts'=>$categoryProducts],200);
    }
    public function relatedBoostProduct($id){
        $categoryProducts=Product::find($id)
            ->where('publication_status',1)
            ->where('boost_status',1)
            ->get();
            foreach($categoryProducts as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['categoryProducts'=>$categoryProducts],200);
    }
}
