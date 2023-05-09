<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class FrontProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendorProduct()
    {
        $products=Product::where('user_name',Session::get('customerName'))->with('category','subcategory','ultrasubcategory')->orderBy('id','DESC')->get();
        foreach($products as $prod){
            $prod->product_image = json_decode($prod->product_image);
        }
        return response()->json(['products'=>$products],200);
    }

    public function categoryProduct($id){
        $categoryProducts=Product::where('category_id',$id)
            ->where('publication_status',1)
            ->with('category','subcategory')
            ->orderBy('id','DESC')
            ->get();
            foreach($categoryProducts as $product){
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['categoryProducts'=>$categoryProducts],200);
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
        //
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
        //
    }
}
