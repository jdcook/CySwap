@extends('layoutmain')

@section('content')

	<h1>Search Results</h1>
	<hr>

<div class="col-md-12">
	<b>Filter By Category:</b>
	<div class="btn-group">
		@if(Input::has('category'))
			<a class="btn btn-default" href="{{URL::to('search_results').'?keyword='.$data['keyword']}}">None</a>
		@else
			<span class="btn btn-active">None</span>
		@endif
		@foreach($data['categories'] as $category)
			@if(Input::get('category', 'na') == $category)
			<span class="btn btn-active">{{$category}}</span>
			@else
			<a class="btn btn-default" href="{{URL::to('search_results').'?keyword='.$data['keyword'].'&category='.$category}}">{{$category}}</a>
			@endif
		@endforeach
	</div>
</div>
<br/>
<br/>
<br/>
<br/>
<?php $posts = $results->getItems(); ?>
	@if(isset($posts) && !empty($posts))
		@foreach($posts as $post)
			<div class="col-md-6 container-fluid">
				<div class="entry" data-postid="{{$post['posting_id']}}">
					<div class="row">
						<h2>{{$post['title']}}</h2>
					</div>

					<div class="col-sm-3">
						@if($post['num_images'] == 0)
							<img class="entryimg" src="{{asset('media/notAvailable.jpg')}}" />
						@else
							<img class="entryimg" src="{{asset('media/post_images')}}/{{$post['posting_id']}}_0.jpg" />
						@endif
					</div>

					<br/>
					<div class="col-sm-9 details">
						<p><b>Title:</b> {{$post['title']}}</p>
						<p><b>Description:</b> {{$post['description']}}</p>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<p>Sorry, no results were found.</p>
	@endif

	<br>

	<div class="col-md-12 centered">
	{{ $results->links()}}
	</div>


@stop


@section('javascript')
<script>
$('.pagination > li > a').click(function(e){
	window.location.href = $(this).attr('href')+addCategoryParam();
	e.preventDefault();
});

function addCategoryParam()
{
    var curURL = window.location.search.substring(1);
    var variables = curURL.split('&');
    for (var i = 0; i < variables.length; ++i) 
    {
        var param = variables[i].split('=');
        if (param[0] == 'category') 
        {
            return "&"+variables[i];
        }
    }
    return "";
}
</script>
@stop