<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$user = User::where('id', Auth::id())->with('projects')->get();
    	return view('profile.show', ['user' => $user[0]]);
    }

    public function update(Request $request)
    {
    	request()->validate([
    		'student_id' => ['required', 'numeric', 'digits_between:5,8'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'class_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    	]);

    	$user = User::find(Auth::id());
    	$user->update($request->all());
    }
}
