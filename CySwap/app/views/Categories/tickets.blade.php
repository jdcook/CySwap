@extends('layoutmain')

@section('content')


<h1>Tickets</h1>
<hr>


	<div class="col-md-6 container-fluid">

		@for($i = 0; $i < 4; $i++)
		@if(isset($postingLites[$i]))
			<div class="entry" data-postid="{{$postingLites[$i]->posting_id}}">
				<div class="row">
					<h4>{{$postingLites[$i]->title}}</h4>
				</div>
				<br/>
				<div class="row">
					<div class="col-sm-3">	
						@if($postingLites[$i]->num_images != 0)
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites[$i]->posting_id}}_0.jpg" />
						@endif
					</div>
					<br/>
					<div class="col-sm-9 details">
						@if(!is_null($postingLites[$i]->author))
							<p><b>Author:</b> {{$postingLites[$i]->author}}</p>
						@endif
						@if(!is_null($postingLites[$i]->isbn_10))
							<p><b>ISBN-10:</b> {{$postingLites[$i]->isbn_10}}</p>
						@endif
						@if(!is_null($postingLites[$i]->isbn_13))
							<p><b>ISBN-13:</b> {{$postingLites[$i]->isbn_13}}</p>
						@endif
						@if(!is_null($postingLites[$i]->condition))
							<p><b>Condition:</b> {{$postingLites[$i]->condition}}</p>
						@endif
					</div>
				</div>
			</div>
		@endif
		@endfor

	</div>
	
</div>
@stop