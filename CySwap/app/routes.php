<?php







/*
 Header/footer links
*/

Route::get('/', function()
{
	return View::make('home');
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
	return View::make('isbnexample');
});