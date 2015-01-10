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
			<span class="btn btn-active">
				<?php $categoryName = str_replace("_"," ",$category);
	    		$categoryName = ucwords($categoryName);?> 
				{{$categoryName}}
			</span>
			@else
			<a class="btn btn-default" href="{{URL::to('search_results').'?keyword='.$data['keyword'].'&category='.$category}}">
				<?php $categoryName = str_replace("_"," ",$category);
	    		$categoryName = ucwords($categoryName);?> 
				{{$categoryName}}
			</a>
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
		@foreach($posts as $posting)
			<div class="col-lg-4 col-md-6 container-fluid">
				<a class="entry-link" href="{{URL::to('viewpost/'.$posting['posting_id'])}}" >
				<div class="entry" data-postid="{{$posting['posting_id']}}">
					<div class="row centered">
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