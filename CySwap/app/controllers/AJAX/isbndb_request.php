<?php
	if(isset($_GET['isbn']))
	{
		$query = $_GET['isbn'];
		// ISU http proxy (COMMENT OUT IF WORKING ON LOCAL HOST...)
		$Proxy = "tcp://proxy.its.iastate.edu:6969";
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

		if ($query)
		{
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
				echo $isbn;
				echo ",";
				echo $isbn13;
				echo ",";
				echo $title;
				echo ",";
				echo $authors;
				echo ",";
				echo $publisher;
				echo ",";
				echo $edition;

			} catch(Exception $e)
			{
				$isbn = $query;
				$isbn13 = null;
				$title = null;
				$authors = null;
				$publisher = null;
				$edition = null;
				echo "NULL";
			}
		}
		else
		{
			echo "NULL";
		}
	}
?>
