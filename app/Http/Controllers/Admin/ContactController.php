<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('publication_status',1)->orderBy('id','ASC')->take(1)->get();
        return response()->json(['contacts'=>$contacts]);
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
            'phone_number_1'    =>'required',
            'email_address'     =>'required',
            'publication_status'=>'required',
        ]);

        Contact::create([
            'phone_number_1'    =>$request->phone_number_1,
            'slug'              =>slugfy($request->phone_number_1),
            'phone_number_2'    =>$request->phone_number_2,
            'phone_number_3'    =>$request->address,
            'publication_status'=>$request->publication_status,
            'email_address'     =>$request->email_address,
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
        $contact=Contact::where('slug',$slug)->first();
        return response()->json(['contact'=>$contact],200);
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
            'phone_number_1'    =>'required',
            'email_address'     =>'required',
            'publication_status'=>'required',
        ]);

        $contact = Contact::find($request->id);

        $contact->phone_number_1      =$request->phone_number_1;
        $contact->phone_number_2      =$request->phone_number_2;
        $contact->phone_number_3      =$request->phone_number_3;
        $contact->publication_status  =$request->publication_status;
        $contact->email_address       =$request->email_address;

        if ($contact->save()) {
            $success = true;
        }
        else{
            $success = false;
        }
        return response()->json(['success'=>$success],200);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Publish($id){
        $contact=Contact::find($id);
        $contact->publication_status=1;
            if($contact->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }
    public function Unpublish($id){
        $contact=Contact::find($id);
        $contact->publication_status=0;
            if($contact->save()){
                $success = true;
            }
            else{
                $success = false;
            }
            return response()->json(['success'=>$success],200); 
   }

    public function destroy($id)
    {
        
        $contact = Contact::find($id);
        $contact->delete();
    }
}
