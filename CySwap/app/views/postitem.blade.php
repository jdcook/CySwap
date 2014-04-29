@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>Post An Item</h1>
	<hr>
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

	{{ Form::open(array('action' => array('PostController@postItem')) }}

	<div id="textbookDetails">
		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('Title')}}</span>
		  @if(isset($isbn_data) and $isbn_data != null)
		  	{{Form::text('Title', $isbn_data["title"], ['class' => 'form-control'])}}
		  @else
		  	{{Form::text('Title', '', ['class' => 'form-control'])}}
		  @endif
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">{{Form::label('ISBN')}}</span>
		  <input id="isbnInput" type="text" class="form-control"
		  value="@if(isset($isbn_data) and $isbn_data != null){{$isbn_data["isbn"]}}@endif">
		  <a id="isbnPopBtn" class="input-group-addon" href="#">Auto Populate</a>
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
		Description:
		<input type="textarea" class="form-control description">
	</div>
</div>

<div class="col-md-8">
	Upload Picture
	<input type="file" name="picupload[]">
</div>


<div class="col-md-12">
	<a> {{ Form::submit('Submit Post', ['id' => 'postButton', 'class' => 'btn btn-default', 'role' => 'button']) }} </a>
</div>

{{ Form::token().Form::close() }}





@stop

@section('javascript')

<script>
$('#textbookButton').click();

$('#textbookButton').click(function(){
	$('#textbookDetails').show();
});

$('#miscButton').click(function(){
	console.log("as;dlkfjasdf");
	$('#textbookDetails').hide();
});

$('#isbnPopBtn').click(function(e){
	window.location.href="{{URL::to('postItem')}}/" + $('#isbnInput').attr("value");
	e.preventDefault();
});

</script>
@stop
