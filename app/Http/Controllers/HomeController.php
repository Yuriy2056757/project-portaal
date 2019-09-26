<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use Illuminate\Http\Request;

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
        $projects = Project::all();

        $user = User::with('projects')
            ->where('id', Auth::id())
            ->get();
        $userProjects = $user[0]->projects;

        return view('home', [
            'projects' => $projects,
            'userProjects' => $userProjects,
        ]);
    }
}
