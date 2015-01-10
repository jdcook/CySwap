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
		$post = DB::select('select * from cyswap2.posting where posting_id = \''.$postid.'\' limit 0,1');
		if(!count($post))
		{
			return null;
		}
		// save category of post to find extra fields
		$category = $post[0]->category;

		// get full posting
		$category_info = DB::select('select * from cyswap2.category_'.$category.' where posting_id = \''.$postid.
			'\' limit 0,1');

		// cast data to array for easy processing
		$post_array = array_merge((array) $post[0], (array) $category_info[0]);


		$dbResult = App::make('User')->getUsernames($post_array['username']);

		$post_array['positive']=$dbResult[0]->positive;
		$post_array['negative']=$dbResult[0]->negative;

		// return post array
		return $post_array;
	}


	public function getPostingLites($category, $number_of_postings)
	{
		$postingLites = array();

		$postingids = DB::select("SELECT posting_id from CySwap2.posting where category = '".$category."' and hide_post = 0 order by date DESC limit ".intval($number_of_postings));


		foreach($postingids as $postingIdObj) {
			$postingidstr = $postingIdObj->posting_id;
			//$postingLites[$postingidstr] = DB::select('select posting_id, title, author, isbn_10, isbn_13, cyswap.category_textbook.condition, num_images from cyswap.category_textbook where posting_id = '."'".$postingidstr."'")[0];
			$result = DB::select("SELECT * from CySwap2.category_".$category." where posting_id = ?", array($postingidstr));

			//check to make sure something came back
			if(count($result)){
				$postingLites[$postingidstr] = $result[0];
			}
			else{
				//didn't find a post with that id in that category, so delete that posting
				DB::delete('DELETE from CySwap2.posting where posting_id = ?', array($postingidstr));
			}
		}

		foreach ($postingLites as  $key => $value) {
			$postingLites[$key] = (array) $value;
		}

		//$data['posts'] = Paginator::make(array_slice($topaginate, (Input::get("page", 1) - 1) * 3, 3), $total, 3);

		return $postingLites;
	}


	public function getPaginatedLites($category, $numPerPage)
	{
		$postingLites = array();

		$totalQuery = DB::select("SELECT COUNT(*) AS total from CySwap2.posting where category = ? and hide_post = 0", array($category));
		$totalPosts = 0;
		if(count($totalQuery)){
			$totalPosts = $totalQuery[0]->total;
		}

		$pageNum = Input::get('page', 1);
		$postingids = DB::select("SELECT posting_id from CySwap2.posting where category = ? and hide_post = 0 order by date DESC limit ?, ?", array($category, ($pageNum - 1) * $numPerPage, $numPerPage));


		foreach($postingids as $postingIdObj) {
			$postingidstr = $postingIdObj->posting_id;
			//$postingLites[$postingidstr] = DB::select('select posting_id, title, author, isbn_10, isbn_13, cyswap.category_textbook.condition, num_images from cyswap.category_textbook where posting_id = '."'".$postingidstr."'")[0];
			$result = DB::select("SELECT * from CySwap2.category_".$category." where posting_id = ?", array($postingidstr));

			//check to make sure something came back
			if(count($result)){
				$postingLites[$postingidstr] = $result[0];
			}
			else{
				//didn't find a post with that id in that category, so delete that posting
				DB::delete('DELETE from CySwap2.posting where posting_id = ?', array($postingidstr));
			}
		}

		foreach ($postingLites as  $key => $value) {
			$postingLites[$key] = (array) $value;
		}

		return Paginator::make($postingLites, $totalPosts, $numPerPage);
	}

	public function postItem($post_params, $image)
	{
		//generate random postid
		$postid = str_random(10);

		//while we don't have a unique id, generate a new one
		//if we have 1 million posts, there is a 10% chance of conflict
		//max of 10 million posts
		$idConflict = $this->checkIdConflict($postid);
		while($idConflict){
			$postid = str_random(10);
			$idConflict = $this->checkIdConflict($postid);
		}

		$num_images = $this->uploadImages($postid, $image);

		//variables to construct database arguments (query string and array of values)
		$db_string = "insert into Cyswap2.category_".$post_params['Category']." (posting_id, ";
		$db_tailer = "?, ";
		$db_array = array();
		$db_array[0] = $postid;

		$tag_string = "insert into Cyswap2.tags (posting_id, category, ";
		$tag_tailer = "?, ?, ";
		$tag_array = array();
		$tag_array[0] = $postid;
		$tag_array[1] = $post_params['Category'];

		$tableName = "Cyswap2.category_".$post_params['Category']."_config";
		//query for searchable categories
		$searchable = DB::select("select field_name from ".$tableName." where is_searchable = '1'");
		$searchable_array = array();

		foreach($searchable as $index=>$object)
		{
			$searchable_array[$index] = $object->field_name;
		}

		//loop through post parameters and construct database parameters
		$i = 1;
		$tagCount = 2;
		$isSearchable = false;
		foreach($post_params as $param=>$value)
		{
			$param = strtolower($param);
			$param = str_replace(' ', '_', $param);


			//get character limit; chop off characters that exceed it
			//(assuming there was client-side prevention; this is just in case the user is tricksy)
			$charLimitQuery = DB::select("select character_limit from ".$tableName." where field_name = ?", array($param));
			$characterLimit = 16;
			if(count($charLimitQuery))
			{
				$characterLimit = $charLimitQuery[0]->character_limit;
			}
			if($characterLimit && strlen($value) > $characterLimit)
			{
				$value = substr($value, 0, $characterLimit);
			}

			//lazy profanity filter- looked through/grabbed most common words from https://github.com/shutterstock/List-of-Dirty-Naughty-Obscene-and-Otherwise-Bad-Words/blob/master/en
			//not sure how strict to be, could get pretty involved
			$value = preg_replace("(fuck|shit|anal|asshole|bitch|faggot|pussy)", "#$@%", $value);

			//
			if($param == "_token" || $param == "category")
			{
				continue;
			}

			foreach($searchable_array as $field_name)
			{
				if($field_name == $param)
				{
					$isSearchable = true;
				}
			}

			if($i > 1)
			{
				$db_string = $db_string.", ";
				$db_tailer = $db_tailer.", ";
			}

			$db_string = $db_string."`".$param."`";
			$db_tailer = $db_tailer."?";
			$db_array[$i] = $value;

			if($isSearchable)
			{
				if($value != "")
				{
					if($tagCount == 12)
					{
						$i++;
						$isSearchable = false;
						continue;
					}

					if($i > 1)
					{
						$tag_string = $tag_string.", ";
						$tag_tailer = $tag_tailer.", ";
					}

					$tag_string = $tag_string."tag".($tagCount-1);
					$tag_tailer = $tag_tailer."?";
					$tag_array[$tagCount++] = $value;
				}
			}

			$i++;
			$isSearchable = false;
		}

		$db_array[$i] = $num_images;
		$db_string = $db_string.", num_images) values (".$db_tailer.", ?)";

		$tag_string = $tag_string.") values (".$tag_tailer.")";


		DB::beginTransaction();

		try {
			//insert posting lite into table
			DB::insert('insert into CySwap2.posting (posting_id, username, date, category, hide_post) values (?, ?, ?, ?, ?)',
				array($postid, Session::get('user'), date('Y-m-d'), $post_params['Category'], 0));

			//insert posting into table
			DB::insert($db_string, $db_array);

			//insert tags
			DB::insert($tag_string, $tag_array);

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}


		//return the randomly generated post id
		return $postid;
	}

	public function uploadImages($postid, $image){
		$num_images = 0;
		//if an image was provided move it to the correct location in file system
		if(isset($image))
		{
			foreach($image as $index => $imageToStore)
			{
				$i = $index - 1;
				$imageToStore->move("./media/post_images", $postid."_".$i.".jpg");
				$num_images++;
			}
		}
		return $num_images;
	}

	public function deletePostImages($postid, $category){
		$num_images = DB::select("SELECT num_images from CySwap2.category_".$category." where posting_id = ?", array($postid));

		if(count($num_images)){
			//remove images from server
			for($i = 0; $i < $num_images[0]->num_images; $i++)
			{
				$filename = "./media/post_images/".$postid."_".$i.".jpg";
				if (File::exists($filename)) {
	    			File::delete($filename);
				}
			}
		}
	}

	private function checkIdConflict($id){
		$result = DB::select("SELECT * from CySwap2.posting where posting_id = ?", array($id));
		return count($result);
	}

	public function deletePost($postid)
	{
		if(!ctype_alnum($postid)){
			echo "invalid post id";
			return;
		}
		$category = DB::select("SELECT category from CySwap2.posting where posting_id = ?", array($postid));
		if(count($category)){
			DB::delete('delete from cyswap2.tags where posting_id = ?', array($postid));
			DB::update('update cyswap2.posting set hide_post = ? where posting_id = ?', array(1, $postid));

			$this->deletePostImages($postid, $category[0]->category);
		}
	}

	public function getPostUser($postid){
		$dbResult = DB::select("SELECT username from CySwap2.posting where posting_id = ?", array($postid));
		if(count($dbResult)){
			return $dbResult[0]->username;
		}
		return "";
	}
}
