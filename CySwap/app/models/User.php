<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User {

	public function thumbsUp($username){
		$user=DB::select("SELECT * from CySwap.users where username = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->positive;
			$num = $num + 1;
			DB::update("UPDATE CySwap.users set positive = ? where username = ?", array($num, $username));
		}
		else{
			DB::insert("INSERT into CySwap.users (username, accepted_terms, positive, negative) VALUES (?,?,?,?)", array($username, 0, 1, 0));
		}
	}

	public function thumbsDown($username){
		$user=DB::select("SELECT * from CySwap.users where username = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->negative;
			$num = $num + 1;
			DB::update("UPDATE CySwap.users set negative = ? where username = ?", array($num, $username));
		}
		else{
			DB::insert("INSERT into CySwap.users (username, accepted_terms, positive, negative) VALUES (?,?,?,?)", array($username, 0, 1, 0));
		}
	}

	public function getProfileInfo($username, $pagenum){
		$data = array();
		$postingids = DB::select("SELECT posting_id, category, date from CySwap.postings where user = ? order by date ASC", array($username));
		$topaginate = array();

		$i = 0;
		foreach($postingids as $id){
			if($id->category == "textbook"){
				$topaginate[$i] = DB::select("SELECT title, posting_id, num_images from CySwap.category_textbook where posting_id = ?", array($id->posting_id))[0];
			}
			else{
				$topaginate[$i] = DB::select("SELECT title, posting_id, num_images from CySwap.category_miscellaneous where posting_id = ?", array($id->posting_id))[0];
			}
			$topaginate[$i]->category = $id->category;
			$i++;
		}

		$total = count($topaginate);
		$data['posts'] = Paginator::make(array_slice($topaginate, (Input::get("page", 1) - 1) * 3, 3), $total, 3);

		$queryObj = DB::select("SELECT * from CySwap.users where username = ?", array($username));

		if(count($queryObj)){
			$data['positive'] = $queryObj[0]->positive;
			$data['negative'] = $queryObj[0]->negative;
		}
		else{
			$data['positive'] = 0;
			$data['negative'] = 0;
		}


		return $data;
	}

	public function hasAccepted($username){
		$result = DB::select("SELECT * from CySwap.users where username = ?", array($username));
		if(!count($result)){
			return 0;
		}

		return $result[0]->accepted_terms;
	}

	public function acceptTerms($username){
		$user=DB::select("SELECT * from CySwap.users where username = ? limit 0,1", array($username));	
		if(count($user)){
			DB::update("UPDATE CySwap.users set accepted_terms = 1 where username = ?", array($username));
		}
		else{
			DB::insert("INSERT into CySwap.users (username, accepted_terms, positive, negative) VALUES (?,?,?,?)", array($username, 1, 0, 0));
		}
	}
}