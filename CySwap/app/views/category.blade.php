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
			<h4>{{htmlentities($posting['title'])}}</h4>
			<div class="row">
				<div class="col-md-3">	
					@if($posting['num_images'] == 0)
						<span class="entryimg notfound glyphicon glyphicon-picture"></span>
					@else
						<img class="entryimg liteimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
					@endif
				</div>
				<div class="col-md-9 details cliptext">
					@foreach($posting as $key => $field)
						@if(!is_null($field) and $key != "posting_id" and $key != "num_images")
							<p><b>{{ucfirst($key)}}:</b> {{htmlentities($field)}}</p>
						@endif
					@endforeach
				</div>
			</div>
		</div>
		<?php $i++; ?>
	@endforeach
</div>
@stop