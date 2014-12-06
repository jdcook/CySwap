@extends('layoutmain')

@section('content')

<!--initialize php variables to know when we have created buttons for links in alphabetical order-->
<?php
	$printedLease = 0;
	$printedRide = 0;
?>

<h1>Categories</h1>
<hr>
<div id="categories">
@foreach($categoryOptions as $category)
	@if(strcasecmp($category, "Ames Rent") > 0 && $printedLease == 0)
		<div class="col-md-4">
        	<a class="btn btn-default" href="http://www.amesrent.com" role="button">Ames Rent »</a>
    	</div>
    	<?php
    		$printedLease = 1;
    	?>
	@endif
	@if(strcasecmp($category, "Ride Share") > 0 && $printedRide == 0)
		<div class="col-md-4">
        	<a class="btn btn-default" href="http://www.rideshare.gsb.iastate.edu" role="button">Ride Share »</a>
    	</div>
    	<?php
    		$printedRide = 1;
    	?>
	@endif
	<div class="col-md-4">
          <a class="btn btn-default" href="{{URL::to('category/'.$category)}}" role="button"><?php $category = ucfirst($category);?> {{$category}} »</a>
    </div>
@endforeach
</div>
@stop
