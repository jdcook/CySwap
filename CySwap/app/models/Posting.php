<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class Posting extends Eloquent {
	protected $connection = 'mysql';
	
}
