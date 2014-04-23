@extends('layoutmain')

@section('content')


<h1>Home</h1>
<hr>

<div class="row">
	<div class="col-md-6 container-fluid">


		<h2>Textbooks</h2>
		<div class="entry" data-postid="{{$postingLites['textbook'][0]->posting_id}}">
			<h4>{{$postingLites['textbook'][0]->title}}</h4>
			<div class="row">
				<div class="col-md-3">	
					@if($postingLites['textbook'][0]->num_images == 0)
						<img class="entryimg" src="{{asset('media/notfound.png')}}" />
					@else
						<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['textbook'][0]->posting_id}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details">
					@if(!is_null($postingLites['textbook'][0]->author))
						<p><b>Author:</b> {{$postingLites['textbook'][0]->author}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][0]->isbn_10))
						<p><b>ISBN-10:</b> {{$postingLites['textbook'][0]->isbn_10}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][0]->isbn_13))
						<p><b>ISBN-13:</b> {{$postingLites['textbook'][0]->isbn_13}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][0]->condition))
						<p><b>Condition:</b> {{$postingLites['textbook'][0]->condition}}</p>
					@endif
				</div>
			</div>
		</div>
		<div class="entry" data-postid="{{$postingLites['textbook'][1]->posting_id}}">
			<h4>{{$postingLites['textbook'][1]->title}}</h4>
			<div class="row">
				<div class="col-md-3">	
					@if($postingLites['textbook'][1]->num_images == 0)
						<img class="entryimg" src="{{asset('media/notfound.png')}}" />
					@else
						<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['textbook'][1]->posting_id}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details">
					@if(!is_null($postingLites['textbook'][1]->author))
						<p><b>Author:</b> {{$postingLites['textbook'][0]->author}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][1]->isbn_10))
						<p><b>ISBN-10:</b> {{$postingLites['textbook'][0]->isbn_10}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][1]->isbn_13))
						<p><b>ISBN-13:</b> {{$postingLites['textbook'][0]->isbn_13}}</p>
					@endif
					@if(!is_null($postingLites['textbook'][1]->condition))
						<p><b>Condition:</b> {{$postingLites['textbook'][0]->condition}}</p>
					@endif
				</div>
			</div>
		</div>

	</div>


	<div class="col-md-6 container-fluid">


		<h2>Miscellaneous</h2>
		<div class="entry" data-postid="{{$postingLites['miscellaneous'][0]->posting_id}}">
			<h4>{{$postingLites['miscellaneous'][0]->title}}</h4>
			<div class="row">
				<div class="col-md-3">	
					@if($postingLites['miscellaneous'][0]->num_images == 0)
						<img class="entryimg" src="{{asset('media/notfound.png')}}" />
					@else
						<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['miscellaneous'][0]->posting_id}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details">
					@if(!is_null($postingLites['miscellaneous'][0]->condition))
						<p><b>Condition:</b> {{$postingLites['miscellaneous'][0]->condition}}</p>
					@endif
					@if(!is_null($postingLites['miscellaneous'][0]->description))
						<p><b>Description:</b> {{$postingLites['miscellaneous'][0]->description}}</p>
					@endif
				</div>
			</div>
		</div>
		<div class="entry" data-postid="{{$postingLites['miscellaneous'][1]->posting_id}}">
			<h4>{{$postingLites['miscellaneous'][1]->title}}</h4>
			<div class="row">
				<div class="col-md-3">	
					@if($postingLites['miscellaneous'][1]->num_images == 0)
						<img class="entryimg" src="{{asset('media/notfound.png')}}" />
					@else
						<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['miscellaneous'][1]->posting_id}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details">
					@if(!is_null($postingLites['miscellaneous'][1]->condition))
						<p><b>Condition:</b> {{$postingLites['miscellaneous'][0]->condition}}</p>
					@endif
					@if(!is_null($postingLites['miscellaneous'][1]->description))
						<p><b>Description:</b> {{$postingLites['miscellaneous'][0]->description}}</p>
					@endif
				</div>
			</div>
		</div>



	</div>
</div>

@stop