<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class MiscellaneousPost extends Eloquent {
	protected $connection = 'mysql';
	protected $table = 'category_miscellaneous';
}