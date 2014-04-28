@extends('layoutmain')

@section('content')

<h1>Categories</h1>
<hr>
<div id="categories">
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('category/textbooks')}}" role="button">Textbooks »</a>
    </div>

	<!--<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('category/tickets')}}" role="button">Tickets »</a>
    </div>
-->
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('category/miscellaneous')}}" role="button">Miscellaneous »</a>
    </div>
</div>
@stop