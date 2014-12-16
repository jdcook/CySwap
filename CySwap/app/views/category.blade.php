@extends('layoutmain')

@section('content')

<h1>
	<?php $category = str_replace("_"," ",$category);
            $category = ucwords($category);?>{{$category}}</h1>
<hr>
@foreach($postingLites as $posting)

<a href="{{URL::to('viewpost/'.$posting['posting_id'])}}" >
<div class="col-lg-4 col-md-6 container-fluid">
	<div class="entry" data-postid="{{$posting['posting_id']}}">
		<div class="row">
			<h4>{{htmlentities($posting['title'])}}</h4>
		</div>
		<br />
		<div class="row">
			<div class="col-lg-3">
				@if($posting['num_images'] == 0)
					<span class="entryimg notfound glyphicon glyphicon-picture"></span>
				@else
					<img class="entryimg liteimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
				@endif
				<br/>
				<br/>
			</div>
			<div class="col-lg-9 details cliptext">
				@if(array_key_exists('description', $posting))
					<p><b>Description:</b> {{htmlentities($posting['description'])}}</p>
				@endif
			</div>
		</div>
	</div>
</div>
</a>
@endforeach
</div>
@stop