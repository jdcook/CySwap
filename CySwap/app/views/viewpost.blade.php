@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>{{$posting['title']}}</h1>
	<hr />
</div>

<div id="postImages" class="col-md-3">
		<img src="{{asset('media/logo.jpg')}}" />
		<p>Poster: {{array_get($posting, 'user')}}</p>
		<p>ratings</p><br/><br/>
		<p>Suggested Price: {{array_get($posting, 'suggested_price')}}</p>
		<p><a class="btn btn-default" href="{{URL::to('home')}}" role="button">Contact Seller »</a></p>
</div>

<div class="col-md-6">
	<div class="entry">
	@foreach($posting as $key => $value)
	@if($key != "posting_id" and $key != "tags" and $key != "able_to_delete" and $key != "hide_post" and $key != "title"
		and $key != "description" and $key != 'user' and $key != "suggested_price" and $key != 'num_images' and
		!is_null($value))
		<p class="detailHeading">
			{{$key}} : {{$value}}
		</p>
	@endif
	@endforeach

	@for($i = 0; $i < $posting['num_images']; $i++)
		<img src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_{{$i}}.jpg" width=20 height=20 alt="DAMN"/>
	@endfor

	{{array_get($posting, 'description');}}

	</div>
</div>



@stop
