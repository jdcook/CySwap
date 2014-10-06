<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('mail', function()
{
	Mail::send('emails.welcome', array(), function($message)
	{
		/*sender will be a new netid such as cyswap@iastate.edu*/
		$message->sender('kabernsj@iastate.edu', 'Kyle Johnson')
		/*to the poster of the item*/
		->to('jdcook@iastate.edu', 'jdcook')
		->subject('Welcome!')
		/*the potential buyer's netid*/
		->replyTo('jaredc35@gmail.com', 'jaredc35');
	});
	return View::make('mail');
});

Route::get('users', function()
{
	$users = User::all();
	
	DB::update('update users set banned = 1 where username = ?', array('kabernsj'));
		
	$updatedusers = User::all();
	
	DB::update('update users set banned = 0 where username = ?', array('kabernsj'));
	
	/*    Other Useful mySQL Statements
	For more select statements than you'd ever care to know, go here: http://laravel.com/docs/queries
	
	(note that update and delete statements return the number of rows affected by the operation)
	delete:
	DB::table('users')->where('username', '=', 'armlessArcher')->delete(); 
	update:
	DB::update('update users set banned = 1 where username = ?', array('kabernsj'));
	
	insert:
	DB::insert('insert into users (username, usertype, moderator, banned) values (?, ?, ?, ?)', array('armlessArcher', 1, 0, 0));
	*/
	
	return View::make('users')->with('users', $users)->with('updatedusers', $updatedusers);
});
