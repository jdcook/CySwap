<?php

/*
	Account stuff
*/
Route::get('login', function(){
	return View::make('Account/login');
});

/*
 Home and Info Links
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('home', function(){
	return View::make('home');
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
Route::get('categories', function()
{
	return View::make('Categories/categories');
});

Route::get('textbooks', function()
{
	return View::make('Categories/textbooks');
});

Route::get('tickets', function()
{
	return View::make('Categories/tickets');
});

Route::get('misc', function()
{
	return View::make('Categories/misc');
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

