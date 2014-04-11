<?php

class IsbnExampleController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function isbndb_request($query)
	{
		// Access key (obtain one by creating a free account at: https://isbndb.com/account/create.html, and enter it here. It will not work without the access key.)
		$accessKey = "C3LF8KRN";

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

			$ret = array("isbn" => $isbn, "title" => $title, "authors" => $authors, "publisher" => $publisher);

			return $ret;
		endif;
	}

}