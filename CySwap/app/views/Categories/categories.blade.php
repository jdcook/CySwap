@extends('layoutmain')

@section('content')

<h1>Categories</h1>
<hr>
<div id="categories">
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('textbooks')}}" role="button">Textbooks »</a>
    </div>

	<!--<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('tickets')}}" role="button">Tickets »</a>
    </div>
-->
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('misc')}}" role="button">Miscellaneous »</a>
    </div>
</div>
@stop