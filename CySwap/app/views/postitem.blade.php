@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>Post An Item</h1>
	<hr>
</div>

<div class="col-md-4">
	Category:
	<div class="btn-group detail" data-toggle="buttons">
	  <label class="btn btn-primary">
	    <input type="radio" name="options" id="option1"> Textbook
	  </label>
	  <!--
	  <label class="btn btn-primary">
	    <input type="radio" name="options" id="option2"> Ticket
	  </label>
	-->
	  <label class="btn btn-primary">
	    <input type="radio" name="options" id="option3"> Miscellaneous
	  </label>
	</div>


	<div class="input-group detail">
	  <span class="input-group-addon">ISBN</span>
	  <input type="text" class="form-control">
	</div>

	<div class="detail">
		Description:
		<input type="textarea" class="form-control description">
	</div>
</div>

<div class="col-md-4">
</div>

<div class="col-md-12">

</div>

<div class="col-md-12">

	Comments
</div>
@stop