<?php

class CategoryController extends BaseController {

	public function showCategoryData($category)
	{
		$postingLites = App::make('Post')->getPostingLites($category, '4');
		return $postingLites;
	}

	public function getCategories()
	{
		$categories = App::make('Category')->getCategories();
		return $categories;
	}

	/**AJAX**/
	public function getCategoryFields_AJAX($category)
	{
		$fields = App::make('Category')->getCategoryFields($category);

		//echo form

		foreach($fields as $field)
		{
			echo "<div class=\"input-group detail\">";
			echo "<span class=\"input-group-addon\"><label for=\"".$field->field_name."\">".$field->field_name."</label></span>";
			echo "<input class=\"form-control\" name=\"".$field->field_name."\" type=\"text\" value=\" \" id=\"".$field->field_name."\">";
			if($field->field_name == "isbn_10")
			{
				echo "<a id=\"isbnPopBtn\" class=\"input-group-addon\">Auto Populate</a>";
			}
			echo "</div>";
		}

		return;
	}
	/**END AJAX**/
}
