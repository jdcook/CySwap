@extends('layoutmain')

@section('content')

<br />
<br />
<div class="col-md-4">
	{{ Form::open(array('action'=>'RateController@rateBuyer')) }}
	<br>

	<div class="toggleBtn">
		<p>Rate username</p>
		<a id="likeBtnArea" class="btn btn-default" role="button">
			<label id="likeBtnLabel" for="likeBtn" class="btnLabel glyphicon glyphicon-thumbs-up" />
			<input id="likeBtn" type="checkbox" name="like" style="visibility: hidden">
		</a>

		<a id="dislikeBtnArea" class="btn btn-default" role="button">
			<label id="dislikeBtnLabel" for="dislikeBtn" class="btnLabel glyphicon glyphicon-thumbs-down"/>
			<input id="dislikeBtn" type="checkbox" name="like" style="visibility: hidden">
		</a>
	</div>

	<!-- 
	<div class="input-group detail">
	  <span class="input-group-addon">{{Form::label('Leave Feedback')}}</span>
	  	{{Form::text('feedback', '', ['id' => 'feedback', 'class' => 'form-control'])}}
	</div> 
	-->


	<br />

	{{ Form::submit('Submit', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default', 'role' => 'button']) }}

	{{ Form::token().Form::close() }}
</div>
@stop



@section('javascript')

<script>
$('#likeBtnArea').click(function(){
	var likecheckbox = $('#likeBtn');
	var likelabel = $('#likeBtnLabel');
	var dislikecheckbox = $('#dislikeBtn');
	var dislikelabel = $('#dislikeBtnLabel');


	var ischecked = !likecheckbox.prop('checked');
	likecheckbox.prop('checked', ischecked);

	dislikecheckbox.prop('checked', !ischecked);
	if(ischecked){
		$(this).attr("style", "border-color: green");
		likelabel.attr("style", "color: green");

		$("#dislikeBtnArea").attr("style", "border-color: rgb(204, 204, 204)");
		dislikelabel.attr("style", "color: rgb(51, 51, 51)");
	}
	else{
	}
});

$('#dislikeBtnArea').click(function(){
	var likecheckbox = $('#likeBtn');
	var likelabel = $('#likeBtnLabel');
	var dislikecheckbox = $('#dislikeBtn');
	var dislikelabel = $('#dislikeBtnLabel');


	var ischecked = !dislikecheckbox.prop('checked');
	dislikecheckbox.prop('checked', ischecked);

	likecheckbox.prop('checked', !ischecked);
	if(ischecked){
		$(this).attr("style", "border-color: red");
		dislikelabel.attr("style", "color: red");

		$("#likeBtnArea").attr("style", "border-color: rgb(204, 204, 204)");
		likelabel.attr("style", "color: rgb(51, 51, 51)");
	}
	else{
	}
});

</script>
@stop