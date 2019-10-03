<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function edit()
    {
    	$user = User::find(Auth::id());
    	return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
    	$user = User::find(Auth::id());

    	$validateArray = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'class_name' => ['required', 'string', 'max:255'],
        ];
        if($request->email != $user->email)
        {
        	$validateArray += ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']];
        }
        if($request->password != null)
        {
        	$validateArray += ['password' => ['required', 'string', 'min:8', 'confirmed']];
        }
    	request()->validate($validateArray);
    	if($request->password != null)
        {
        	$requestData = $request->all();
        	$requestData['password'] = Hash::make($request->password);
        }
    	$user->update($requestData);
    	return redirect()->route('profile.show');
    }
}
