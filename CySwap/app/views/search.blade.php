@extends('layoutmain')

@section('content')

	SEARCH
	@foreach($posts as $post)
		<br> {{$post->user}}
		<br> {{$post->category}}
	@endforeach

@stop