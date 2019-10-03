@extends('layouts.app')

@section('content')
	<ul>
		<li>Naam: {{$project->name}}</li>
		<li>Beschrijving: {{$project->description}}</li>


	</ul>

	Leden van dit project:
	<ul>
	@foreach($project->users as $user)
		<li>{{ $user->student_id }} - {{ $user->first_name }}</li>
	@endforeach
	</ul>

	@if (Auth::user()->isTeacher || Auth::user()->isAdmin)
	<a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Project Bewerken</a>
	@endif
@endsection
