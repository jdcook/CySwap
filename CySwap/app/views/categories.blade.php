@extends('layoutmain')

@section('content')

<h1>Categories</h1>
<hr>
<div id="categories">
	<div class="col-md-4">
          <p><a class="btn btn-default" href="{{URL::to('textbooks')}}" role="button">Textbooks »</a></p>
    </div>

	<div class="col-md-4">
          <p><a class="btn btn-default" href="{{URL::to('tickets')}}" role="button">Tickets »</a></p>
    </div>

	<div class="col-md-4">
          <p><a class="btn btn-default" href="{{URL::to('misc')}}" role="button">Misc »</a></p>
    </div>
</div>
@stop