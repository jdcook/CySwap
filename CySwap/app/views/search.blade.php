@extends('layoutmain')

@section('content')

	<h1>Search Results</h1>
	<hr>

<?php $posts = $results->getItems(); ?>
	@if(isset($posts) && !empty($posts))
		@foreach($posts as $post)
			<div class="col-md-6 container-fluid">
				<div class="entry" data-postid="{{$post['posting_id']}}">
					<div class="row">
						<h2>{{$post['title']}}</h2>
					</div>

					<div class="col-sm-3">
						@if($post['num_images'] == 0)
							<img class="entryimg" src="{{asset('media/notAvailable.jpg')}}" />
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$post['posting_id']}}_0.jpg" />
						@endif
					</div>

					<br/>
					<div class="col-sm-9 details">
						<p><b>Title:</b> {{$post['title']}}</p>
						<p><b>Description:</b> {{$post['description']}}</p>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<p>Sorry, no results were found.</p>
	@endif

	<br>

	{{ $results->links()}}


@stop
