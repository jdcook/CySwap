@extends('layoutmain')

@section('content')


<h1>Home</h1>
<hr>

<div class="row">
	<div class="col-md-6 container-fluid">


		<h2>Textbooks</h2>

		<!-- will be dynamically generated later -->
		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-3">	
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-9 details">
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
				<div class="col-md-3">	
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-9 details">
					<p><b>Detail 1:</b> Things and stuff</p>
					<p><b>Detail 2:</b> Things and stuff</p>
					<p><b>Detail 3:</b> Things and stuff</p>
					<p><b>Detail 4:</b> Things and stuff</p>
				</div>
			</div>
		</div>




	</div>






	<div class="col-md-6 container-fluid">


		<h2>Tickets</h2>

		<!-- will be dynamically generated later -->
		<div class="entry">
			<h4>Dynamic Entry</h4>
			<div class="row">
				<div class="col-md-3">	
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-9 details">
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
				<div class="col-md-3">	
					<img class="entryimg" src="{{asset('media/logo.jpg')}}" />
				</div>
				<div class="col-md-9 details">
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