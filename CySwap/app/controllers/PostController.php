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

		$image = array();

		//check for file
		for($i = 1; $i < 11; $i++)
		{
			$laravel_file_name = "picture".$i;
			if(Input::hasFile($laravel_file_name))
			{
				//validate files
				$size = Input::file($laravel_file_name)->getSize();
				$extension = Input::file($laravel_file_name)->getClientOriginalExtension();
				if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "bmp")
				{
					$extension_supported = true;
				}
				if(Input::file($laravel_file_name)->isValid() && $size < 15728640 /*15MB*/ && isset($extension_supported))
				{
					$image[$i] = Input::file($laravel_file_name);
				}
			}
		}

		//use model to make post (checking if valid image was provided)
		if(isset($image))
		{
			$postid = App::make('Post')->postItem($post_params, $image);
		}
		else
		{
			$postid = App::make('Post')->postItem($post_params, null);
		}

		//use get post controller function to get the created post
		$posting = App::make('PostController')->getPost($postid);

		//make the view for newly posted item
		return View::make('viewpost')->with('posting', $posting);
	}
}
