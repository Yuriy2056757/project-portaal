@extends('layouts.app')

@section('content')
<ul>
	@foreach($projects as $project)
		<li>{{$project->name}} <a href="{{route('projects.show', ['project' => $project->id])}}">Project bekijken</a></li>

	@endforeach
</ul>
@endsection
