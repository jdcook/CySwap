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
			echo "<input class=\"form-control upload-form-control\" id=\"picture".$i."\" type=\"file\" name=\"picture".$i."\"";
			if($i != 1)
			{
				echo " style=\"display:none;\"";
			}
			echo ">";
		}

		foreach($fields as $field)
		{
			$fieldID = $field->field_name;
			$field->field_name = str_replace('_', ' ', $field->field_name);
			$field->field_name = ucwords($field->field_name);
			if($field->field_name == "Description")
			{
				continue;
			}
			if($field->field_name == "Isbn 10")
			{
				echo "<div id=\"failureMsg\"></div>";
			}
			echo "<div class=\"input-group detail\">";
			echo "<span class=\"input-group-addon\"><label for=\"".$field->field_name."\">".$field->field_name."</label></span>";
			if($field->field_name == "Item Condition")
			{

				echo "<select class=\"form-control\" name=\"".$field->field_name."\">";
				echo "<option name=\"none\">--</option>";
				echo "<option name=\"poor\">Poor</option>";
				echo "<option name=\"used\">Used</option>";
				echo "<option name=\"good\">Good</option>";
				echo "<option name=\"new\">New</option>";
				echo "</select>";
			}
			else
			{
				echo "<input class=\"form-control\" name=\"".$field->field_name."\" type=\"text\" value=\"\" id=\"".$fieldID."\" maxlength=\"".$field->character_limit."\">";
			}
			if($field->field_name == "Isbn 10")
			{
				echo "<a id=\"isbnPopBtn\" class=\"input-group-addon btn btn-blue\" data-loading-text=\"Loading...\">Look Up</a>";
			}
			echo "</div>";
		}

		echo "<div class=\"detail\">";
		echo "<span class=\"input-group-addon textareaLabel\"><label for=\""."Description"."\">"."Description"."</label></span>";
		echo "<textarea class=\"form-control description\" name=\""."Description"."\" type=\"text\" value=\" \" id=\""."Description"."\"></textarea>";
		echo "</div>";

		echo "<input class=\"form-control\" name=\""."Category"."\" type=\"hidden\" value=\"".$category."\" id=\""."Category"."\">";

		echo "<a> <input class=\"btn btn-default btn-hugeSubmit\" role=\"button\" type=\"submit\" value=\"Submit Post\"> </a>";

		return;
	}
	/**END AJAX**/

	public function createCategory(){
		echo "weeeeeeeeee";
	}
}
