<?php

/*
 Header/footer links
*/

Route::get('/', function()
{
	return Redirect::to('/index.php');
});

Route::get('categories', function()
{
	return View::make('categories');
});


Route::get('safety', function()
{
	return View::make('safety');
});

Route::get('about', function()
{
	return View::make('about');
});

Route::get('copyright', function()
{
	return View::make('copyright');
});

Route::get('legaljargon', function()
{
	return View::make('termsofuse');
});

Route::get('report', function()
{
	return View::make('report');
});

Route::get('contact', function()
{
	return View::make('contact');
});

Route::get('isbnexample', function()
{
	$isbn_data = App::make('IsbnExampleController')->isbndb_request("0764524984");
	return View::make('isbnexample')->with('isbn_data', $isbn_data);
});