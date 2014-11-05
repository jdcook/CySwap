@extends('layoutmain')

@section('content')


<h1>Home</h1>
<hr>

<div class="row">

@foreach($postingLites as $categoryname => $category)
	<div class="col-lg-4 col-md-6 container-fluid">
		<h2 class="categoryTitle">{{ucfirst($categoryname)}}</h2>
		@foreach($category as $posting)
			<div class="entry" data-postid="{{$posting['posting_id']}}">
				<div class="row">
					<h4>{{$posting['title']}}</h4>
				</div>
				<br />
				<div class="row">
					<div class="col-lg-3">	
						@if($posting['num_images'] == 0)
							<span class="entryimg notfound glyphicon glyphicon-picture"></span>
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
						@endif
						<br/>
						<br/>
					</div>
					<div class="col-lg-9 details cliptext">
						@foreach($posting as $key => $field)
							@if(!is_null($field) and $key != "posting_id" and $key != "num_images")
								<p><b>{{ucfirst($key)}}:</b> {{$field}}</p>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endforeach
</div> 

@stop