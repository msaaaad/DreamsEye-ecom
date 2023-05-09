<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\Category;
use App\Models\About;
use App\Models\Contact;
use App\Models\Team;
use App\Models\Customer;
use App\Models\Company;
use Image;
use Session;
use Mail;

class SiteController extends Controller
{
    
    public function Site()
    {
        $logo = Logo::where('publication_status',1)->orderBy('id','DESC')->take(1)->first();
        $categories = Category::where('publication_status',1)->orderBy('category_name')->get();
        $about = About::where('publication_status',1)->orderBy('id','DESC')->take(1)->first();
        $contact = Contact::where('publication_status',1)->orderBy('id','DESC')->take(1)->first();

        return view('site.layout',['logo'=>$logo,'categories'=>$categories,'about'=>$about,'contact'=>$contact]);    }
    public function about(){

        $about = About::where('publication_status',1)->orderBy('id','DESC')->take(1)->first();
        return response()->json(['about'=>$about],200);

    }
    public function contact(){

        $contact = Contact::where('publication_status',1)->orderBy('id','DESC')->take(1)->first();
        return response()->json(['contact'=>$contact],200);

    }

    public function cusMail($email){
        $customer = Customer::where('email_address',$email)->get();
        return response()->json(['customer'=>$customer],200);
    }

    public function ceo(){
    	$ceo = Team::where('designation','CEO')->first();
    	return response()->json(['ceo'=>$ceo],200);
    }

    public function teams(){
    	$teams = Team::where('designation','!=','CEO')->get();
    	return response()->json(['teams'=>$teams],200);
    }

    public function Register(Request $request){
    	$file = explode(';',$request->profile_picture);
        $file = explode('/', $file[0]);
        $fileExt = end($file);
        $slug = slugfy($request->first_name.$request->last_name).rand(1,9999999);
        $fileName = $slug.'.'.$fileExt;
    	$request->validate([
    		'first_name'		=>'required|min:3|max:15',
    		'last_name'			=>'required|min:3|max:15',
    		'email_address'		=>'required',
    		'password'			=>'required|min:6',
    		'confirm_password'	=>'required|min:6',
    		'phone_number'		=>'required',
    		'region'			=>'required',
            'address'           =>'required',
    		'profile_picture'	=>'required',
    	]);
        

        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg'){
            $customer = new Customer();
        	if($request->password==$request->confirm_password){

            $customer->first_name		=$request->first_name;
            $customer->last_name		=$request->last_name;
            $customer->email_address	=$request->email_address;
            $customer->password 		=bcrypt($request->password);
            $customer->phone_number		=$request->phone_number;
            $customer->slug 			=$slug;
            $customer->address 			=$request->address;
            $customer->region           =$request->region;
            $customer->profile_picture	=$fileName;
            $success = $customer->save();
    	        if ($success) {
    	           Image::make($request->profile_picture)->resize(300,200)->save(public_path('uploads/customer/').$fileName);
    	        

    	        $customerId = $customer->id;
    	        Session::put('customerId',$customerId);
    	        Session::put('customerName',$customer->first_name.' '.$customer->last_name);
                Session::put('customerRegion',$customer->region);
                $data = $customer->toArray();

                Mail::send('site.confirmation-mail',$data,function($message) use($data){
                    $message->to($data['email_address']);
                    $message->subject('Confirmation Mail');
                });
    	    	}
    	    	else{
    	    		return response()->json(['error'=>$error],404);
    	    	}
    	    }
        }
                else{
                    return response()->json(['error'=>'error'],404);
                }



    }
    public function Login(Request $request){
        $customer=Customer::where('email_address', $request->login_email_address)->first();
        if (password_verify($request->login_password,$customer->password)){
            Session::put('customerId',$customer->id);
            Session::put('customerRegion',$customer->region);
            Session::put('customerSlug',$customer->slug);
            Session::put('status',$customer->publication_status);
            Session::put('customerName',$customer->first_name.' '.$customer->last_name);
        }
        else{
        	return response()->json(['error'=>$error],404);
        }
    } 
    public function userName(){
        $name = Session::get('customerName');
        return response()->json(['name'=>$name],200);
    }

    public function customerLogout(){
        Session::forget('customerId');
        Session::forget('customerName');
        Session::forget('customerSlug');
        Session::forget('status');
        Session::forget('customerFirstName');
        Session::forget('customerRegion');
        return redirect('/');
    }

    public function frontCustomer(){
        $customer = Customer::find(Session::get('customerId'));
        return response()->json(['customer'=>$customer],200);
    }

    public function show($slug){

        $customer=Customer::where('slug',$slug)->first();
        return response()->json(['customer'=>$customer],200);
    }
    public function updateBio(Request $request){
        $success = false;
        $request->validate([
            'first_name'        =>'required',
            'last_name'         =>'required',
            'email_address'     =>'required',
            'phone_number'      =>'required',
            'region'            =>'required',
            'address'           =>'required',
        ]);
        $customer = Customer::find($request->id);
        $customer->first_name       =$request->first_name;
        $customer->last_name        =$request->last_name;
        $customer->slug             =slugfy($request->first_name.$request->last_name);
        $customer->email_address    =$request->email_address;
        $customer->phone_number     =$request->phone_number;
        $customer->region           =$request->region;
        $customer->address          =$request->address;
        $success = $customer->save();
        Session::put('customerRegion',$customer->region);
        return response()->json(['success'=>$success],200);
    }

    public function CustomerLoggedIn(){
        $region = Session::get('customerRegion');
        return response()->json(['region'=>$region],200);
    }
    public function Cus(){
        $cus = Session::get('customerId');
        return response()->json(['cus'=>$cus],200);
    }
    public function Comp(){
        $comp = Company::where('customerId',Session::get('customerId'))->get();
        return response()->json(['comp'=>$comp],200);
    }
    public function very(){
        $very = Session::get('varificationEmail');
        return response()->json(['very'=>$very],200);
    }
    public function code(){
        $code = Session::get('validationCode');
        return response()->json(['code'=>$code],200);
    }
    public function companyStatus(){
        $company = Company::where('customerId',Session::get('customerId'))->first();
        $companyStatus = $company->seller_status;
        return response()->json(['companyStatus'=>$companyStatus],200);
    }
}
