<?php

class SearchController extends BaseController {
	public $results_each_page = 5;

	public function getResults() {
		
		//store input called keyword as keyword
		$keyword = Input::get('keyword');
		$matches = "";
		
		//set allowable characters, matches 0 for not allowable characters
		$pattern = "/[A-Za-z]+/";
		$search_keyword = trim ($keyword, "/*\t\n\r\0\x0B/");
		$matches = preg_match($pattern, $search_keyword);

		//if not allowable, set search keyword to ' '
		if($matches === 0) {
			$search_keyword = ' ';
		} else {
			$search_keyword = str_replace(' ', '*', $search_keyword);
			$search_keyword = "*".$search_keyword."*";
		}
		

		//get posting ids corresponding to keyword
		$posting_ids = App::make('Tags')->getPostingIds($search_keyword);

		//var_dump($posting_ids);
		//var_dump($posting_ids[0]->posting_id);

		//get posts corresponding to posting_ids
		$category = Input::get('category', 0);
		$posts = array();
		foreach ($posting_ids  as $post_id){
			$post_id_string = $post_id->posting_id;
			$post = App::make('Post')->getPost($post_id_string);
			//if we're searching by category, only show results from that category
			if(!$category || $post['category'] == $category){ 
				array_push($posts, $post);
			}
		}

		$posts_array = $posts;

		//get page number and set results to display
		$page = Input::get('page', 1);
		$paginate = $this->results_each_page;
    	$slice = array_slice($posts_array, $paginate * ($page - 1), $paginate);
		$results = Paginator::make($slice, count($posts_array), $paginate);
		$results->appends('keyword',$keyword);

		//pass results to view search
		return View::make('search',compact('results'))->with('data', array('keyword'=>$keyword, 'categories'=>App::make('Category')->getCategories()));
	}

}