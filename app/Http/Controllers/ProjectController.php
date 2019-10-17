<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isTeacher || Auth::user()->isAdmin) {
            $users = User::all();
            return view('projects.create', compact('users'));
        }

        return redirect(route('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $users = $request->session()->get('users');
        $project = new Project();
        $project->name = $request->name;
        $project->slug = $request->slug;
        $project->description = $request->description;
        $project->save();

        foreach ($users as $user) {
            $student = User::where('student_id', $user)->get()[0];
            $project->users()->attach($student->id);
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::with('users', 'comments')->where('id', $project->id)->get()->first();
        foreach ($project->comments as $key => $comment) {
            $project->comments[$key]['time_diff'] = $comment->created_at->diffForHumans();
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if (Auth::user()->isTeacher || Auth::user()->isAdmin) {
            return view('projects.edit', compact('project'));
        }

        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
		request()->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('projects')->ignore($project)],
            'description' => ['required', 'string'],
        ]);

        $project->update($request->all());
		return view('projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
		if (Auth::user()->isTeacher || Auth::user()->isAdmin)
		{
			$project->delete();

	        return redirect('projects');
		}
        return redirect()->back();
    }

    public function addUser($id)
    {
        session()->push('users', $id);
        return $id;
    }
}
