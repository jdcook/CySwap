	<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/** model that interacts with posts stored in database **/
class Category extends Eloquent {

	public function getCategories()
	{
		$result = DB::select("select * from CySwap2.category order by category_name");
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

		$category_config = DB::select("Select * from CySwap2.".$tableName." order by field_order");

		return $category_config;
	}

	public function createCategory($post_params) {
		//check to make sure category doesn't exist
		$category = DB::select("select * from CySwap2.category where category_name = '".$post_params["categoryName"]."'");
		if ($category != "") {
			//category already exists
			return 0;
		}

		//create category_CATEGORYNAME_config table
		DB::statement('
		CREATE TABLE IF NOT EXISTS cyswap2.category_'.$post_params["categoryName"].'_config` (
  		`field_name` CHAR(50) NOT NULL,
 		 `is_searchable` TINYINT(1) NOT NULL DEFAULT \'0\',
  		`is_required` TINYINT(1) NOT NULL DEFAULT \'0\',
 		 `character_limit` SMALLINT(4) NOT NULL,
  		`field_order` TINYINT(4) NOT NULL,
 		 PRIMARY KEY (`field_name`, `field_order`))');

		//fill category_CATEGORYNAME_config table
		DB::insert('insert into cyswap2.category_'.$post_params["categoryName"].'_config values (?, ?, ?, ?, ?)', array("Title", 1, 1, 255, 1));
		if ($post_params["hasCondition"] == 'Yes') {

		}

		$i = 0;
		while ($i < $post_params["counter"]) {

			$i++;
		}

		//add category to category table used for app to know which categories exist
		DB::insert('insert into cyswap2.category values (?)', array($post_params["counter"]));

		//create category_CATEGORYNAME used for storing posting data specific to this category
		$query = "CREATE TABLE IF NOT EXISTS cyswap2\.category_".$post_params["categoryName"]." (";
		$i = 0;
		while ($i < $post_params["counter"]) {

			$i++;
		}

		DB::statement($query);
		return 1;
	}

}
