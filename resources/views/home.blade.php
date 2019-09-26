@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="text-center">Welkom {{Auth::user()->first_name}}</h3>
    @if(Auth::user()->isTeacher)
        <a class="btn btn-primary" href="{{ route('projects.create') }}">NIEUW PROJECT</a>

        <h4>Bekijk alle projecten:</h4>

        <div class="projects" style="margin-bottom: 20vh">
            @foreach($projects as $project)
                <div class="card" style="width: 320px; float: left; margin: 10px">
                  <div class="card-body">
                    <h5 class="card-title">{{$project->name}}</h5>
                    <p class="card-text">{{$project->description}}</p>
                    <a href="{{route('projects.show', ['project' => $project->id])}}" class="card-link">Project bekijken</a>
                    {{-- <a href="#" class="card-link">Another link</a> --}}
                  </div>
                </div>
            @endforeach
        </div>
    @endif
    <h4>Alle projecten waar je lid van bent:</h4>
    <hr>
    <div class="projects">
        @foreach($userProjects as $userProject)
            <div class="card" style="width: 320px; float: left; margin: 10px">
              <div class="card-body">
                <h5 class="card-title">{{$userProject->name}}</h5>
                <p class="card-text">{{$userProject->description}}</p>
                <a href="{{route('projects.show', ['project' => $userProject->id])}}" class="card-link">Project bekijken</a>
                {{-- <a href="#" class="card-link">Another link</a> --}}
              </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
