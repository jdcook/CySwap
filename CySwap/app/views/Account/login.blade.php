@extends('layoutmain')

@section('content')

	<form action="{{ URL::route('login-post') }}" method="post">
		<br>

		@if(Session::has('message'))
			{{ Session::get('message') }}
		@endif

		<div class="field">
			Net-Id: <input type="text" name="netid"{{ (Input::old('netid')) ? ' value="' . e(Input::old('netid')) . '"' : ''}}>
			@if($errors->has('netid'))
				{{$errors->first('netid')}}
			@endif
		</div>

		<div class="field">
			Password: <input type="password" name="password">
			@if($errors->has('password'))
				{{$errors->first('password')}}
			@endif
		</div>

		<input type="submit" value="Login">
		{{ Form::token() }}

	</form>

@stop