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
            //todo: update user's rating
            return Redirect::to('/finishedEmail')->with('message', 'liked '.$username);
        }
        else if(Input::has('dislike')){
            //todo: update user's rating
            return Redirect::to('/finishedEmail')->with('message', 'disliked '.$username);
        }
        return Redirect::to('/finishedEmail')->with('message', 'Submitted');
	}
}
