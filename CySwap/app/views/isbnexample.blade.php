@extends('layoutmain')

@section('content')

<?php

// Access key (obtain one by creating a free account at: https://isbndb.com/account/create.html, and enter it here. It will not work without the access key.)
$accessKey = "C3LF8KRN";

// Get Post variables
$query = $_POST['query'];

if ($query):
	
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
endif;

?>

<h1>Book Example</h1>
<hr>

<!-- will be dynamically generated later -->
<div class="entry">
	<h4><?php echo $title; ?></h4>
	<div class="row">
		<div class="col-md-5">	
			<img src="http://covers.openlibrary.org/b/isbn/<?php echo $isbn; ?>-M.jpg" alt="no image"/>
		</div>
		<div class="col-md-6 details">
			<p><b>ISBN:</b> <?php echo $isbn; ?></p>
			<p><b>Authors:</b> <?php echo $authors; ?></p>
			<p><b>Publisher:</b> <?php echo $publisher; ?></p>
			<p><b>Description:</b> TODO</p>
		</div>
	</div>
</div>

<form method="post" action="isbnexample.blade.php" name="the_form">
	<b>ISBN:</b>
	<br>
	<input type="text" size="18" value="" name="query">
	<input type="submit" value="Submit" name="Submit">
	<br>
</form>

@stop