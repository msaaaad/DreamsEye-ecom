<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Customer;
use Carbon\Carbon;
use Session;
use DB;
use PDF;
use Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=DB::table('orders')
                ->join('customers','orders.customer_id','=','customers.id')
                ->join('payments','orders.id','=','payments.order_id')
                ->select('orders.*','customers.first_name','customers.last_name','payments.payment_type','payments.payment_status')
                ->orderBy('created_at','DESC')->get();
        foreach($orders as $order){

            $order->created_at = Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans();
        }

        return response()->json(['orders'=>$orders],200);
    }
    public function completed()
    {
        $orders=DB::table('orders')
                ->join('customers','orders.customer_id','=','customers.id')
                ->join('payments','orders.id','=','payments.order_id')
                ->select('orders.*','customers.first_name','customers.last_name','payments.payment_type','payments.payment_status')
                ->orderBy('created_at','DESC')->where('order_status',1)->get();
        foreach($orders as $order){

            $order->created_at = Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans();
        }

        return response()->json(['orders'=>$orders],200);
    }
    public function uncompleted()
    {
        $orders=DB::table('orders')
                ->join('customers','orders.customer_id','=','customers.id')
                ->join('payments','orders.id','=','payments.order_id')
                ->select('orders.*','customers.first_name','customers.last_name','payments.payment_type','payments.payment_status')
                ->orderBy('created_at','DESC')->where('order_status',0)->get();
        foreach($orders as $order){

            $order->created_at = Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans();
        }

        return response()->json(['orders'=>$orders],200);
    }

    public function customerInfo($id){
        $order = Order::find($id);
        $customer = Customer::where('id',$order->customer_id)->first();
        return response()->json(['customer'=>$customer],200);
    }
    public function orderInfo($id){
        $order = Order::find($id);
        $carbon = Carbon::createFromTimeStamp(strtotime($order->created_at))->diffForHumans();
        $shipping=Shipping::where('customer_id',$order->customer_id)->first();
        $payment = Payment::where('order_id',$id)->first();
        $orderDetails=OrderDetails::where('order_id',$order->id)->get();
        return response()->json(['order'=>$order,'carbon'=>$carbon,'shipping'=>$shipping,'payment'=>$payment,'orderDetails'=>$orderDetails],200);
    }

    public function orderInvoice($id){
        $order =Order::find($id);
        $customer=Customer::find($order->customer_id);
        $shipping=Shipping::where('customer_id',$order->customer_id)->first();
        $orderDetails=OrderDetails::where('order_id',$order->id)->get();

        return response()->json(['order'=>$order,'customer'=>$customer,'shipping'=>$shipping,'orderDetails'=>$orderDetails],200);
    }

    public function downloadOrderInvoice($id){
        $order =Order::find($id);
        $customer=Customer::find($order->customer_id);
        $shipping=Shipping::where('customer_id',$order->customer_id)->first();
        $orderDetails=OrderDetails::where('order_id',$order->id)->get();
        $pdf = PDF::loadView('admin.components.download-invoice',[
            'order'                =>$order,
            'shipping'             =>$shipping,
            'customer'             =>$customer,
            'orderDetails'         =>$orderDetails,]);
      return $pdf->download('invoice'.'-'.$order->id.'.pdf');
    }

    public function completeOrder($id){
        $order =Order::find($id);
        $order->order_status = 1;
        $success = $order->save();
        return response()->json(['success'=>$success],200);
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
        
        $paymentType = $request->payment_type;
        if ($paymentType=='Cash'){
            $order=new Order();
            $order->customer_id     = Session::get('customerId');
            $order->shipping_id     = Session::get('shippingId');
            $order->shipping_total  = Session::get('shippingTotal');
            $order->order_total     = Session::get('orderTotal');
            $order->save();

                Session::put('OrderId',$order->id);

            $payment=new Payment();
            $payment->order_id      =$order->id;
            $payment->payment_type  =$paymentType;
            $payment->save();

            $cartProducts = Cart::all();
            foreach ($cartProducts as $cartProduct){
                $orderDetail=new OrderDetails();
                $orderDetail->order_id      =$order->id;
                $orderDetail->product_id    =$cartProduct->product_id;
                $orderDetail->product_name  =$cartProduct->product_name;
                $orderDetail->product_price =$cartProduct->product_price;
                $orderDetail->product_quantity=$cartProduct->product_quantity;
                $success = $orderDetail->save();
            }
                if($success){
                    $customer = Customer::find(Session::get('customerId'));
                $data = $customer->toArray();

                Mail::send('site.order-confirmation-mail',$data,function($message) use($data){
                    $message->to($data['email_address']);
                    $message->subject('Confirmation Mail');
                });

                    foreach ($cartProducts as $cartProduct){
                            $product        = Product::find($cartProduct->product_id);
                            $product->product_quantity = $product->product_quantity - $cartProduct->product_quantity;
                            $product->save();

                        
                    }
                    $shipping = Shipping::where('id', Session::get('shippingId'))->get(['id']);
                    Shipping::destroy($shipping->toArray());
                    Session::forget('CartId');
                    Session::forget('shippingId');
                    Session::forget('orderTotal');
                }
            return response()->json(['success'=>$success],200);
        }
        else if ($paymentType=='Rocket'){

        }
        else if ($paymentType=='Bkash'){

        }
    }
    public function ShippingAndTotal(){
        $ship = Session::get('shippingId');
        return response()->json(['ship'=>$ship],200);
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
