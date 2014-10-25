<?php

/**Controller that governs interactions between the view and model that puts and pulls postings from the database**/
class RateController extends BaseController {

	/**interacts with Post class to get required post information to be displayed
	* @param $postid: posting id to get from database
	* @ret array representing post**/
	public function rateBuyer()
	{
        $username = Input::get('username');
        if(Input::has('like')){
            App::make('User')->thumbsUp($username);
            return Redirect::to('/outputMessage')->with('message', 'liked '.$username);
        }
        else if(Input::has('dislike')){
            App::make('User')->thumbsDown($username);
            return Redirect::to('/outputMessage')->with('message', 'disliked '.$username);
        }
        return Redirect::to('/outputMessage')->with('message', 'Submitted');
	}
}
