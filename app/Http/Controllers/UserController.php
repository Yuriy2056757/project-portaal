<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Home;

class UserController extends Controller
{
    public function index(){

		$users = User::get();

   		return view('users.profile')
   			->with('user', $users);

	}

	public function show($student_id){
		$user = User::where('student_id', $student_id)
			->firstOrFail();
		return view('users.profile')
			->with('user', $user);
	}

	public function edit()
   {
   		if (Auth::user()){
   			$user = User::find(Auth::user()->id);

   		if ($user) {
   			return view('users.edit')->withUser($user);
   		} else {
   			return redirect('users');

}
   		}
   }

	public function update(Request $request) {
		dd($request);
		$user = User::find(Auth::user()->id);

		if ($user) {
			$validate = $request->validate([
				'first_name' => 'required|max:255',
				'last_name' => 'required|max:255',
				'email' => 'required|max:255',

			]);

			$user->first_name = $request['first_name'];
			$user->last_name = $request['last_name'];
			$user->email = $request['email'];

			$user->save();

			return redirect('users/profile');

		} else {
			return redirect('users/profile');
		}
	}
}
