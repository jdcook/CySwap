@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>{{$posting['title']}}</h1>
	<hr />
</div>

<div id="postImages" class="col-md-4">
	@if($posting['num_images'] == 0)
		<img class="entryimg" src="{{asset('media/notfound.png')}}" />
	@else
		<img class="entryimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
	@endif
	<div class="price">
		@for($i = 0; $i < $posting['num_images']; $i++)
			<img src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_{{$i}}.jpg" width=20 height=20 alt="DAMN"/>
		@endfor
		<p><b>Suggested Price:</b><br/> {{$posting['suggested_price']}}</p>
		<p><b>Poster:</b><br/> {{$posting['user']}}</p><br/>
	<p><a class="btn btn-default" href="{{URL::to('home')}}" role="button">Contact Seller</a></p>
	</div>
</div>

<div class="col-md-6">
	<div class="detailContainer">
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
