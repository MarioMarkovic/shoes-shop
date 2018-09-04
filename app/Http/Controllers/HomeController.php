<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changeUserDetails($id, Request $request)
    {
        $this->validate($request, [
            'city' => 'required|string|max:191',
            'post_number' => 'required|integer',
            'street_name' => 'required|string|max:191',
            'street_number' => 'required|strig|max:191',
            'phone' => 'required|integer',
        ]);

        User::findOrFail($id)->update([ 
            'city' => $request->input('city'),
            'post_number' => $request->input('post_number'),
            'street_name' => $request->input('street_name'),
            'street_number' => $request->input('street_number'),
            'phone' => $request->input('phone'),
        ]);

        Session::put('success', 'Successfully updated!');
        return redirect()->route('user.home');
    }
}
