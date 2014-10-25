@extends('layoutmain')

@section('content')

<div class="col-md-12">
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
@stop