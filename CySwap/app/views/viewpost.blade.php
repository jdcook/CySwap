@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>{{$posting['title']}}</h1>
	<hr />
</div>

<div id="postImages" class="col-md-4">
	@if($posting['num_images'] == 0)
		<img class="entryimg" src="{{asset('media/notAvailable.jpg')}}" />
	@else
		<img class="entryimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
	@endif
	<div id="collapseParent" class="price">
		@for($i = 0; $i < $posting['num_images']; $i++)
			<img src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_{{$i}}.jpg" width=20 height=20 alt="ERROR"/>
		@endfor
		<p><b>Suggested Price:</b><br/> {{$posting['suggested_price']}}</p>
		
		@if(Session::has('message'))
			{{ Session::get('message') }}
		@endif
		@if(Session::has('user'))
			<!-- if the poster is the same as the current user, let them mark as complete -->
			@if(Session::get('user') == $posting['user'])
				<p><b>Poster:</b><br/> {{$posting['user']}} (me)</p><br/>
				<p><a id="markCompleteBtn" data-toggle="collapse" data-target='#markCompletePanel' class="btn btn-default" role="button">Mark Transaction Complete</a></p>
				<div class='panel-collapse collapse' id="markCompletePanel">
					{{ Form::open(array('action'=>'EmailController@emailBuyer')) }}
					{{Form::hidden('postid', $posting['posting_id'])}}
				  	<span id="textareaLabel" class="input-group-addon textareaLabel">{{Form::label('NetID of Buyer')}}</span>
					{{Form::text('buyerName', '', ['class'=>'form-control'])}}
					{{ Form::submit('Complete Transaction', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default confirmInput', 'role' => 'button']) }}<br /><br />
					<p><a style="border-color: red" class="btn btn-default" role="button">Didn't sell to iastate user</a></p>
					{{Form::token()}}
				</div>

			<!-- otherwise, show contact seller button -->
			@else
				<p><b>Poster:</b><br/> {{$posting['user']}}</p><br/>
				<p><a id="contactSellerBtn" data-toggle="collapse" data-target='#contactPanel' class="btn btn-default" role="button">Contact Seller</a></p>

				<div class='panel-collapse collapse' id="contactPanel">
					
					<p>
					<p id="confirmText">Send Email to {{$posting['user']}}</p>
						
						{{ Form::open(array('action'=>'EmailController@emailContact')) }}
						<br>


						<div class="detail">
						  <span id="textareaLabel" class="input-group-addon textareaLabel">{{Form::label('Email')}}</span>
						  	{{Form::textarea('emailText', 'Hi ' . $posting['user'] . ', I would like to buy ' . $posting['title'], 
						  	['id' => 'contactInput', 'class' => 'form-control description'])}}
						</div>

						{{Form::hidden('posterName', ''.$posting['user'])}}


						<br />

						{{ Form::submit('Send Email', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default confirmInput', 'role' => 'button']) }}

						<a id="cancelBtn" data-toggle="collapse" data-target="#contactPanel" 
						style="border-color:red" class="btn btn-default" role="button">Cancel</a>

						{{ Form::token() }}

					</form>
						
					</p>

				</div>
			@endif
		@endif
	</div>
</div>

<div class="col-md-6">
	<div class="detailContainer">
		<h2>Details</h2>
		<hr />
			@foreach($posting as $key => $value)
			@if($key != "posting_id" and $key != "tags" and $key != "able_to_delete" and $key != "hide_post" and $key != "title"
				and $key != "description" and $key != 'user' and $key != "suggested_price" and $key != 'num_images' and
				!is_null($value))
				<p><b class="detailHeading">{{$key}}:</b> {{$value}}</p>
			@endif
			@endforeach
			<br/>
			<p><b>Description:</b><br/>{{$posting['description']}}</p>
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
	$('#contactInput').val("{{'Hi ' . $posting['user'] . ', I would like to buy ' . $posting['title'] . ' (' . $posting['posting_id'] . ')'}}");
});
</script>
@stop
