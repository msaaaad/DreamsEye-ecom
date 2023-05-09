<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Company;
use Image;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::with('customer')->get();
        return response()->json(['vendors'=>$vendors],200);
    }


    public function Customer()
    {
        $customers = Customer::orderBy('first_name')->paginate(10);
        return response()->json(['customers'=>$customers],200);
    }

    
    public function Seller($id)
    {
        $Seller = Company::where('id',$id)->with('customer')->first();
        return response()->json(['Seller'=>$Seller],200);
    }


    public function company()
    {
        $company = Company::orderBy('company_name')->with('customer')->paginate(10);
        return response()->json(['company'=>$company],200);
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
            'customer_email'        =>'required',
            'publication_status'    =>'required',
        ]);
        $success = Vendor::create([
            'customer_email'        =>$request->customer_email,
            'publication_status'    =>$request->publication_status,
        ]);
        return response()->json(['success'=>$success],200);
    }

    public function SaveCompanyInfo(Request $request){
        $file = explode(';',$request->certificate);
        $file = explode('/', $file[0]);
        $slug = slugfy($request->company_name).rand(1,999999);
        $fileExt = end($file);
        $fileName = time().'.'.$fileExt;
        $file2 = explode(';',$request->varification);
        $file2 = explode('/', $file2[0]);
        $fileExt2 = end($file2);
        $fileName2 = time().rand(3,33).'.'.$fileExt2;
        $request->validate([
            'company_name'      =>'required',
            'bill_address'      =>'required',
            'certificate'     =>'required',
            'varification'    =>'required',
            'emergency_contact' =>'required | min:11 | max:11'
        ]);
        if($fileExt=='jpeg' || $fileExt=='png' || $fileExt=='jpg' || $fileExt=='gif' || $fileExt=='svg' || $fileExt2=='jpeg' || $fileExt2=='png' || $fileExt2=='jpg' || $fileExt2=='gif' || $fileExt2=='svg'){
            $success = Company::create([
                'customerId'        =>$request->customerId,
                'company_name'      =>$request->company_name,
                'slug'              =>$slug,
                'bill_address'      =>$request->bill_address,
                'tin_certificate'   =>$fileName,
                'varification'      =>$fileName2,
                'emergency_contact' =>$request->emergency_contact,
            ]);
            if($success){
               Image::make($request->varification)->save(public_path('uploads/company/').$fileName2);
               Image::make($request->certificate)->save(public_path('uploads/company/').$fileName);
                return response()->json(['success',$success],200);
            }
        }
        else{
            return response()->json(['error'=>$error],500);
        }
    }

    public function getCompanyName($name){
        $company = Company::where('company_name',$name)->get();
        return response()->json(['company'=>$company],200);
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
    public function Publish($id){
        $vendor=Customer::find($id);
        $vendor->publication_status=1;
            if($vendor->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $vendor=Customer::find($id);
        $vendor->publication_status=0;
            if($vendor->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Publishcompany($id){
        $company=Company::find($id);
        $company->seller_status=1;
            if($company->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublishcompany($id){
        $company=Company::find($id);
        $company->seller_status=0;
            if($company->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function destroy($id)
    {
        $vendor = Customer::find($id);
        $vendor->delete();
    }

    public function destroyCompany($id)
    {
        $vendor = Company::find($id);
        $vendor->delete();
    }
    public function getResultVal(Request $request){
        $name = $request->name;
        $getResultVal = Customer::where('first_name','like','%'.$name.'%')->get();
        return response()->json(['getResultVal'=>$getResultVal],200);
    }
    public function getCompanyVal(Request $request){
        $name = $request->name;
        $getResultVal = Company::where('company_name','like','%'.$name.'%')->get();
        return response()->json(['getResultVal'=>$getResultVal],200);
    }
}
