<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class Post extends Eloquent {

	/**gets a posting given a posting ID
	 * @param $postid: id of post to retrieve
	 * @ret array containing post members **/
	public function getPost($postid)
	{
		// select post with matching id from database
		$post = DB::select('select * from cyswap.postings where posting_id = \''.$postid.'\' limit 0,1');

		// save category of post to find extra fields
		$category = $post[0]->category;

		// get full posting
		$category_info = DB::select('select * from cyswap.category_'.$category.' where posting_id = \''.$postid.
			'\' limit 0,1');

		// cast data to array for easy processing
		$post_array = array_merge((array) $post[0], (array) $category_info[0]);

		// return post array
		return $post_array;
	}


	public function getPostingLites($category) 
	{
		$postingLites;
		if($category == "textbook") {
			$postingLites = DB::select('select posting_id, title, author, isbn_10, isbn_13, cyswap.category_textbook.condition, num_images from cyswap.category_textbook where posting_id in (select posting_id from cyswap.postings where category = \'textbook\' order by date DESC) limit 2 ');
		} elseif($category == "miscellaneous") {
			$postingLites = DB::select('select posting_id, title, cyswap.category_miscellaneous.condition, description, num_images from cyswap.category_miscellaneous where posting_id in (select posting_id from cyswap.postings where category = \'miscellaneous\' order by date DESC) limit 2 ');
		}
		
		return $postingLites;
	}
}