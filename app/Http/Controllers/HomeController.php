<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;

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
        return view('home');
    }

    public function getUser()
    {
        return response()->json(Auth::user());
    }

    public function updateUser(Request $request)
    {
        $owner = Owner::find(Auth::user()->owner_id);

        $owner->name = $request->name;
        $owner->mykad = $request->mykad;
        $owner->license = $request->license;
        $owner->permit = $request->permit;
        $owner->address = $request->address;
        $owner->phone = $request->phone;
        $owner->email = $request->email;

        $owner->save();

        return response()->json($owner);
    }

    
}
