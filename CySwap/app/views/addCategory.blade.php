@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Add Category</b></h1>
<hr/>
</div>
<div class="col-md-12">
{{ Form::open(array('action'=>'CategoryController@createCategory')) }}



{{ Form::submit('Submit', ['class' => 'btn btn-default positive-active center-block', 'role' => 'button']) }}
{{ Form::token().Form::close() }}
</div>

@stop




@section('javascript')

<script>

</script>
@stop