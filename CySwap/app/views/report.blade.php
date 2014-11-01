@extends('layoutmain')

@section('content')

<div class="col-md-12">

<?php
$accepted = 0;
if(Session::has('accepted_terms') && Session::get('accepted_terms')){
	$accepted = 1;
}
?>

@if(!$accepted)
	<p class="alert">You have to accept the Terms of Use reporting a post.</p>
	<a class="btn btn-default accept terms" href="{{URL::to('terms')}}">Terms of Use</a>
	</div>
@else

{{ Form::open(array('action' => array('ReportController@reportPost'))) }}
{{Form::hidden('postId',$postId)}}

<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Report Description')}}</span>

		  	{{Form::text('reportDescription','', ['class' => 'form-control'])}}

		</div>


</div>
<div class="col-md-12">
	<a> {{ Form::submit('Submit Report', ['id' => 'reportButton', 'class' => 'btn btn-default', 'role' => 'button']) }} </a>
</div>



{{ Form::token().Form::close() }}

@endif
@stop
