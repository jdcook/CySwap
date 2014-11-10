@extends('layoutmain')

@section('content')

<h1>Categories</h1>
<hr>
<div id="categories">
@foreach($categoryOptions as $category)
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('category/'.$category)}}" role="button"><?php $category = ucfirst($category);?> {{$category}} »</a>
    </div>
@endforeach
</div>
@stop