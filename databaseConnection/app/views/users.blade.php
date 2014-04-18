@extends('layout')


<!-- This file uses the layout file and puts its stuff
in the content section -->
@section('content')
	Users before!
	<!-- This is assuming that this page
		was built by a route, and that it
		was given an array of values called
		"$users"; it loops through and 
		prints each "username" of "$users".

		In the route, this was specified as
		every User object we have, which
		is every row of the database "test"
		and the table "users" -->
	@foreach($users as $user)
		<!-- in these files, you alternate writing
		template code starting with '@' and just
		writing html to structure it into a page -->

		<!-- you can output variables by surrounding it
		 with double brackets like this -->
		<p>{{ $user->username }} | {{ $user->usertype }} | {{ $user->moderator }} | {{ $user->banned }}</p>	
	@endforeach
	
	Users after!
	@foreach($updatedusers as $user)
		<!-- in these files, you alternate writing
		template code starting with '@' and just
		writing html to structure it into a page -->

		<!-- you can output variables by surrounding it
		 with double brackets like this -->
		<p>{{ $user->username }} | {{ $user->usertype }} | {{ $user->moderator }} | {{ $user->banned }}</p>		
	@endforeach
	
@stop

