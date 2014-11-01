<?php

/**Controller that governs interactions between the view and model that puts and pulls postings from the database**/
class RateController extends BaseController {

	/**interacts with Post class to get required post information to be displayed
	* @param $postid: posting id to get from database
	* @ret array representing post**/
	public function rateBuyer()
	{
        $username = Input::get('username');
        $posting_id  = Input::get('posting_id');
        $loggedin_user = Session::get('user');

        $posting_info = App::make('User')->getSellerAndFlags($posting_id);

        //if logged in user is seller and seller_has_rated flag is set, don't rate  again!
        //if logged in user isn't seller and buyer_has_rated flag is set, also don't rate
        $seller_or_buyer = 'buyer';

        if ($loggedin_user == $posting_info[0]->user) {
            $seller_or_buyer = 'seller';
        }

        if((($seller_or_buyer == 'seller') && ($posting_info[0]->seller_has_rated == '1')) ||
          (($seller_or_buyer == 'buyer') && ($posting_info[0]->buyer_has_rated == '1')) ) {
            return Redirect::to('/outputMessage')->with('message', 'You have already rated this transaction!');
        }

        if( $posting_info[0]->hide_post == '0') {
            return Redirect::to('/outputMessage')->with('message', 'This transaction must be marked as complete before rating!');
        }


        if(Input::has('like')){
            App::make('User')->thumbsUp($username, $posting_id, $seller_or_buyer);
            return Redirect::to('/outputMessage')->with('message', 'liked '.$username);
        }
        else if(Input::has('dislike')){
            App::make('User')->thumbsDown($username, $posting_id, $seller_or_buyer);
            return Redirect::to('/outputMessage')->with('message', 'disliked '.$username);
        }
        return Redirect::to('/outputMessage')->with('message', 'Submitted');
	}
}
