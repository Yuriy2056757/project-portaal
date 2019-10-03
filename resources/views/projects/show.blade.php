@extends('layouts.app')

@section('content')
	<ul>
		<li>Naam: {{$project->name}}</li>
		<li>Beschrijving: {{$project->description}}</li>
		<li><a href="{{route('projects.edit',$project->id)}}">Edit Project</a></li>
	</ul>

	Leden van dit project:
	<ul>
		@foreach($project->users as $user)
		<li>{{$user->student_id}} - {{$user->first_name}}</li>
		@endforeach
	</ul>
@endsection
