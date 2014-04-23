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

<?php
	$isbn_data = App::make('IsbnExampleController')->isbndb_request("0764524984");

?>

	<div id="textbookDetails">
		<div class="input-group detail">
		  <span class="input-group-addon">ISBN</span>
		  <input type="text" class="form-control">
		</div>

		<div class="input-group detail">
			
			{{$isbn_data["authors"]}}
		  <span class="input-group-addon">Author</span>
		  <input type="text" class="form-control">
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">Other Details</span>
		  <input type="text" class="form-control">
		</div>
	</div>

	<div class="detail">
		Description:
		<input type="textarea" class="form-control description">
	</div>
</div>

<div class="col-md-8">
	Upload Pictures
	<input type="file" name="picupload[]">
	<input type="file" name="picupload[]">
	<input type="file" name="picupload[]">
</div>


<div class="col-md-12">	
	<a id="postButton" class="btn btn-default" href="{{URL::to('textbooks')}}" role="button">Submit Post</a>
</div>





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

</script>
@stop