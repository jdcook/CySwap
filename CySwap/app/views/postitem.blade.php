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

		<select id="categorySelect" class="form-control" name="categoryDropdown">
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
			setHooks();
		}
	})
});

function setHooks(){
	$('#isbnPopBtn').click(function(){
		$('#failureMsg').html("");
		$(this).button('loading');
		var value = $('#isbn_10').val();
					$('#failureMsg').html("");
		$.ajax ({
			type: 'GET',
			url: "../app/controllers/AJAX/isbndb_request.php?isbn="+value,
			data: value,
			success: function(result)
			{
				$('#isbnPopBtn').button('reset');
				//$('#failureMsg').html(result);
				if(result.indexOf(value) > -1)
				{
					if(result.indexOf('xdebug-error') > -1)
					{
						$('#failureMsg').html("<p class=\"alert\">ISBN Lookup Failed: connection timed out</p>");	
					}
					else
					{
						var isbn_data = result.split(',');
						$('#isbn_10').val(isbn_data[0]);
						$('#isbn_13').val(isbn_data[1]);
						$('#title').val(isbn_data[2]);
						$('#author').val(isbn_data[3]);
						$('#publisher').val(isbn_data[4]);
						$('#edition').val(isbn_data[5]);
					}
				}
				else
				{
					$('#failureMsg').html("<p class=\"alert\">ISBN Lookup Failed: invalid isbn</p>");
				}
			}
		});
	});

	$('[data-picture]').on('change', function(){
		$('[data-picture='+(parseInt($(this).data('picture')) + 1)+']').css('display', 'block');
	});

	$('#submitBtn').click(function(e){
		$('.requiredAlert').remove();

		done = false;
		$('[data-required=1]').each(function(){
			if(!$(this).val() || $(this).val() == '--')
			{
				$(this).parent().before("<span class='alert requiredAlert'><br/><b>* Required Field</b></span>");
				
				if(!done)
				{
					done = true;
				    $('html, body').animate(
				    	{scrollTop: $('#categorySelect').offset().top - 100},
				     	250);
					
					e.preventDefault();
				}
			}
		})
	});
}
var done = false;
</script>
@stop
