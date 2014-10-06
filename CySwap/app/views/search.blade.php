@extends('layoutmain')

@section('content')

	<h1>Search Results</h1>
	<hr>

	@if(isset($textbook_posts))
		@foreach($textbook_posts as $tpost)
			<div class="col-md-6 container-fluid">
				<div class="entry" data-postid="{{$tpost->posting_id}}">
					<div class="row">
						<h2>{{$tpost->title}}</h2>
					</div>

					<div class="col-sm-3">	
						@if($tpost->num_images == 0)
							<img class="entryimg" src="{{asset('media/notAvailable.jpg')}}" />
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$tpost->posting_id}}_0.jpg" />
						@endif
					</div>

					<br/>
					<div class="col-sm-9 details">
						<p><b>Title:</b> {{$tpost->title}}</p>
						<p><b>Author:</b> {{$tpost->author}}</p>
						<p><b>ISBN_10:</b> {{$tpost->isbn_10}}</p>
						<p><b>ISBN_13:</b> {{$tpost->isbn_13}}</p>
						<p><b>Condition:</b> {{$tpost->condition}}</p>
					</div>
				</div>
			</div>
		@endforeach
	@endif


	@if(isset($misc_posts))
		@foreach($misc_posts as $mpost)
			<div class="col-md-6 container-fluid">
				<div class="entry" data-postid="{{$mpost->posting_id}}">
					<div class="row">
						<h2>{{$mpost->title}}</h2>
					</div>
					<div class="col-sm-3">	
						@if($mpost->num_images == 0)
							<img class="entryimg" src="{{asset('media/notAvailable.jpg')}}" />
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$tpost->posting_id}}_0.jpg" />
						@endif
					</div>

					<br/>
					<div class="col-sm-9 details">
						<p><b>Title:</b> {{$mpost->title}}</p>
						<p><b>Condition:</b> {{$mpost->condition}}</p>
						<p><b>Description:</b> {{$mpost->description}}</p>
					</div>
				</div>
			</div>
		@endforeach
	@endif

	<br>
	<?php echo $textbook_posts->links(); ?>

@stop