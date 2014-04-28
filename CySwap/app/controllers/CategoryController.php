<?php

class CategoryController extends BaseController {


	public function GetCategoryData($category)
	{
		return App::make('Post')->getPostingLites($category);
	}

}