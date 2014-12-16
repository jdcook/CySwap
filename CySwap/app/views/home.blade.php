@extends('layoutmain')

@section('content')


<h1>Home</h1>
<hr>

@foreach($postingLites as $categoryname => $category)
		<div class="col-lg-4 col-md-6 container-fluid">
			<div class="catcol">
			<h2 class="categoryTitle centered">
				<a class="catLink" href="{{URL::to('category/'.$categoryname)}}">{{ucfirst($categoryname)}}</a>
			</h2>
			@foreach($category as $posting)
				<a href="{{URL::to('viewpost/'.$posting['posting_id'])}}" >
					<div class="entry">
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
				</a>
			@endforeach
			</div>
		</div>
@endforeach

@stop
