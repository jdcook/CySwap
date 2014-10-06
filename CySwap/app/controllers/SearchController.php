<?php

class SearchController extends BaseController {

	public function postResults() {
		$keyword = Input::get('keyword');

		//use model to run query
		$textbook_posts = TextbookPost::where('tags', 'LIKE', '%'.$keyword.'%')->paginate(2);
		//$misc_posts = MiscellaneousPost::where('tags', 'LIKE', '%'.$keyword.'%')->paginate(2);
		

		//place data into array
		//$to_view = array('posts' => $posts);
		$to_view = array('textbook_posts' => $textbook_posts);
		//$to_view = array_add($to_view, 'misc_posts', $misc_posts);
		$to_view = array_add($to_view, 'keyword', $keyword);

		//return array to view named 'search'
		return View::make('search', $to_view);
	}

	public function getResults() {

		$keyword = Input::get('keyword');

		//use model to run query
		$textbook_posts = TextbookPost::where('tags', 'LIKE', '%'.$keyword.'%')->paginate(2);
		//$misc_posts = MiscellaneousPost::where('tags', 'LIKE', '%'.$keyword.'%')->paginate(2);
		

		//place data into array
		//$to_view = array('posts' => $posts);
		$to_view = array('textbook_posts' => $textbook_posts);
		//$to_view = array_add($to_view, 'misc_posts', $misc_posts);
		$to_view = array_add($to_view, 'keyword', $keyword);

		//return array to view named 'search'
		return View::make('search', $to_view);
	}
}