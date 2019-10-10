@extends('layouts.app')

@section('content')
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
    var names = [
    	@foreach($users as $user)
    		'{{$user->first_name}} {{$user->last_name}}',
    	@endforeach
    ];
    $( "#studentSearch" ).autocomplete({
      source: names
    });
  } );

//   $(document).ready(function() {
//     $( "#studentSearch" ).autocomplete({

//         source: function(request, response) {
//             $.ajax({
//             url: "{{route('autocomplete')}}",
//             data: {
//                     term : request.term
//              },
//             dataType: "json",
//             success: function(data){
//                console.log(data);
//                $('#userList').append('<li class="list-group-item">'+data+'</li>')
//             }
//         });
//     },
//     minLength: 1
//  });
// });
</script>

@endsection
