<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class Posting extends Eloquent {
	protected $connection = 'mysql';

	public function getPost($keyword)
	{
		$posts = DB::select( DB::raw("select *, MATCH (title,description,tags) AGAINST('$keyword' IN BOOLEAN MODE) as score 
			FROM category_miscellaneous WHERE MATCH (title,description,tags) AGAINST('$keyword' IN BOOLEAN MODE) 
			ORDER BY score,title DESC"));

		return $posts;
	}
	
}
