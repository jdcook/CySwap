@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Manage Users</b></h1>
<hr/>
</div>


<!--
	{{ Form::open(array('action' => array('PostController@postItem'), 'files'=>true)) }}

	<div id="form">

	</div>

	<br />

	{{ Form::token().Form::close() }}
-->


<div class="col-md-4"></div>
<div class="col-md-4">
{{ Form::open(array('onsubmit' =>'getUser(); return false;', 'files'=>true)) }}
	<div class="col-sm-9">
		<div class="input-group">
			<span class="input-group-addon">Find User</span>
			<input id="usernameInput" class="form-control" type="text"/>
		</div>
	</div>
	<div class="col-sm-3">
		<a><input id="searchUserBtn" class="btn btn-default" role="button" type="submit" value="Search" data-loading-text="Loading..."/></a>
	</div>
{{ Form::token().Form::close() }}

	<div id="resultDiv"></div>

</div>

<div class="col-md-4"></div>


@stop




@section('javascript')

<script>
function getUser(){
	$('#resultDiv').html("");
	var input = $("#usernameInput").val();
	if(input.length > 0){
		$('#searchUserBtn').button('loading');
		$.ajax({
			type: 'GET',
			url: 'get_users?user='+input,
			success: function(result)
			{
				$('#searchUserBtn').button('reset');
				$('#resultDiv').html(result);
			}
		});
	}
	else
	{
		$("#resultDiv").html("<br/><p class='centered alert'>Enter a username</p>");
	}
}
</script>
@stop