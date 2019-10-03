@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <h1>Profiel</h1>
            <hr>

    <div class="tab-content py-4">
        <div class="tab-pane active" id="profile">
        	<div class="row">
    		<div class="col-sm-9">
    			<h3><b>
    				{{ $user->first_name }} {{ $user->last_name }}
    			</b></h3>

                @if(Auth()->user())
                <div class="col-sm-3">
                    <h5><strong>Studentnummer:</strong> {{ $user->student_id }}</h5>
                    <h5><strong>Naam:</strong> {{ $user->first_name }}</h5>
                    <h5><strong>Achternaam:</strong> {{ $user->last_name }}</h5>
                    <h5><strong>Klasnaam:</strong> {{ $user->class_name }}</h5>
                    <h5><strong>Project manager:</strong> {{ $user->isTeacher }}</h5>
                    <h5><strong>Email:</strong> {{ $user->email }}</h5>
                </div>
                @endif
                 <a class="btn btn-primary" href="{{ route('users.edit') }}">Verander je info</a>
    		</div>

    	</div>
    </div>
</div>
    </div>

    </div>
    </div>

@endsection
