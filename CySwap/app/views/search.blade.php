@extends('layoutmain')

@section('content')

	<h1>Search Results</h1>
	<hr>

<?php $posts = $results->getItems(); ?>
	@if(isset($posts))
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
						@if(isset($post['author']))
							<p><b>Title:</b> {{$post['title']}}</p>
							<p><b>Author:</b> {{$post['author']}}</p>
							<p><b>ISBN_10:</b> {{$post['isbn_10']}}</p>
							<p><b>ISBN_13:</b> {{$post['isbn_13']}}</p>
							<p><b>Condition:</b> {{$post['item_condition']}}</p>
						@else
							<p><b>Title:</b> {{$post['title']}}</p>
							<p><b>Condition:</b> {{$post['item_condition']}}</p>
							<p><b>Description:</b> {{$post['description']}}</p>
						@endif
					</div>
				</div>
			</div>
		@endforeach
	@endif

	<br>

	{{ $results->links()}}


@stop
