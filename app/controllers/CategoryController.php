<?php

class CategoryController extends BaseController {

	public function showCategoryData($category)
	{
		$postingLites = App::make('Post')->getPostingLites($category, '4');
		return $postingLites;
	}

}