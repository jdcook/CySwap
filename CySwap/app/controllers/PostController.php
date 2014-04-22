<?php

/**Controller that governs interactions between the view and model that puts and pulls postings from the database**/
class PostController extends BaseController {

	/**interacts with Post class to get required post information to be displayed
	* @param $postid: posting id to get from database
	* @ret array representing post**/
	public function getPost($postid)
	{
		$posting = App::make('Post')->getPost($postid);
		return $posting;
	}

}
