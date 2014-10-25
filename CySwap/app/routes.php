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

Route::get('myaccount', function(){
	$numpages = Input::get("page", 1);
	$data = App::make('User')->getProfileInfo(Session::get('user'), $numpages);
	return View::make('myaccount')->with('data', $data);
});

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
Route::post('search_results', 'SearchController@postResults');
Route::get('search_results', 'SearchController@getResults');

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
	if(Session::has('user'))
		return View::make('postitem');
	else
		return View::make('Account/login');

});

Route::get('postItem/{isbn}', function($isbn)
{
	$isbn_data = App::make('IsbnController')->isbndb_request($isbn);
	return View::make('postitem')->with('isbn_data', $isbn_data);
});

Route::post('postItem', 'PostController@postItem');
Route::post('emailContact', 'EmailController@emailContact');
Route::post('emailBuyer', 'EmailController@emailBuyer');
Route::post('rateBuyer', 'RateController@rateBuyer');


Route::get('/finishedEmail', function(){
	return View::make('finishedEmail');
});

Route::get('/rateBuyer/{user}/{postid}', function($user, $postid){
	$data = array('user'=>$user, 'postid'=>$postid);
	return View::make('rateBuyer')->with('data', $data);
});
