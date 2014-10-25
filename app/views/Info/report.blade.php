@extends('layoutmain')

@section('content')

<div class="col-md-12">
	<br/>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		Category of Offense
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="#">Misplaced post</a></li>
		<li><a href="#">Offensive or vulgar language</a></li>
		<li><a href="#">Illegal item</a></li>
		<li><a href="#">Other</a></li>
	</ul>
</div>

<div class="col-md-12">
	<input type="textarea" style="width: 20em; height: 20em;margin-top: 1em;"></input>
</div>

@stop