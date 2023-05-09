<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerContact;
use App\Models\Customer;
use App\Models\Varification;
use Mail;
use Session;
use Carbon\Carbon;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = CustomerContact::with('category')->get();
        return response()->json(['messages'=>$messages]);
    }

    public function Vendor(){
        $customer = Customer::where('id',Session::get('customerId'))->first();
        $vendor = $customer->publication_status;
        return response()->json(['vendor'=>$vendor],200);
    }

    public function ForgotPassword(Request $request){
        $customers = Customer::where('email_address',$request->email_address)->get();
        $cus = $customers[0]->email_address;
        $request->validate([
            'email_address'         =>'required',
        ]);
    
            $varify = new Varification();

            if($cus == $request->email_address){
                $varify->email_address      =$request->email_address;
                $varify->varification_code  =rand(111111,999999);
                $success = $varify->save();
                $data = $varify->toArray();

                Mail::send('site.varification-mail',$data,function($message) use($data){
                    $message->to($data['email_address']);
                    $message->subject('Varification Mail');
                });
                if($success){
                    Session::put('varificationEmail',$request->email_address);
                    return response()->json(['success'=>$success],200);
                }
                else{
                    return response()->json(['error'=>$error],404);
                }
            }
            else{
                return response()->json(['error'=>'error'],404);
            }
    }

    public function Check(Request $request){
        $request->validate([
            'varification_code'     =>'required|min:6|max:6'
        ]);
         $varif = Varification::where('email_address',Session::get('varificationEmail'))->orderBy('id','DESC')->take(1)->get();
         $varify=$varif[0];
         if($varify->varification_code == $request->varification_code){
            if($varify->created_at->diffInMinutes(Carbon::now()) < 2){
                return response()->json(['success'=>'success'],200);
                Session::put('validationCode',$request->varification_code);
            }
            else{
                return response()->json(['error'=>'error'],404);
            }
         }
         else{
            return response()->json(['error'=>'error'],500);
         }

    }

    public function resetPass(Request $request){
        $request->validate([
            'new_password'          =>'required|min:6',
            'confirm_new_password'  =>'required|min:6',
        ]);
        $customer = Customer::where('email_address',Session::get('varificationEmail'))->first();
        if($request->new_password==$request->confirm_new_password){
            $customer->password         =bcrypt($request->new_password);
            $success = $customer->save();
            
            if($success){
                $varify = Varification::where('email_address',Session::get('varificationEmail'))->first();
                $varify->delete();
                Session::forget('varificationEmail');
                Session::forget('validationCode');
                return response()->json(['success'=>$success],200);
            }
            else{
                return response()->json(['error'=>$error],404);
            }
        }
        else{
            return response()->json(['error'=>$error],404);
        }
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
            'full_name'     =>'required',
            'email_address' =>'required',
            'phone_number'  =>'required|min:11|max:11',
            'subject'       =>'required',
            'category_id'   =>'required',
            'message'       =>'required',
        ]);
        CustomerContact::create([
            'full_name'     =>$request->full_name,
            'email_address' =>$request->email_address,
            'phone_number'  =>$request->phone_number,
            'subject'       =>$request->subject,
            'category_id'   =>$request->category_id,
            'message'       =>$request->message,
        ]);
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
        $message = CustomerContact::find($id);
        $message->delete();
    }
}
