@extends('layoutmain')

@section('content')

<h1>Book Example</h1>
<hr>

<!-- will be dynamically generated later -->
<div class="entry">
	<h4>{{{$isbn_data["title"]}}}</h4>
	<div class="row">
		<div class="col-md-5">	
			<img src="http://covers.openlibrary.org/b/isbn/{{$isbn_data["isbn"]}}-M.jpg" alt="no image"/>
		</div>
		<div class="col-md-6 details">
			<p><b>ISBN:</b> {{{$isbn_data["isbn"]}}}</p>
			<p><b>Authors:</b> {{{$isbn_data["authors"]}}}</p>
			<p><b>Publisher:</b> {{{$isbn_data["publisher"]}}}</p>
			<p><b>Description:</b> TODO</p>
		</div>
	</div>
</div>

@stop