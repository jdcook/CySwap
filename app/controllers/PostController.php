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

	public function postItem()
	{
		$postid = str_random(10);
		DB::insert('insert into CySwap.postings (posting_id, user, date, category, able_to_delete, hide_post) values (?, ?, ?, ?, ?, ?)',
			array($postid, Session::get('user'), date('Y-m-d'), 'textbook', 1, 0));
		DB::insert('insert into CySwap.category_textbook (posting_id, title, isbn_10, isbn_13, author, publisher, edition, subject, description, CySwap.category_textbook.condition, tags, suggested_price, num_images) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
			array($postid, Input::get('Title'), substr(Input::get('ISBN13'), 3, 10), Input::get('ISBN13'), Input::get('Author'), Input::get('Publisher'), Input::get('Edition'), 'Math', Input::get('Description'), Input::get('Condition'), null, Input::get('Suggested Price'), 0));
		$posting = App::make('PostController')->getPost($postid);
		return View::make('viewpost')->with('posting', $posting);
	}
}
