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
	$data = App::make('User')->getProfileInfo(Session::get('user'));
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

Route::get('terms', function()
{
	return View::make('terms');
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

Route::get('termsofuse', function()
{
	return View::make('Info/termsofuse');
});


Route::get('contact', function()
{
	return View::make('Info/contact');
});

/* report */
Route::get('report/{postId}', function($postId)
{
	if(Session::has('user'))
	{
		$data = array();
		$data['postuser'] = App::make('Post')->getPostUser($postId);
		$data['postId'] = $postId;
		return View::make('report')-> with('data',$data);
	}
	else
	{
		return View::make('Account/login');
	}
});

/* categories */
Route::get('category/{category}', function($category)
{
	$postingLites = App::make('CategoryController')->showCategoryData(htmlentities($category));
	return View::make('category')->with('postingLites', $postingLites)->with('category', $category);
});

Route::get('categories', function()
{
	$categoryOptions = App::make('CategoryController')->getCategories();
	return View::make('categories')->with('categoryOptions', $categoryOptions);
});

/* Posts */
Route::get('viewpost/{postid}', function($postid)
{
	$posting = App::make('PostController')->getPost($postid);
	if(!$posting){
		return Redirect::to('postNotFound');
	}
	return View::make('viewpost')->with('posting', $posting);
});

Route::get('postNotFound', function(){
	return View::make('postNotFound');
});

Route::get('postItem', function()
{
	if(Session::has('user'))
	{
		$categories = App::make('CategoryController')->getCategories();
		return View::make('postitem')->with('categories', $categories);
	}
	else
		return View::make('Account/login');

});

Route::get('category_fields', function()
{
	$category = $_GET['category'];
	if(Request::ajax())
	{
		App::make('CategoryController')->getCategoryFields_AJAX($category);
		return;
	}
});

Route::get('get_users', function()
{
	$user = $_GET['user'];
	if(Request::ajax())
	{
		App::make('UserController')->getUsers($user);
	}
});

Route::get('close_issue', function()
{
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin" || $usertype == "moderator"){
			App::make('ReportController')->closeReport(Input::get('id'));
		}
	}
	echo "done";
});

Route::post('alter_post', function(){
	if(Request::ajax()){
		App::make('PostController')->updatePost();
	}
});

Route::get('postItem/{isbn}', function($isbn)
{
	$isbn_data = App::make('IsbnController')->isbndb_request($isbn);
	return View::make('postitem')->with('isbn_data', $isbn_data);
});

Route::post('acceptTerms', 'LoginController@acceptTerms');
Route::post('postItem', 'PostController@postItem');
Route::post('beginTransaction', 'TransactionController@beginTransaction');
Route::post('completeTransaction', 'TransactionController@completeTransaction');
Route::post('rateBuyer', 'RateController@rateBuyer');
Route::post('reportPost', 'ReportController@reportPost');
Route::post('suspendUser', 'UserController@suspendUser');
Route::post('banUser', 'UserController@banUser');
Route::post('unBanUser', 'UserController@unBanUser');
Route::post('replaceImages', 'PostController@replaceImages');
Route::post('createCategory', 'CategoryController@createCategory');


//update terms routes
Route::post('/updateTermsOfUse', 'UpdateContentController@updateTermsOfUse');
Route::post('/updateContactUs', 'UpdateContentController@updateContactUs');
Route::post('/updateAboutUs', 'UpdateContentController@updateAboutUs');
Route::post('/updateSafety', 'UpdateContentController@updateSafety');


Route::get('/outputMessage', function(){
	return View::make('outputMessage');
});

Route::get('/rateBuyer/{user}/{postid}', function($user, $postid){
	$data = array('user'=>$user, 'postid'=>$postid);
	return View::make('rateBuyer')->with('data', $data);
});

Route::get('/adminArea', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin" || $usertype == "moderator"){
			return View::make('adminArea');
		}
	}
	return Redirect::to('/');
});

Route::get('/viewReports', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin" || $usertype == "moderator"){
			return View::make('viewReports')->with('reports', App::make('Report')->getReports());
		}
	}
	return Redirect::to('/');
});

Route::get('/addCategory', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin"){
			return View::make('addCategory');
		}
	}
	return Redirect::to('/');
});

Route::get('/removeCategory', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin"){
			return View::make('removeCategory');
		}
	}
	return Redirect::to('/');
});

Route::get('/updateContent', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin"){
			return View::make('updateContent');
		}
	}
	return Redirect::to('/');
});

Route::get('/manageUsers', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin" || $usertype == "moderator"){
			return View::make('manageUsers');
		}
	}
	return Redirect::to('/');
});


Route::get('/cleanDB', function(){
	if(Session::has('usertype')){
		$usertype = Session::get('usertype');
		if($usertype == "admin" || $usertype == "moderator"){
			App::make('PostController')->cleanDB();
			echo "done";
		}
	}
});