@extends('layoutmain')

@section('content')


	<h1>Textbooks</h1>
	<hr>


<div class="row">
<!--
	<div class="col-md-4">
		<div class="input-group">
		  <span class="input-group-addon">Search ISBN</span>
		  <input type="text" class="form-control">
		</div>
		<br>
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Sort By
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><a href="#">Date Posted</a></li>
			<li><a href="#">Author</a></li>
			<li><a href="#">Title</a></li>
		</ul>
	</div>
-->

	<div class="col-md-8">

		<!-- will be dynamically generated later -->
		<div class="entry" data-postid="D6815A6A34">
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
		<div class="entry" data-postid="D6815A6A34">
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
		<div class="entry" data-postid="D6815A6A34">
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
		<div class="entry" data-postid="D6815A6A34">
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