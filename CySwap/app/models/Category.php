	<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class Category extends Eloquent {

	public function getCategories()
	{
		$result = DB::select("select * from cyswap2.category");
		$categories = array();
		$i = 0;
		foreach($result as $category)
		{
			$categories[$i] = $category->category_name;
			$i++;
		}
		return $categories;
	}

	public function getCategoryFields($category)
	{
		$tableName = "category_".$category."_config";

		$category_config = DB::select("Select * from cyswap2.".$tableName." order by field_order");

		return $category_config;
	}

}
