@extends('layouts.app')

@section('content')
	<h1>{{$project->name}}</h1>
	<p>{{$project->description}}</p>

	<h2>Leden</h2>
	<ul>
	@foreach($project->users as $user)
		<li>{{ $user->student_id }} - {{ $user->first_name }}</li>
	@endforeach
	</ul>
	<h2>Documentatie</h2>
	@foreach($project->comments as $comment)
		<div class="card">
			<div class="card-body">
				{{$comment->comment}}
				<h6 class="text-muted">{{$comment->time_diff}} door {{$comment->user->first_name}}</h6>
			</div>
		</div>
	@endforeach
	<a href="{{route('comment.create', ['project_id' => $project->id])}}" class="btn btn-warning">Documentatie aanmaken</a>

	@if (Auth::user()->isTeacher || Auth::user()->isAdmin)
	<a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Project Bewerken</a>
	@endif
@endsection
