@extends('layoutmain')

@section('content')


<h1>Miscellaneous</h1>
<hr>

<div class="row">
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