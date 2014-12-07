@extends('layoutmain')

@section('content')

<h1>{{ucfirst($category)}}</h1>
<hr>
<div class="col-md-4 container-fluid">
	<?php 
		$i=0; 
		$j=1;
		$totalPosts = count($postingLites);
		$numCols = 3;
	?>
	@foreach($postingLites as $posting)
		@if($i > $totalPosts * $j / $numCols)
</div>
<div class="col-md-4 container-fluid">
		@endif
		<div class="entry" data-postid="{{$posting['posting_id']}}">
			<div class="row">
				<h4>{{htmlentities($posting['title'])}}</h4>
			</div>
			<br/>
			<div class="row">
				<div class="col-lg-3">	
					@if($posting['num_images'] == 0)
						<span class="entryimg notfound glyphicon glyphicon-picture"></span>
					@else
						<img class="entryimg liteimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details cliptext">
					@if(array_key_exists('description', $posting))
						<p><b>Description:</b> {{htmlentities($posting['description'])}}</p>
					@endif
				</div>
			</div>
		</div>
		<?php $i++; ?>
	@endforeach
</div>
@stop