@extends('layoutmain')

@section('content')

<div class="col-md-3">
	<form action="{{ URL::route('login-post') }}" method="post">
		<br>

		@if(Session::has('message'))
			{{ Session::get('message') }}
		@endif

		<div class="input-group detail">
		  <span class="input-group-addon">Net-Id</span>
			<input class="form-control" type="text" name="netid"{{ (Input::old('netid')) ? ' value="' . e(Input::old('netid')) . '"' : ''}}>
			@if($errors->has('netid'))
				{{$errors->first('netid')}}
			@endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">Password</span>
		  <input class="form-control" type="password" name="password">
			@if($errors->has('password'))
				{{$errors->first('password')}}
			@endif
		</div>

		<input class="btn btn-default" type="submit" value="Login">
		{{ Form::token() }}

	</form>
</div>
@stop