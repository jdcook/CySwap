@extends('layoutmain')

@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="col-md-12">
	<h1>Post An Item</h1>
	<hr>
</div>

<?php
$accepted = 0;
if(Session::has('accepted_terms') && Session::get('accepted_terms')){
	$accepted = 1;
}
?>


@if(!$accepted)
	<p class="alert centered">You have to accept the Terms of Use before posting an item.</p>
	<a class="btn btn-default accept termsBtn" href="{{URL::to('terms')}}">Terms of Use</a>
@else

<div class="col-md-4">
	Category:<br/>
	<div class="btn-group categoryButton" data-toggle="buttons">
	  <label id="textbookButton" class="btn btn-primary">
	    <input type="radio" name="options" id="option1"> Textbook
	  </label>
	  <!--
	  <label class="btn btn-primary">
	    <input type="radio" name="options" id="option2"> Ticket
	  </label>
	-->
	  <label id="miscButton" class="btn btn-primary">
	    <input type="radio" name="options" id="option3"> Miscellaneous
	  </label>
	</div>

	{{ Form::open(array('action' => array('PostController@postItem'), 'files'=>true)) }}

	<div id="textbookDetails">
		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Title')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('Title', $isbn_data["title"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('Title', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div id="isbnLookupFailedDiv">
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('ISBN')}}</span>
		  <input id="isbnInput" type="text" class="form-control"
		  value="@if(isset($isbn_data) and $isbn_data != null){{$isbn_data['isbn']}}@endif">
		  <a id="isbnPopBtn" class="input-group-addon">Auto Populate</a>
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('ISBN13')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('ISBN13', $isbn_data["isbn13"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('ISBN13', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Author')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('Author', $isbn_data["authors"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('Author', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Publisher')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('Publisher', $isbn_data["publisher"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('Publisher', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Edition')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('Edition', $isbn_data["edition"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('Edition', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Condition')}}</span>
		  	{{Form::text('Condition', '', ['class' => 'form-control'])}}
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Suggested Price')}}</span>
		  	{{Form::text('Suggested Price', '', ['class' => 'form-control'])}}
		</div>
	</div>

	<div class="detail">
		<span class="input-group-addon textareaLabel">{{Form::label('Description')}}</span>
		{{Form::textarea('Description', '', ['class' => 'form-control description'])}}
	</div>
</div>

<div class="col-md-8">
	Upload Picture
	<input type="file" name="picture">
	<br />
</div>


<div class="col-md-12">
	<a> {{ Form::submit('Submit Post', ['class' => 'btn btn-default btn-hugeSubmit', 'role' => 'button']) }} </a>
</div>

{{ Form::token().Form::close() }}

@endif



@stop

@section('javascript')

<script>
$('#textbookButton').click();

$('#textbookButton').click(function(){
	$('#textbookDetails').show();
});

$('#miscButton').click(function(){
	$('#textbookDetails').hide();
});

$('#isbnPopBtn').click(function(){
	value = $('#isbnInput').attr("value");
	//window.location.href="../app/controllers/AJAX/isbndb_request.php?isbn="+value;
	$.ajax ({
		type: 'GET',
		url: "../app/controllers/AJAX/isbndb_request.php?isbn="+value,
		data: value,
		success: function(result)
		{
			if(result.indexOf(value) > -1)
			{
				$('#isbnLookupFailedDiv').html("");
				var isbn_data = result.split(',');
				$('#isbnInput').val(isbn_data[0]);
				$('#ISBN13').val(isbn_data[1]);
				$('#Title').val(isbn_data[2]);
				$('#Author').val(isbn_data[3]);
				$('#Publisher').val(isbn_data[4]);
				$('#Edition').val(isbn_data[5]);
			}
			else
			{
				$('#isbnLookupFailedDiv').html("<p class=\"alert\">ISBN Lookup Failed: invalid isbn</p>");
			}
		}
	});

	//window.location.href="{{URL::to('postItem')}}/" + $('#isbnInput').attr("value");
	//e.preventDefault();
});

</script>
@stop
