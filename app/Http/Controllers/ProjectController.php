<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects/index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isTeacher) {
            return view('projects/create');
        } else{
            return redirect(route('home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:projects'],
            'description' => ['required', 'string'],
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->slug = $request->slug;
        $project->description = $request->description;
        $project->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $showProject = Project::with('users')->where('id', $project->id)->get();
        return view('projects.show', ['project' => $showProject[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit')->with('project', $project);
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
		return view('projects.show')->with('project', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('projects');
    }
}
