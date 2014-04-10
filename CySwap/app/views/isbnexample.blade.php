@extends('layoutmain')

@section('content')

<?php

// Access key (obtain one by creating a free account at: https://isbndb.com/account/create.html, and enter it here. It will not work without the access key.)
$accessKey = "C3LF8KRN";

$query = "0764524984";

?>

@if ($query)

<?php	
	// Urls
	$url_details = "http://isbndb.com/api/books.xml?access_key=$accessKey&results=details&index1=isbn&value1=$query";
	
	// API lookup ISBN value at isbndb.com
	//$xml_prices = @simplexml_load_file($url_prices) or die ("no file loaded") ;
	$xml_details = @simplexml_load_file($url_details) or die ("no file loaded") ;
	
	// Parse Data
	$isbn = $xml_details->BookList[0]->BookData[0]['isbn'] ;
	$title = $xml_details->BookList[0]->BookData[0]->Title ;
	$authors = $xml_details->BookList[0]->BookData[0]->AuthorsText ;
	$publisher = $xml_details->BookList[0]->BookData[0]->PublisherText ;
?>

@endif

<h1>Book Example</h1>
<hr>

<!-- will be dynamically generated later -->
<div class="entry">
	<h4>{{$title}}</h4>
	<div class="row">
		<div class="col-md-5">	
			<img src="http://covers.openlibrary.org/b/isbn/{{$isbn}}-M.jpg" alt="no image"/>
		</div>
		<div class="col-md-6 details">
			<p><b>ISBN:</b> {{$isbn}}</p>
			<p><b>Authors:</b> {{$authors}}</p>
			<p><b>Publisher:</b> {{$publisher}}</p>
			<p><b>Description:</b> TODO</p>
		</div>
	</div>
</div>

@stop