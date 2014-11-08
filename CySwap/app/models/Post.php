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

		// save category of post to find extra fields
		$category = $post[0]->category;

		// get full posting
		$category_info = DB::select('select * from cyswap2.category_'.$category.' where posting_id = \''.$postid.
			'\' limit 0,1');

		// cast data to array for easy processing
		$post_array = array_merge((array) $post[0], (array) $category_info[0]);

		// return post array
		return $post_array;
	}


	public function getPostingLites($category, $number_of_postings)
	{
		$postingLites = array();
		if($category == "textbooks") {
			$postingids = DB::select('select posting_id from cyswap2.posting where category = \'textbook\' and hide_post = 0 order by date DESC limit '.$number_of_postings);

			foreach($postingids as $postingIdObj) {
				$postingidstr = $postingIdObj->posting_id;
				//$postingLites[$postingidstr] = DB::select('select posting_id, title, author, isbn_10, isbn_13, cyswap.category_textbook.condition, num_images from cyswap.category_textbook where posting_id = '."'".$postingidstr."'")[0];
				$result = DB::select('select posting_id, title, author, isbn_10, isbn_13, item_condition, num_images from cyswap2.category_textbook where posting_id = '."'".$postingidstr."'");

				//check to make sure something came back
				if(count($result)){
					$postingLites[$postingidstr] = $result[0];
				}
				else{
					//didn't find a post with that id in that category, so delete that id
					DB::delete('DELETE from CySwap2.posting where posting_id = ?', array($postingidstr));
				}
			}

		} elseif($category == "miscellaneous") {
			$postingids = DB::select('select posting_id from cyswap2.posting where category = \'miscellaneous\' and hide_post = 0 order by date DESC limit '.$number_of_postings);

			foreach($postingids as $postingIdObj) {
				$postingidstr = $postingIdObj->posting_id;
				$result = DB::select('select posting_id, title, item_condition, description, num_images from cyswap2.category_miscellaneous where posting_id = '."'".$postingidstr."'");

				//check to make sure something came back
				if(count($result)){
					$postingLites[$postingidstr] = $result[0];
				}
				else{
					//didn't find a post with that id in that category, so delete that id
					DB::delete('DELETE from CySwap2.posting where posting_id = ?', array($postingidstr));
				}
			}
		}
		foreach ($postingLites as  $key => $value) {
			$postingLites[$key] = (array) $value;
		}

		return $postingLites;
	}

	public function postItem($post_params, $image)
	{
		//generate random postid
		$postid = str_random(10);
		$num_images = 0;

		//while we don't have a unique id, generate a new one
		//if we have 1 million posts, there is a 10% chance of conflict
		//max of 10 million posts
		$idConflict = $this->checkIdConflict($postid);
		while($idConflict){
			$postid = str_random(10);
			$idConflict = $this->checkIdConflict($postid);
		}

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

		//insert posting lite into table
		DB::insert('insert into CySwap2.posting (posting_id, username, date, category, hide_post) values (?, ?, ?, ?, ?)',
			array($postid, Session::get('user'), date('Y-m-d'), 'textbook', 0));

		//insert posting into table
		DB::insert('insert into CySwap2.category_textbook (posting_id, title, isbn_10, isbn_13, author, publisher, edition, subject, description, item_condition, suggested_price, num_images) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
			array($postid, $post_params['Title'], substr($post_params['ISBN13'], 3, 10), $post_params['ISBN13'], $post_params['Author'], $post_params['Publisher'], $post_params['Edition'], 'Math', $post_params['Description'], $post_params['Condition'], $post_params['Suggested_Price'], $num_images));

		//return the randomly generated post id
		return $postid;
	}

	private function checkIdConflict($id){
		$result = DB::select("SELECT * from CySwap2.posting where posting_id = ?", array($id));
		return count($result);
	}

	public function deletePost($postid)
	{
		DB::delete('delete from cyswap2.tags where posting_id = ?', array($postid));
		DB::update('update cyswap2.posting set hide_post = ? where posting_id = ?', array(1, $postid));
	}
}
