@extends('layoutmain')

@section('content')


<h1>Miscellaneous</h1>
<hr>

	<h2>Miscellaneous</h2>

	<div class="col-md-6 container-fluid">
	@for($i = 0; $i < 4; $i++)
	@if(isset($postingLites[$i]))
		<div class="entry" data-postid="{{$postingLites[$i]->posting_id}}">
			<div class="row">
				<h4>{{$postingLites[$i]->title}}</h4>
			</div>
			<br/>
			<div class="row">
				@if($postingLites[$i]->num_images == 0)
				<div class="col-sm-3">
					@else
						<img class="entryimg" src="{{asset('media/post_images')}}/{{$postingLites[$i]->posting_id}}_0.jpg" />
					@endif
				</div>
				<br/>
				<div class="col-sm-9 details">
					@if(!is_null($postingLites[$i]->condition))
						<p><b>Condition:</b> {{$postingLites[$i]->condition}}</p>
					@endif
					@if(!is_null($postingLites[$i]->description))
						<p><b>Description:</b> {{$postingLites[$i]->description}}</p>
					@endif
				</div>
			</div>
		</div>
	@endif
	@endfor


	</div>
@stop