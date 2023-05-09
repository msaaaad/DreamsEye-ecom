<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('ultrasubcategory','subcategory','category')->where('user_name','!=','Admin')->orderBy('id','DESC')->paginate(8);
        foreach($products as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['products'=>$products],200);
    }

    public function productName($slug){
        $pro = Product::where('slug',$slug)->first();
        $product = $pro->product_name;
        $productId = $pro->id;
        return response()->json(['product'=>$product,'productId'=>$productId],200);
    }
    public function myIndex()
    {
        $products = Product::where('user_name','Admin')->with('ultrasubcategory','subcategory','category')->orderBy('id','DESC')->paginate(8);
        foreach($products as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['products'=>$products],200);
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

        // return $images;
        // exit;
        // $uploadedFiles = $request->product_image;

        // foreach ($uploadedFiles as $file) {
        //     $file->store('dummy');
        // }
        // return response()->json(['status'=>'success'],200);
        // exit;
        $request->validate([
            'category_id'          =>'required',
            'subcategory_id'       =>'required',
            'product_name'         =>'required',
            'product_price_regular'=>'required',
            'product_quantity'     =>'required',
            'short_description'    =>'required',
            'product_image.*'      =>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'publication_status'   =>'required',
        ]);

        $images=[];
        $slug       = slugfy($request->product_name);
        
        if($request->hasFile('product_image')){
            $i=0;
            foreach($request->file('product_image')as $file){
        $file_ext = $file->getClientOriginalExtension();
        $file_name = $slug.$i.'.'.$file_ext;
        Image::make($file)->resize(400,250)->save(public_path('uploads/products/').$file_name);
        // $file->move(public_path('uploads/products/').$file_name)->resize(500,350);
        $images[] = $file_name;  
        $i++;       
            }
        } 
        
            $success = Product::create([
            'category_id'           =>$request->category_id,
            'subcategory_id'        =>$request->subcategory_id,
            'ultra_sub_category_id' =>$request->ultra_sub_category_id,
            'product_name'          =>$request->product_name,
            'product_color'         =>$request->product_color,
            'user_name'             =>$request->user_name,
            'slug'                  =>$slug,
            'product_price_regular' =>$request->product_price_regular,
            'product_price_discount'=>$request->product_price_discount,
            'product_quantity'      =>$request->product_quantity,
            'short_description'     =>$request->short_description,
            'long_description'      =>$request->long_description,
            'publication_status'    =>$request->publication_status,
            'inside_dhaka'          =>$request->inside_dhaka,
            'outside_dhaka'         =>$request->outside_dhaka,
            'product_image'         =>json_encode($images),

        ]);
        if($success){
            return response()->json(['success'=>$success],200);
        }


    }

    public function updateProductImage(Request $request){

        $request->validate([
            'product_image.*'      =>'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $images=[];
        $slug       = slugfy($request->product_name);
        
        if($request->hasFile('product_image')){
            $i=0;
            foreach($request->file('product_image')as $file){
        $file_ext = $file->getClientOriginalExtension();
        $file_name = $slug.rand(1,9999).'.'.$file_ext;
        Image::make($file)->resize(400,250)->save(public_path('uploads/products/').$file_name);


        //     if(file_exists(public_path('uploads/products/'.$file_name))){
        //         unlink(public_path('uploads/products/'.$file_name));
        // Image::make($file)->resize(400,250)->save(public_path('uploads/products/').$file_name);
        //     }
        $images[] = $file_name;  
        $i++;       
            }
        }
        $product = Product::find($request->productId);
        $product->product_image         = json_encode($images);
        $success = $product->save();
        if($success){
            return response()->json(['success'=>$success],200);
        }
    }

    public function prodName($name){

        $product = Product::where('product_name',$name)->get();
        return response()->json(['product'=>$product],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product=Product::where('slug',$slug)->first();
        return response()->json(['product'=>$product],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function boosts()
    {
        $boosts = Product::where('boost_status',1)->where('publication_status',1)->orderBy('id','DESC')->get();
        foreach($boosts as $boost){
            $boost->product_image = json_decode($boost->product_image);
        }
        return response()->json(['boosts'=>$boosts],200);
    }
    public function FrontProduct()
    {
        $products = Product::where('publication_status',1)->with('subcategory','category')->orderBy('id','DESC')->paginate(12);
        foreach($products as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['products'=>$products],200);
    }
    public function ViewProduct($slug)
    {
        $product=Product::where('slug',$slug)->with('category','subcategory')->get();
        foreach($product as $prod){
            $prod->product_image = json_decode($prod->product_image);
        }
        return response()->json(['product'=>$product],200);
    }
    public function ViewBoostProduct($slug)
    {
        $product=Product::where('slug',$slug)->with('category','subcategory')->get();
        foreach($product as $prod){
            $prod->product_image = json_decode($prod->product_image);
        }
        return response()->json(['product'=>$product],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProductInfo(Request $request)
    {
        $request->validate([
            'category_id'          =>'required',
            'subcategory_id'       =>'required',
            'product_name'         =>'required',
            'product_price_regular'=>'required',
            'product_quantity'     =>'required',
            'short_description'    =>'required',
            'publication_status'   =>'required',
            'inside_dhaka'         =>'required',
            'outside_dhaka'        =>'required',
        ]);
        $product = Product::find($request->id);
        $product->category_id            =$request->category_id;
        $product->subcategory_id         =$request->subcategory_id;
        $product->ultra_sub_category_id  =$request->ultra_sub_category_id;
        $product->product_name           =$request->product_name;
        $product->slug                   =slugfy($request->product_name);
        $product->product_color          =$request->product_color;
        $product->product_price_regular  =$request->product_price_regular;
        $product->product_price_discount =$request->product_price_discount;
        $product->user_name              =$request->user_name;
        $product->product_quantity       =$request->product_quantity;
        $product->short_description      =$request->short_description;
        $product->long_description       =$request->long_description;
        $product->publication_status     =$request->publication_status;
        $product->inside_dhaka           =$request->inside_dhaka;
        $product->outside_dhaka          =$request->outside_dhaka;
        $success = $product->save();
        if($success){
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
        $product=Product::find($id);
        $product->publication_status=1;
            if($product->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $product=Product::find($id);
        $product->publication_status=0;
            if($product->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function boost($id){
        $product=Product::find($id);
        $product->boost_status=1;
            if($product->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function unboost($id){
        $product=Product::find($id);
        $product->boost_status=0;
            if($product->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function destroy($id)
    {
        $product = Product::find($id);
        // $fileName = $product->product_image;
        $images = json_decode($product->product_image);
        // foreach ($images as $file) {
        //     unlink(public_path('uploads/products/'.$file));
        // }
        // $product->delete();
        if($product->delete()){
                
        foreach ($images as $file) {
            if(file_exists(public_path('uploads/products/'.$file))){
            unlink(public_path('uploads/products/'.$file));
        }
            }
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);
    }
    public function getResultVal(Request $request){
        $name = $request->name;
        $getResultVal = Product::where('product_name','like','%'.$name.'%')->with('ultrasubcategory','subcategory','category')->get();
        foreach($getResultVal as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['getResultVal'=>$getResultVal],200);
    }


    public function myResultVal(Request $request){
        $name = $request->name;
        $getResultVal = Product::where('product_name','like','%'.$name.'%')->where('user_name','Admin')->with('ultrasubcategory','subcategory','category')->get();
        foreach($getResultVal as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['getResultVal'=>$getResultVal],200);
    }

    
    public function VendorResultVal(Request $request){
        $name = $request->name;
        $getResultVal = Product::where('product_name','like','%'.$name.'%')->where('user_name',Session::get('customerName'))->with('ultrasubcategory','subcategory','category')->get();
        foreach($getResultVal as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['getResultVal'=>$getResultVal],200);
    }


    public function frontResultVal(Request $request){
        $name = $request->name;
        $getResultVal = Product::where('product_name','like','%'.$name.'%')->where('publication_status',1)->with('category')->get();
        foreach($getResultVal as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['getResultVal'=>$getResultVal],200);
    }


        // $image = $request->file('product_image');
        // $imageExt = $image->getClientOriginalExtension();
        // $imageName = $slug.$imageExt;

        // $directory='product-image/';

        // Image::make($image)->save(public_path($directory).$imageName);2021_03_02_141452_create_products_table
}
