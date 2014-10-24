<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User {

	public function thumbsUp($username){
		$user=DB::select("SELECT * from cyswap.feedback where user = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->positive;
			$num = $num + 1;
			DB::update("UPDATE cyswap.feedback set positive = ? where user = ?", array($num, $username));
		}
		else{
			DB::insert("INSERT into cyswap.feedback (user, positive, negative) VALUES (?,?,?)", array($username, 1, 0));
		}
	}

	public function thumbsDown($username){
		$user=DB::select("SELECT * from cyswap.feedback where user = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->negative;
			$num = $num + 1;
			DB::update("UPDATE cyswap.feedback set negative = ? where user = ?", array($num, $username));
		}
		else{
			DB::insert("INSERT into cyswap.feedback (user, positive, negative) VALUES (?,?,?)", array($username, 1, 0));
		}
	}

	public function getProfileInfo($username){
		$data = array();
		$data['posts'] = array();
		$postingids = DB::select("SELECT posting_id, category from cyswap.postings where user = ? order by date DESC", array($username));

		foreach($postingids as $id){
			if($id->category == "textbook"){
				$data['posts'][$id->posting_id] = DB::select("SELECT title, posting_id, num_images from cyswap.category_textbook where posting_id = ?", array($id->posting_id))[0];
			}
			else{
				$data['posts'][$id->posting_id] = DB::select("SELECT title, posting_id num_images from cyswap.category_miscellaneous where posting_id = ?", array($id->posting_id))[0];
			}
			$data['posts'][$id->posting_id]->category = $id->category;
		}

		$queryObj = DB::select("SELECT * from cyswap.feedback where user = ? limit 0,1", array($username));

		if(count($queryObj)){
			$data['positive'] = $queryObj[0]->positive;
			$data['negative'] = $queryObj[0]->negative;
		}
		else{
			$data['positive'] = 0;
			$data['negative'] = 0;
		}
/*
		$queryObj = DB::select("SELECT * from cyswap.feedback where user = ? limit 0,1", array($username));
		if(count($queryObj)){
			$data['negative'] = $queryObj[0]->negative;
		}
		else{
			$data['negative'] = 0;
		}
*/
		return $data;
	}
}