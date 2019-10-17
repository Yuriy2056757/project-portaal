@extends('layouts.app')

@section('content')
@csrf
{{-- Create a session cookie where the users will be stored temporary --}}
{{session()->put('users', [])}}
@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
@endforeach

<h3>Nieuw project aanmaken</h3>
<hr>

<form action="{{ route('projects.store') }}" method="POST">
	@csrf

	<div class="form-group">
		<label for="name">Naam</label>
	    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label>
	    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
	</div>

	<div class="form-group">
	    <label for="description">Beschrijving</label>
	    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
	</div>

	<div class="form-group">
		<label for="studentSearch">Studenten toevoegen</label>
		<input type="text" class="form-control" id="studentSearch">
    	<small id="emailHelp" class="form-text text-muted">Zoek op naam of studenten nummer.</small>
	</div>

	<ul class="list-group" id="userList">
	</ul>

	<button type="submit" class="btn btn-primary">Aanmaken</button>
</form>

<script type="application/javascript">
  $( function() {
  	// Create an array with all the users
    var names = [
    	@foreach($users as $user)
    		'{{$user->first_name}} {{$user->last_name}}, {{$user->student_id}}',
    	@endforeach
    ];
    // Define the input field as an autocomplete field
    $( "#studentSearch" ).autocomplete({
      // Use the names array as autocomplete source
      source: names,
      select: function (event, ui) {
      	// Create a variable for the full name and student id
      	var user = ui.item.label.split(", ")
      	$('#userList').append('<li class="list-group-item">'+user[0]+'</li>')
      	// Push the student id to the session cookie
      	axios.post('adduser/'+user[1])
      	// Clear the value and return false so the input field is empty again
      	$(this).val('');
      	return false;
      }
    });
  } );
</script>

@endsection
