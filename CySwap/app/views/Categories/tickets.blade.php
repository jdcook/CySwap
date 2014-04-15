@extends('layoutmain')

@section('content')


<h1>Tickets</h1>
<hr>

<div class="row">
	<div class="col-md-4">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Sort By
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#">Date Posted</a></li>
			<li><a href="#">Date of Event</a></li>
			<li><a href="#">Event Type</a></li>
		</ul>
	</div>


	<div class="col-md-6 container-fluid">
		<!-- will be dynamically generated later -->
		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-5">	
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-6 details">
					<p><b>Detail 1:</b> Things and stuff</p>
					<p><b>Detail 2:</b> Things and stuff</p>
					<p><b>Detail 3:</b> Things and stuff</p>
					<p><b>Detail 4:</b> Things and stuff</p>
				</div>
			</div>
		</div>

		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-5">
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-6 details">
					<p><b>Detail 1:</b> Things and stuff</p>
					<p><b>Detail 2:</b> Things and stuff</p>
					<p><b>Detail 3:</b> Things and stuff</p>
					<p><b>Detail 4:</b> Things and stuff</p>
				</div>
			</div>
		</div>




		<!-- will be dynamically generated later -->
		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-5">
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-6 details">
					<p><b>Detail 1:</b> Things and stuff</p>
					<p><b>Detail 2:</b> Things and stuff</p>
					<p><b>Detail 3:</b> Things and stuff</p>
					<p><b>Detail 4:</b> Things and stuff</p>
				</div>
			</div>
		</div>
		
		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-5">
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-6 details">
					<p><b>Detail 1:</b> Things and stuff</p>
					<p><b>Detail 2:</b> Things and stuff</p>
					<p><b>Detail 3:</b> Things and stuff</p>
					<p><b>Detail 4:</b> Things and stuff</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop