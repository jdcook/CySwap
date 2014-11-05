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
</div>
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

		Upload Picture
		<input id="picture1" type="file" name="picture1">
		<input id="picture2" type="file" name="picture2" style="display:none;">
		<input id="picture3" type="file" name="picture3" style="display:none;">
		<input id="picture4" type="file" name="picture4" style="display:none;">
		<input id="picture5" type="file" name="picture5" style="display:none;">
		<input id="picture6" type="file" name="picture6" style="display:none;">
		<input id="picture7" type="file" name="picture7" style="display:none;">
		<input id="picture8" type="file" name="picture8" style="display:none;">
		<input id="picture9" type="file" name="picture9" style="display:none;">
		<input id="picture10" type="file" name="picture10" style="display:none;">
		<br />
		<br />


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
		  <a id="isbnPopBtn" class="input-group-addon btn" data-loading-text="Loading...">Look Up</a>
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

	<br/>
	<a> {{ Form::submit('Submit Post', ['class' => 'btn btn-default btn-hugeSubmit', 'role' => 'button']) }} </a>

	{{ Form::token().Form::close() }}
</div>

<div class="col-md-4">
</div>


<div class="col-md-12">
	
</div>


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
	$(this).button('loading');
	value = $('#isbnInput').attr("value");

	$.ajax ({
		type: 'GET',
		url: "../app/controllers/AJAX/isbndb_request.php?isbn="+value,
		data: value,
		success: function(result)
		{
			$('#isbnPopBtn').button('reset');
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
});

$('#picture1').change(function(){
	if($('#picture1').val().indexOf("fakepath") > -1)
	{
		$('#picture2').css('display', 'block');
	}
})

$('#picture2').change(function(){
	if($('#picture2').val().indexOf("fakepath") > -1)
	{
		$('#picture3').css('display', 'block');
	}
})

$('#picture3').change(function(){
	if($('#picture3').val().indexOf("fakepath") > -1)
	{
		$('#picture4').css('display', 'block');
	}
})

$('#picture4').change(function(){
	if($('#picture4').val().indexOf("fakepath") > -1)
	{
		$('#picture5').css('display', 'block');
	}
})

$('#picture5').change(function(){
	if($('#picture5').val().indexOf("fakepath") > -1)
	{
		$('#picture6').css('display', 'block');
	}
})

$('#picture6').change(function(){
	if($('#picture6').val().indexOf("fakepath") > -1)
	{
		$('#picture7').css('display', 'block');
	}
})

$('#picture7').change(function(){
	if($('#picture7').val().indexOf("fakepath") > -1)
	{
		$('#picture8').css('display', 'block');
	}
})

$('#picture8').change(function(){
	if($('#picture8').val().indexOf("fakepath") > -1)
	{
		$('#picture9').css('display', 'block');
	}
})

$('#picture9').change(function(){
	if($('#picture9').val().indexOf("fakepath") > -1)
	{
		$('#picture10').css('display', 'block');
	}
})

</script>
@stop
