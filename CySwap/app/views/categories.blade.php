@extends('layoutmain')

@section('content')

<!--initialize php variables to know when we have created buttons for links in alphabetical order-->
<?php
	$printedLease = 0;
	$printedRide = 0;
?>

<h1>Categories</h1>
<hr>
<div id="categories" class="centered">
@foreach($categoryOptions as $category)
	@if(strcasecmp($category, "Ames Rent") > 0 && $printedLease == 0)
		<div class="col-sm-4 col-lg-3">
        	<a class="btn btn-default" href="http://www.amesrent.com">Ames Rent »</a>
    	</div>
    	<?php
    		$printedLease = 1;
    	?>
	@endif
	@if(strcasecmp($category, "Ride Share") > 0 && $printedRide == 0)
		<div class="col-sm-4 col-lg-3">
        	<a class="btn btn-default" href="http://www.rideshare.gsb.iastate.edu">Ride Share »</a>
    	</div>
    	<?php
    		$printedRide = 1;
    	?>
	@endif
	<div class="col-sm-4 col-lg-3">
          <a class="btn btn-default" href="{{URL::to('category/'.$category)}}">
            <?php $category = str_replace("_"," ",$category);
            $category = ucwords($category);?> {{$category}} »</a>
    </div>
@endforeach
</div>
@stop
