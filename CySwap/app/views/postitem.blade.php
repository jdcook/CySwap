@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<h1>Post Title</h1>
	<hr>
</div>

<div>
	<div id="postImages" class="col-md-3">
			<p>Username</p><br/>
			<p>ratings</p>
			<img src="{{asset('media/logo.jpg')}}" />
			<p>Suggested Price</p>
			<p><a class="btn btn-default" href="{{URL::to('home')}}" role="button">Contact Seller »</a></p>

	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
	<div class="col-md-3 postDetail">
		placeholder
	</div>
</div>

<div>
	Comments
</div>
@stop