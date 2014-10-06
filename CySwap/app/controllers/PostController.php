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

	/**uses post class to post item in database. then uses post class to get the
	* just created post**/
	public function postItem()
	{
		//get form input
		$post_params = Input::get();

		//use model to make post
		$postid = App::make('Post')->postItem($post_params);

		//use get post controller function to get the created post
		$posting = App::make('PostController')->getPost($postid);

		//make the view for newly posted item
		return View::make('viewpost')->with('posting', $posting);
	}
}
