<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Shipping;
use Session;
class CartCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartProducts = Cart::where('customer_id',Session::get('customerId'))->with('product')->get();
        foreach ($cartProducts as $product) {
            $product->product_image = json_decode($product->product_image);
        }
        return response()->json(['cartProducts'=>$cartProducts],200);
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
        $customerId = Session::get('customerId');
        $product = Product::find($request->product_id);

        // $request->validate([
        //     'product_color'     =>'required'
        // ]);
        $carts =Cart::all();
        foreach ($carts as $cartProduct){
            if ($cartProduct->product_id == $request->product_id) {
                $cartProduct->product_quantity = $cartProduct->product_quantity+1;
                $success = $cartProduct->save();
            if($success){
                return response()->json(['success'=>$success],200);
            }
            }
        }
        
            if($product->product_price_discount!=null){
                $success = Cart::create([
                'product_id'        =>$request->product_id,
                'customer_id'       =>$customerId,
                'product_quantity'  =>$request->product_quantity,
                'product_color'     =>$request->product_color,
                'product_name'      =>$product->product_name,
                'product_price'     =>$product->product_price_discount,
                'product_image'     =>$product->product_image
            ]);
            if($success){
                return response()->json(['success'=>$success],200);
                Session::put('CartId',$request->product_id);
            }
            else{
                return response()->json(['error',$error],404);
            }
        }
        else{
                $success = Cart::create([
                'product_id'        =>$request->product_id,
                'customer_id'       =>$customerId,
                'product_quantity'  =>$request->product_quantity,
                'product_color'     =>$request->product_color,
                'product_name'      =>$product->product_name,
                'product_price'     =>$product->product_price_regular,
                'product_image'     =>$product->product_image
            ]);
            if($success){
                Session::put('CartId',$request->product_id);
                return response()->json(['success'=>$success],200);
            }
            else{
                return response()->json(['error',$error],404);
            }
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
    public function update(Request $request,$id,$qty,$product_id)
    {
        $product = Product::find($product_id);
        $cartProduct = Cart::find($id);
        $cartProduct->product_quantity = $qty;
        $success = $cartProduct->save();
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
        $cartProduct = Cart::find($id);
        $product = Product::find($cartProduct->product_id);
        $success = $cartProduct->delete();
            if($success){
                Session::forget('CartId');
                return response()->json(['success'=>$success],200);
            }
    }
    public function customername(){
        $customername = Session::get('customerName');
        return response()->json(['customername'=>$customername],200);
    }
    public function shippingInfo(){
        $shippingInfo = Customer::where('id',Session::get('customerId'))->get();
        return response()->json(['shippingInfo'=>$shippingInfo],200);
    }
    public function saveShippingInfo(Request $request){
        $request->validate([
            'last_name'     =>'required',
            'email_address' =>'required',
            'phone_number'  =>'required',
            'address'       =>'required',
        ]);
        $success = Shipping::create([
            'customer_id'       =>$request->id,
            'last_name'         =>$request->first_name.' '.$request->last_name,
            'email_address'     =>$request->email_address,
            'phone_number'      =>$request->phone_number,
            'address'           =>$request->address,
        ]);
        if($success){
            Session::put('shippingId',$request->id);
            return response()->json(['success'=>$success],200);
        }
        else{
            return response()->json(['error'=>$error],404);
        }
    }

    public function total($total,$ship){
       Session::put('orderTotal',$total);
       Session::put('shippingTotal',$ship);
    }
}
