@extends('layoutmain')

@section('content')


<h1>Home</h1>
<hr>

<div class="row">
	<div class="col-md-6 container-fluid">


		<h2>Textbooks</h2>


		@for($i = 0; $i < 4; $i++)
		@if(isset($postingLites['textbook'][$i]))
			<div class="entry" data-postid="{{$postingLites['textbook'][$i]->posting_id}}">
				<div class="row">
					<h4>{{$postingLites['textbook'][$i]->title}}</h4>
				</div>
				<br/>
				<div class="row">
					<div class="col-sm-3">	
						@if($postingLites['textbook'][$i]->num_images != 0)
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['textbook'][$i]->posting_id}}_0.jpg" />
						@endif
					</div>
					<br/>
					<div class="col-sm-9 details">
						@if(!is_null($postingLites['textbook'][$i]->author))
							<p><b>Author:</b> {{$postingLites['textbook'][$i]->author}}</p>
						@endif
						@if(!is_null($postingLites['textbook'][$i]->isbn_10))
							<p><b>ISBN-10:</b> {{$postingLites['textbook'][$i]->isbn_10}}</p>
						@endif
						@if(!is_null($postingLites['textbook'][$i]->isbn_13))
							<p><b>ISBN-13:</b> {{$postingLites['textbook'][$i]->isbn_13}}</p>
						@endif
						@if(!is_null($postingLites['textbook'][$i]->condition))
							<p><b>Condition:</b> {{$postingLites['textbook'][$i]->condition}}</p>
						@endif
					</div>
				</div>
			</div>
		@endif
		@endfor


	</div>

	<div class="col-md-6 container-fluid">


		<h2>Miscellaneous</h2>
		@for($i = 0; $i < 4; $i++)
		@if(isset($postingLites['miscellaneous'][$i]))
			<div class="entry" data-postid="{{$postingLites['miscellaneous'][$i]->posting_id}}">
				<div class="row">
					<h4>{{$postingLites['miscellaneous'][$i]->title}}</h4>
				</div>
				<br/>
				<div class="row">
					@if($postingLites['miscellaneous'][$i]->num_images == 0)
					<div class="col-sm-3">
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites['miscellaneous'][$i]->posting_id}}_0.jpg" />
						@endif
					</div>
					<br/>
					<div class="col-sm-9 details">
						@if(!is_null($postingLites['miscellaneous'][$i]->condition))
							<p><b>Condition:</b> {{$postingLites['miscellaneous'][$i]->condition}}</p>
						@endif
						@if(!is_null($postingLites['miscellaneous'][$i]->description))
							<p><b>Description:</b> {{$postingLites['miscellaneous'][$i]->description}}</p>
						@endif
					</div>
				</div>
			</div>
		@endif
		@endfor


	</div>
</div>

@stop