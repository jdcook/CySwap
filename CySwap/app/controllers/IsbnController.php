<?php

class IsbnController extends BaseController {

	/**ISBNDB request controller
	* @param $query: isbn to use to query isbndb.com database
	* @ret array("isbn", "title", "authors", "publisher") **/
	public function isbndb_request($query)
	{
		// ISU http proxy
		$Proxy = getenv("http://proxy.its.iastate.edu:6969");

      	if (strlen($Proxy) > 1) {
        	$r_default_context = stream_context_get_default ( array
                		('http' => array(
                        	'proxy' => $Proxy,
                        	'request_fulluri' => True,
                    	),
                	)
            	);
       	 	libxml_set_streams_context($r_default_context);
      	}

		// ISBNDB Access key
		$accessKey = "C3LF8KRN";

		if ($query):

			// query url
			$url_details = "http://isbndb.com/api/books.xml?access_key=$accessKey&results=details&index1=isbn&value1=$query";

			// API lookup ISBN value at isbndb.com
			$xml_details = simplexml_load_file($url_details) or die ("no file loaded") ;

			try
			{
				// Parse Data
				$isbn = $xml_details->BookList[0]->BookData[0]['isbn'];
				$isbn13 = "978".$xml_details->BookList[0]->BookData[0]['isbn'];
				$title = $xml_details->BookList[0]->BookData[0]->Title;
				$authors = $xml_details->BookList[0]->BookData[0]->AuthorsText ;
				$publisher = $xml_details->BookList[0]->BookData[0]->PublisherText ;
				$edition = $xml_details->BookList[0]->BookData[0]->Details['edition_info'] ;
			} catch(Exception $e)
			{
				$isbn = $query;
				$isbn13 = null;
				$title = null;
				$authors = null;
				$publisher = null;
				$edition = null;
			}

			//insert parsed data into index ret array
			$ret = array("isbn" => $isbn, "isbn13" => $isbn13, "title" => $title, "authors" => $authors, "publisher"
				=> $publisher, "edition" => $edition);

			//return successfully
			return $ret;
		endif;

		//if no query was provided return NULL
		return NULL;
	}

}
