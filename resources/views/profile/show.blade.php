@extends('layouts.app')

@section('content')
<h3>Profiel</h3>
<hr>
<div class="row">
    <div class="col-md-3">
        <h4>Mijn gegevens</h4>
    </div>
    <div class="col-md-9">
    	<h5>Naam</h5>
    	<h6>{{$user->first_name}} {{$user->last_name}}</h6>
    	<h5>Email</h5>
    	<h6>{{$user->email}}</h6><br>
    	<h5>Studenten nummer</h5>
        <h6>{{$user->student_id}}</h6>
        <h5>Klas</h5>
        <h6>{{$user->class_name}}</h6>
        <a href="#">Persoonlijke gegevens bewerken ></a>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-3">
		<h4>Projecten waar je aan deelneemt</h4>
	</div>
	<div class="col-md-9">
        @if(count($user->projects))
            @foreach($user->projects as $project)
                <a href="{{route('projects.show', ['project' => $project->id])}}">
                    {{$project->name}}
                </a>
                <br>
            @endforeach
        @else
            <h4>Je hebt geen openstaande projecten</h4>
        @endif
	</div>
</div>
@endsection
