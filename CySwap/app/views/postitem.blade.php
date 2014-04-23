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


	<div id="textbookDetails">
		<div class="input-group detail">
		  <span class="input-group-addon">Title</span>
		  <input type="text" class="form-control"
		  value="@if(isset($isbn_data) and $isbn_data != null){{$isbn_data["title"]}}@endif">
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">ISBN</span>
		  <input id="isbnInput" type="text" class="form-control" 
		  value="@if(isset($isbn_data) and $isbn_data != null){{$isbn_data["isbn"]}}@endif">
		  <a id="isbnPopBtn" class="input-group-addon" href="#">Auto Populate</a>
		</div>

		<div class="input-group detail">
		  <span class="input-group-addon">Author</span>
		  <input type="text" class="form-control"
		  value="@if(isset($isbn_data) and $isbn_data != null)
		  	{{$isbn_data["authors"]}}
		  @endif">
		</div>
	</div>

	<div class="detail">
		Description:
		<input type="textarea" class="form-control description"
		value="@if(isset($isbn_data) and $isbn_data != null){{$isbn_data["publisher"]}}@endif">
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

$('#isbnPopBtn').click(function(e){
	window.location.href="{{URL::to('postItem')}}/" + $('#isbnInput').attr("value");
	e.preventDefault();
});

</script>
@stop