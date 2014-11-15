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

		echo "Upload Picture";

		for($i = 1; $i <= 10; $i++)
		{
			echo "<input id=\"picture".$i."\" type=\"file\" name=\"picture".$i."\"";
			if($i != 1)
			{
				echo " style=\"display:none;\"";
			}
			echo ">";
		}

		foreach($fields as $field)
		{
			echo "<div class=\"input-group detail\">";
			echo "<span class=\"input-group-addon\"><label for=\"".$field->field_name."\">".$field->field_name."</label></span>";
			echo "<input class=\"form-control\" name=\"".$field->field_name."\" type=\"text\" value=\" \" id=\"".$field->field_name."\">";
			if($field->field_name == "isbn_10")
			{
				echo "<a id=\"isbnPopBtn\" class=\"input-group-addon btn\" data-loading-text=\"Loading...\">Look Up</a>";
			}
			echo "</div>";
		}

		echo "<a> <input class=\"btn btn-default btn-hugeSubmit\" role=\"button\" type=\"submit\" value=\"Submit Post\"> </a>";

		return;
	}
	/**END AJAX**/
}
