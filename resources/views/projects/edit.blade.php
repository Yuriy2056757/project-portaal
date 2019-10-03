@extends('layouts.app')

@section('content')
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<h3>Project <strong>{{$project->name}}</strong> wijzigen</h3>
<hr>
<form action="{{route('projects.update', $project->id)}}" method="POST">
	@csrf
	@method('PATCH')
	<div class="form-group">
		<label for="name">Naam</label>
	    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$project->name}}">
	</div>
	<div class="form-group">
		<label for="slug">Slug</label>
	    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{$project->slug}}">
	</div>
	<div class="form-group">
	    <label for="description">Beschrijving</label>
	    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{$project->description}}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
