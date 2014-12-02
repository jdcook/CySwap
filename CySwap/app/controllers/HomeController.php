<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showData()
	{
		$category1_name = 'textbook';
		$category1 = App::make('Post')->getPostingLites($category1_name, 5);
		$category2_name = 'miscellaneous';
		$category2 = App::make('Post')->getPostingLites($category2_name, 5);
		$postingLites =  array($category1_name=>$category1,$category2_name=>$category2);
		return $postingLites;
	}

}