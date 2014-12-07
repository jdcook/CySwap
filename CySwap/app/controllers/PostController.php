<?php

/**Controller that governs interactions between the view and model that puts and pulls postings from the database**/
class PostController extends BaseController {

	/**interacts with Post class to get required post information to be displayed
	* @param $postid: posting id to get from database
	* @ret array representing post**/
	public function getPost($postid)
	{
		$posting = App::make('Post')->getPost($postid);
		if(!$posting){
			return null;
		}

		//old line that I edited, did I cause a bug
		//$configData = DB::select("SELECT * from CySwap2.category_".$posting['category']."_config where character_limit != '0'");
		$configData = DB::select("SELECT * from CySwap2.category_".$posting['category']."_config");
		$config = array();
		foreach($configData as $data){
			$config[$data->field_name] = $data;
		}
		$posting['config'] = $config;
		return $posting;
	}

	/**uses post class to post item in database. then uses post class to get the
	* just created post**/
	public function postItem()
	{
		//get form input
		$post_params = Input::get();

		//check is post size limit was exceeded
		if(empty($post_params))
		{
			return View::make('postsize');
		}

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

		$postid = 0;
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
		//$posting = App::make('PostController')->getPost($postid);

		//make the view for newly posted item
		//return View::make('viewpost')->with('posting', $posting);
		return Redirect::to('/viewpost/'.$postid);
	}

	public function updatePost(){
		//echo "UPDATE CySwap2.category_".htmlentities(Input::get('category'))." set ".Input::get('key')." = ".Input::get('value')." where posting_id = ".Input::get('postid');\
		$postid = Input::get('postid');

		if(App::make('User')->canUserEdit($postid)){
			DB::update("UPDATE CySwap2.category_".htmlentities(Input::get('category'))." set `".Input::get('key')."` = ? where posting_id = ?", array(Input::get('value'), $postid));
		}
	}

	public function replaceImages(){

		$postid = Input::get('postid');
		if(App::make('User')->canUserEdit($postid)){

			$category = Input::get('category');
			//remove images from server
			App::make('Post')->deletePostImages($postid, $category);

			$image = array();
			//upload new
			for($i = 1; $i < 11; $i++)
			{
				$laravel_file_name = "picture".$i;
				if(Input::hasFile($laravel_file_name))
				{
					//validate files
					$size = Input::file($laravel_file_name)->getSize();
					$extension = strtolower(Input::file($laravel_file_name)->getClientOriginalExtension());
					if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension == "bmp")
					{
						$extension_supported = true;
					}
					if(Input::file($laravel_file_name)->isValid() && $size < 15728640 /*15MB*/ && isset($extension_supported))
					{
						$image[$i] = Input::file($laravel_file_name);
					}
				}
				else
				{
					break;
				}
			}

			$num_images = App::make('Post')->uploadImages($postid, $image);
			DB::update("UPDATE CySwap2.category_".$category." set num_images = ? where posting_id = ?", array($num_images, $postid));
		}
		return Redirect::to('/viewpost/'.$postid);
	}


	public function cleanDB(){
		$dbResult = DB::select("SELECT posting_id, category from CySwap2.posting where hide_post = '1'");

		foreach($dbResult as $post){
			DB::delete("DELETE from CySwap2.category_".$post->category." where posting_id = ?", array($post->posting_id));
			DB::delete("DELETE from CySwap2.posting where posting_id = ?", array($post->posting_id));
		}
	}

	/*public function purgeDB(){
		$dbResult = DB::select("SELECT posting_id, category from CySwap2.posting");

		foreach($dbResult as $post){
			DB::delete("DELETE from CySwap2.category_".$post->category." where posting_id = ?", array($post->posting_id));
			DB::delete("DELETE from CySwap2.posting where posting_id = ?", array($post->posting_id));
		}
	}*/

}
