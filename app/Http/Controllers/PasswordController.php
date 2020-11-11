<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;
use App\Models\External;
use App\Models\Driver;

class PasswordController extends Controller
{
    public function reset()
    {
        return view('reset');
    }

    public function changePassword(Request $request)
    {
        $owner = Owner::where('username', $request->username)
        ->where('mykad', $request->mykad)->get();

        if(count($owner) > 0){
            $owner[0]->reset = 1;
            $owner[0]->save();
        }

        return view('auth/login');
    }
}
