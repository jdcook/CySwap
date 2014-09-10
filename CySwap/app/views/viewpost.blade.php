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
		@if(Session::has('user'))

			<!-- if the poster is the same as the current user, let them mark as complete -->
			@if(Session::get('user') == $posting['user'])
				<p><b>Poster:</b><br/> {{$posting['user']}} (me)</p><br/>
				<p><a id="markCompleteBtn" data-toggle="collapse" data-target='#markCompletePanel' class="btn btn-default" role="button">Mark Transaction Complete</a></p>
				<div class='panel-collapse collapse' id="markCompletePanel">
					mark as complete panel
				</div>

			<!-- otherwise, show contact seller button -->
			@else
				<p><b>Poster:</b><br/> {{$posting['user']}}</p><br/>
				<p><a id="contactSellerBtn" data-toggle="collapse" data-target='#closeme' class="btn btn-default" role="button">Contact Seller</a></p>

				<div class='panel-collapse collapse' id="closeme">
					<textarea>contact seller panel</textarea>
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
</script>
@stop
