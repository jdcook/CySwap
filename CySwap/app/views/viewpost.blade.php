@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>{{htmlentities($posting['title'])}}</h1>
	<hr />
</div>

<div id="postImages" class="col-md-4">
	@if($posting['num_images'] == 0)
		<span style="text-align: center" class="entryimg notfound glyphicon glyphicon-picture"></span>
		<br/><br/>
	@else
		<img id="image_main" class="entryimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
	@endif
	<div id="collapseParent" class="price">
		@for($i = 0; $i < $posting['num_images']; $i++)
			<img id="thumb{{$i}}" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_{{$i}}.jpg" width=20 height=20 alt="ERROR"/>
		@endfor
		<p><b>Suggested Price:</b><br/> {{htmlentities($posting['suggested_price'])}}</p>

		@if(Session::has('message'))
			{{ Session::get('message') }}
		@endif
		@if(Session::has('user'))
			<?php
			$accepted = 0;
			if(Session::has('accepted_terms') && Session::get('accepted_terms')){
				$accepted = 1;
			}
			?>
			@if(!$accepted)
				<p class="alert">You have to accept the Terms of Use before contacting a seller.</p>
				<a class="btn btn-default accept termsBtn" href="{{URL::to('terms')}}">Terms of Use</a>
			@else
				<!-- if the poster is the same as the current user, let them mark as complete -->
				@if(Session::get('user') == $posting['username'])
					<p><b>Poster:</b><br/> {{$posting['username']}} (me)</p><br/>
					<p>	<a id="markCompleteBtn" data-toggle="collapse" data-target='#markCompletePanel' class="btn btn-default center-block" role="button">Close Post</a></p>
					<div class='panel-collapse collapse wrapper' id="markCompletePanel">
						{{ Form::open(array('action'=>'TransactionController@completeTransaction')) }}
						{{Form::hidden('postid', $posting['posting_id'])}}
						{{Form::hidden('isFinishing', 'y', ['id'=>'isFinishing'])}}
						<a id='deleteBtn' class='btn btn-default center-block switch-inactive switch' role='button'>Delete Post</a>
						<a id='finishBtn' class='btn btn-default center-block positive-active switch' role='button'>Complete Transaction</a>
						<div class='panel-collapse switch' style="margin-top: 0" id='netidInput'>
					  		<span id="textareaLabel" class="input-group-addon topTextLabel">{{Form::label('NetID of Buyer')}}</span>
							{{Form::text('buyerName', '', ['id'=>'buyerName', 'class'=>'form-control'])}}
							<br/>
						</div>
						<br/>
						{{ Form::submit('Submit', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default positive-active center-block', 'role' => 'button']) }}<br /><br />
						{{Form::token()}}
					</div>

				<!-- otherwise, show contact seller button -->
				@else
					<p><b>Poster:</b><br/> {{$posting['username']}}</p><br/>
					<p><a id="contactSellerBtn" data-toggle="collapse" data-target='#contactPanel' class="btn btn-default" role="button">Contact Seller</a></p>

					<div class='panel-collapse collapse' id="contactPanel">
							<p>
							<p id="confirmText">Send Email to {{$posting['username']}}</p>

								{{ Form::open(array('action'=>'TransactionController@beginTransaction')) }}
								<br>


								<div class="detail">
								  <span id="textareaLabel" class="input-group-addon textareaLabel">{{Form::label('Email')}}</span>
								  	{{Form::textarea('emailText', 'Hi ' . $posting['username'] . ', I am interested in buying your ' . $posting['title'] . '         -'.Session::get("user") ,
								  	['id' => 'contactInput', 'class' => 'form-control description'])}}
								</div>

								{{Form::hidden('posterName', ''.$posting['username'])}}


								<br />
								<div class="col-md-6">
									{{ Form::submit('Send Email', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default positive-active center-block', 'role' => 'button']) }}
								</div>
								<div class="col-md-6">
									<a id="cancelBtn" data-toggle="collapse" data-target="#contactPanel" class="btn btn-default center-block negative-active" role="button">Cancel</a>
								</div>
								{{ Form::token().Form::close() }}
								<br/>
							</p>
					</div>
				@endif
			@endif
		@endif
	</div>
</div>

<div class="col-md-6">
	<div class="detailContainer">
		<h2>Details</h2>
		<hr />
			@foreach($posting as $key => $value)
			@if($key != "posting_id" and $key != "seller_has_rated" and $key != "buyer_has_rated" and $key != "tags"
				and $key != "hide_post" and $key != "title"
				and $key != "description" and $key != 'username' and $key != "suggested_price" and $key != 'num_images' and
				!is_null($value))
				<p><b class="detailHeading">{{$key}}:</b> {{htmlentities($value)}}</p>
			@endif
			@endforeach
			<br/>
			<p><b>Description:</b><br/>{{htmlentities($posting['description'])}}</p>
			<a style="color:red" href="{{URL::to('/report/'.$posting['posting_id'])}}">Report </a>
	</div>
</div>



@stop



@section('javascript')
<script>

$('.detailHeading').each(function(){
	var cur = $(this).html();
	var newstr = formatDetailHeading(cur);
	$(this).text(newstr);
});

function formatDetailHeading(string)
{
	var ret = string.charAt(0).toUpperCase() + string.slice(1);
	ret = ret.replace('_', ' ');
	return ret;
}

$('#cancelBtn').click(function(){
	$('#contactInput').val("{{'Hi ' . $posting['username'] . ', I would like to buy ' . htmlentities($posting['title']) . ' (' . $posting['posting_id'] . ')'}}");
});

$('#deleteBtn').click(function(){
	$('#netidInput').slideUp();
	$('#isFinishing').val('n');
	$('#finishBtn').removeClass('positive-active');
	$('#finishBtn').addClass('switch-inactive');
	$(this).removeClass('switch-inactive');
	$(this).addClass('negative-active');
});

$('#finishBtn').click(function(){
	$('#netidInput').slideDown();
	$('#isFinishing').val('y');

	$('#deleteBtn').removeClass('negative-active');
	$('#deleteBtn').addClass('switch-inactive');
	$(this).removeClass('switch-inactive');
	$(this).addClass('positive-active');

	$('#buyerName').focus();
});

$('img').click(function(){
	var image_id = $(this).attr('id');
	if(image_id.indexOf("thumb") > -1)
	{
		var match = image_id.match(/\d+/);
		var src = "{{asset('media/post_images')}}/{{$posting['posting_id']}}_"+match+".jpg";
		$('#image_main').attr("src", src);
	}
});
</script>
@stop
