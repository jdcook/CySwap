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

		<select id="categorySelect" name="categoryDropdown">
			<option name="none">---</option>
			@for($i = 0; $i < count($categories); $i++)
				<option name="{{$categories[$i]}}">{{$categories[$i]}}</option>
			@endfor
		</select>

	</div>

	{{ Form::open(array('action' => array('PostController@postItem'), 'files'=>true)) }}

	<div id="form">

	</div>

	<br />

	{{ Form::token().Form::close() }}
</div>

@endif



@stop

@section('javascript')

<script>

$('#categorySelect').change(function() {
	selected_category = $("#categorySelect option:selected").text();
	if(selected_category == "---")
	{
		$('#form').html("");
		return;
	}

	$.ajax({
		type: 'GET',
		url: "category_fields?category="+selected_category,
		success: function(result)
		{
			$('#form').html(result);
		}
	})
});

$('#isbnPopBtn').click(function(){
	value = $('#isbn_10').attr('value');
	alert(value);

	$.ajax ({
		type: 'GET',
		url: "../app/controllers/AJAX/isbndb_request.php?isbn="+value,
		data: value,
		success: function(result)
		{
			if(result.indexOf(value) > -1)
			{
				alert(result);
				$('#isbnLookupFailedDiv').html("");
				var isbn_data = result.split(',');
				$('#isbn_10').val(isbn_data[0]);
				$('#isbn_13').val(isbn_data[1]);
				$('#title').val(isbn_data[2]);
				$('#author').val(isbn_data[3]);
				$('#publisher').val(isbn_data[4]);
				$('#edition').val(isbn_data[5]);
			}
			else
			{
				$('#isbnLookupFailedDiv').html("<p class=\"alert\">ISBN Lookup Failed: invalid isbn</p>");
			}
		}
	});
});

$('body').on('click', '.a', function (){
        alert('click!');
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
