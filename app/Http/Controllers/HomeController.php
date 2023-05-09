<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logo = Logo::where('publication_status',1)->orderBy('id','ASC')->take(1)->first();
        return view('admin.components.layout',['logo'=>$logo]);
    }

    public function LogOut(){
        Auth::logout();
        return redirect('/login');
    }
}
