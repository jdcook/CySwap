<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with tags stored in database **/
class Tags extends Eloquent {
	protected $connection = 'mysql';
	protected $table = 'tags';

	//TODO extra processing for different potential categories?
	public function getQueryString($keyword) {
		$columns = 'tag1,tag2,tag3,tag4,tag5,tag6,tag7,tag8,tag9,tag10';
		$order_by = 'score,category';
		$query = "select posting_id, MATCH ($columns) AGAINST('$keyword' IN BOOLEAN MODE) as score 
			FROM cyswap2.tags WHERE MATCH ($columns) AGAINST('$keyword' IN BOOLEAN MODE) 
			ORDER BY $order_by DESC";

		return $query;
	}

	public function getPostingIds($keyword) {
		$query = App::make('Tags')->getQueryString($keyword);

		$posts = DB::select( DB::raw($query));

		return $posts;
	}

}
