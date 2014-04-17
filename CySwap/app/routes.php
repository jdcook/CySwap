<?php

/*
 Header/footer links
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('postItem', function()
{
	return View::make('postItem');
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

Route::get('report', function()
{
	return View::make('Info/report');
});

Route::get('contact', function()
{
	return View::make('Info/contact');
});

Route::get('isbnexample', function()
{
	$isbn_data = App::make('IsbnExampleController')->isbndb_request("0764524984");
	return View::make('isbnexample')->with('isbn_data', $isbn_data);
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