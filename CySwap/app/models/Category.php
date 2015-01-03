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

	public function removeCategory($categoryName) {
		
	}

	public function createCategory($post_params) {

		//lowercase all characters and replace spaces with underscores
		$categoryName = strtolower($post_params["categoryName"]);
		$categoryName = str_replace(" ","_",$categoryName);

		//check to make sure category doesn't exist
		$category = DB::select("select * from CySwap2.category where category_name = '".$categoryName."'");
		if (!empty($category)) {
			return 0;
		}


		DB::beginTransaction();

		try {

			//create category_CATEGORYNAME_config table
			DB::statement('CREATE TABLE IF NOT EXISTS cyswap2.category_'.$categoryName.'_config (field_name CHAR(50) NOT NULL,is_searchable TINYINT(1) NOT NULL DEFAULT \'0\',is_required TINYINT(1) NOT NULL DEFAULT \'0\',character_limit SMALLINT(4) NOT NULL, field_order TINYINT(4) NOT NULL, PRIMARY KEY (field_name, field_order))');

			//fill category_CATEGORYNAME_config table
			DB::insert('insert into cyswap2.category_'.$categoryName.'_config (field_name, is_searchable, is_required, character_limit, field_order) values (?, ?, ?, ?, ?)', array("title", 1, 1, 255, 1));
			$isSearchable = array_key_exists("fieldDescription_isSearchable", $post_params);
			$isRequired = array_key_exists("fieldDescription_isRequired", $post_params);
			$charLimit = $post_params["fieldDescription_characterLimit"];
			if ($charLimit == "") {
				$charLimit = "0";
			}
			DB::insert('insert into cyswap2.category_'.$categoryName.'_config (field_name, is_searchable, is_required, character_limit, field_order) values (?, ?, ?, ?, ?)', array("description", $isSearchable, $isRequired, $charLimit, $post_params["fieldDescription_order"]));
			//prepare script for category_CATEGORYNAME table
			$categoryTableQuery = "CREATE TABLE IF NOT EXISTS cyswap2.category_".$categoryName." (posting_id CHAR(10) NOT NULL,title CHAR(255) NOT NULL,";

			if (array_key_exists("hasCondition", $post_params)) {
				$isRequired = array_key_exists("fieldCondition_isRequired", $post_params);
				DB::insert('insert into cyswap2.category_'.$categoryName.'_config (field_name, is_searchable, is_required, character_limit, field_order) values (?, ?, ?, ?, ?)', array("item_condition", 0, $isRequired, 10, $post_params["fieldCondition_order"]));
				$categoryTableQuery = $categoryTableQuery."item_condition CHAR(10) NOT NULL,";
			}
			$i = 0;
			
			while ($i < $post_params["counter"]) {
				$fieldName = strtolower($post_params["field".$i."_fieldName"]);
				$fieldName = str_replace(" ","_",$fieldName);
				$isSearchable = array_key_exists("field".$i."_isSearchable", $post_params);
				$isRequired = array_key_exists("field".$i."_isRequired", $post_params);
				$charLimit = $post_params["field".$i."_characterLimit"];
				if ($charLimit == "") {
					$charLimit = "0";
				}
				DB::insert('insert into cyswap2.category_'.$categoryName.'_config (field_name, is_searchable, is_required, character_limit, field_order) values (?, ?, ?, ?, ?)', array($fieldName, $isSearchable, $isRequired, $charLimit, $post_params["field".$i."_order"]));
				
				//prepare script for category_CATEGORYNAME table
				$charLimit = "";
				if ($post_params["field".$i."_characterLimit"] == "") {
					$charLimit = "TEXT ";
				} else {
					$charLimit = "CHAR(".$post_params["field".$i."_characterLimit"].") ";
				}
				$required = "";
				if ($isRequired) {
					$required = "NOT NULL, ";
				} else {
					$required = "NULL DEFAULT NULL, ";
				}
				$categoryTableQuery = $categoryTableQuery."`".$fieldName."` ".$charLimit.$required;
				$i++;
			}

			DB::insert('insert into cyswap2.category_'.$categoryName.'_config (field_name, is_searchable, is_required, character_limit, field_order) values (?, ?, ?, ?, ?)', array("suggested_price", 0, 0, 10, $i));


			$categoryTableQuery = $categoryTableQuery."description TEXT NULL DEFAULT NULL,suggested_price CHAR(10) NULL DEFAULT NULL,num_images TINYINT(4) NOT NULL DEFAULT '0',PRIMARY KEY (posting_id), CONSTRAINT category_".$categoryName."_ibfk_1 FOREIGN KEY (posting_id) REFERENCES cyswap2.posting (posting_id))";

			//add category to category table used for app to know which categories exist
			DB::insert('insert into cyswap2.category values (?)', array($categoryName));

			//create category_CATEGORYNAME used for storing posting data specific to this category
			DB::statement($categoryTableQuery);

		} catch (Exception $e) {
			DB::rollback();
			return 0;
		}
		return 1;
	}

}
