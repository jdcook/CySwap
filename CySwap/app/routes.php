<?php

/*
	Account stuff
*/
Route::get('login', function(){
	return View::make('Account/login');
});

Route::get('Account/logout', array(
			'as' => 'logout',
			'uses' => 'LoginController@getLogout'
));

Route::group(array('before' => 'guest'), function() {

	Route::group(array('before' => 'csrf'), function(){
		Route::post('Account/login', array(
			'as' => 'login-post',
			'uses' => 'LoginController@postLogin'
		));
	});

	Route::get('Account/login', array(
		'as' => 'login',
		'uses' => 'LoginController@getLogin'
	));
});

/*
	Search Link
*/
Route::post('search_results', function()
{
	$keyword = Input::get('keyword');
	
	$posts = Posting::where('user', 'LIKE', '%'.$keyword.'%')->get();

	return View::make('search')->with('posts', $posts);;
});

/*
 Home and Info Links
*/

Route::get('/', function()
{
	$postingLites = App::make('HomeController')->showData();
	return View::make('home')->with('postingLites', $postingLites);
});

Route::get('home', function(){
	$postingLites = App::make('HomeController')->showData();
	return View::make('home')->with('postingLites', $postingLites);
});

Route::get('safety', function()
{
	return View::make('Info/safety');
});

Route::get('about', function()
{
	return View::make('Info/about');
});

Route::get('copyright', function()
{
	return View::make('Info/copyright');
});

Route::get('legaljargon', function()
{
	return View::make('Info/termsofuse');
});


Route::get('contact', function()
{
	return View::make('Info/contact');
});

/* report */
Route::get('report', function()
{
	return View::make('Info/report');
});

/* categories */
Route::get('category/{category}', function($category)
{
	$postingLites = App::make('CategoryController')->showCategoryData($category);
	return View::make('category')->with('postingLites', $postingLites)->with('category', $category);
});

Route::get('categories', function()
{
	return View::make('categories');
});

/* Posts */
Route::get('viewpost/{postid}', function($postid)
{
	$posting = App::make('PostController')->getPost($postid);
	return View::make('viewpost')->with('posting', $posting);
});

Route::get('postItem', function()
{
	return View::make('postItem');
});

Route::get('postItem/{isbn}', function($isbn)
{
	$isbn_data = App::make('IsbnController')->isbndb_request($isbn);
	return View::make('postItem')->with('isbn_data', $isbn_data);
});

Route::post('postItem', 'PostController@postItem');

Route::post('contactEmail', 'EmailController@emailContact');
