<?php

class IsbnController extends BaseController {

	/**ISBNDB request controller
	* @param $query: isbn to use to query isbndb.com database
	* @ret array("isbn", "title", "authors", "publisher") **/

	public function isbndb_request($query)
	{
		// ISBNDB Access key
		$accessKey = "C3LF8KRN";

		if ($query):

			// query url
			$url_details = "http://isbndb.com/api/books.xml?access_key=$accessKey&results=details&index1=isbn&value1=$query";

			// API lookup ISBN value at isbndb.com
			$xml_details = @simplexml_load_file($url_details) or die ("no file loaded") ;

			// Parse Data
			$isbn = $xml_details->BookList[0]->BookData[0]['isbn'] ;
			$title = $xml_details->BookList[0]->BookData[0]->Title ;
			$authors = $xml_details->BookList[0]->BookData[0]->AuthorsText ;
			$publisher = $xml_details->BookList[0]->BookData[0]->PublisherText ;

			//insert parsed data into index ret array
			$ret = array("isbn" => $isbn, "title" => $title, "authors" => $authors, "publisher" => $publisher);

			//return successfully
			return $ret;
		endif;

		//if no query was provided return NULL
		return NULL;
	}

}
