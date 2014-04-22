@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>{{$posting['title']}}</h1>
	<hr />
</div>

<div>
	<div id="postImages" class="col-md-3">
			<p>Username</p><br/>
			<p>ratings</p>
			<img src="{{asset('media/logo.jpg')}}" />
			<p>Suggested Price</p>
			<p><a class="btn btn-default" href="{{URL::to('home')}}" role="button">Contact Seller »</a></p>
	</div>

@foreach($posting as $key => $value)
@if($key != "posting_id" and $key != "tags" and $key != "able_to_delete" and $key != "hide_post" and $key != "title"
	and !is_null($value))
	<div class="col-md-3 postDetail">
		{{$key}} : {{$value}}
	</div>
@endif
@endforeach

</div>

<div>
	Comments
</div>
@stop
