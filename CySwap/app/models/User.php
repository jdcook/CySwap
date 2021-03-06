<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User {

	public function thumbsUp($username, $posting_id, $seller_or_buyer){

		$user=DB::select("SELECT * from CySwap2.user where username = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->positive;
			$num = $num + 1;
			DB::update("UPDATE CySwap2.user set positive = ? where username = ?", array($num, $username));
			DB::update("UPDATE CySwap2.posting set $seller_or_buyer" . "_has_rated = '1' where posting_id = '$posting_id'");
		}
	}

	public function thumbsDown($username, $posting_id, $seller_or_buyer){
		$user=DB::select("SELECT * from CySwap2.user where username = ? limit 0,1", array($username));
		if(count($user)){
			$num = $user[0]->negative;
			$num = $num + 1;
			DB::update("UPDATE CySwap2.user set negative = ? where username = ?", array($num, $username));
			DB::update("UPDATE CySwap2.posting set $seller_or_buyer" . "_has_rated = '1' where posting_id = '$posting_id'");
		}
	}

	public function getProfileInfo($username){
		$data = array();

		$data['username'] = $username;

		$postingids = DB::select("SELECT posting_id, category, date from CySwap2.posting where username = ? and hide_post = '0' order by date ASC", array($username));
		$topaginate = array();
		$i = 0;
		foreach($postingids as $id){
			$queryData = DB::select("SELECT title, posting_id, num_images from CySwap2.category_".$id->category." where posting_id = ?", array($id->posting_id));

			if(count($queryData))
			{
				$topaginate[$i] = $queryData[0];
			}
			else
			{
				DB::delete("DELETE from CySwap2.posting where username = ? and posting_id = ?", array($username, $id->posting_id));
				continue;
			}
			$topaginate[$i]->category = $id->category;
			$i++;
		}

		$total = count($topaginate);
		$data['posts'] = Paginator::make(array_slice($topaginate, (Input::get("page", 1) - 1) * 3, 3), $total, 3);

		$queryObj = DB::select("SELECT * from CySwap2.user where username = ?", array($username));

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
		$result = DB::select("SELECT * from CySwap2.user where username = ?", array($username));
		if(!count($result)){
			return 0;
		}

		return $result[0]->accepted_terms;
	}

	public function acceptTerms($username){
		$user=DB::select("SELECT * from CySwap2.user where username = ? limit 0,1", array($username));	
		if(count($user)){
			DB::update("UPDATE CySwap2.user set accepted_terms = 1 where username = ?", array($username));
		}
		else{
			DB::insert("INSERT into CySwap2.user (username, accepted_terms, positive, negative) VALUES (?,?,?,?)", array($username, 1, 0, 0));
		}
	}

	public function getSellerAndFlags($posting_id){

		return DB::select("SELECT username, seller_has_rated, buyer_has_rated, hide_post from CySwap2.posting where posting_id = '$posting_id'");
	}

	public function getUsernames($user){
		return DB::select("SELECT * from CySwap2.user where username = ?", array($user));
	}

	public function getSuspensionInfo($user){
		$info = DB::select("SELECT * from CySwap2.suspend where username = ?", array($user));
		if(count($info)){
			return $info[0];
		}
		return null;
	}

	public function getBanInfo($user){
		$info = DB::select("SELECT * from CySwap2.blacklist where username = ?", array($user));
		if(count($info)){
			return $info[0];
		}
		return null;
	}

	public function suspendUser($user, $suspendDate, $reason){
		//see if there is already a suspension entry for this user
		$dbResult = DB::select("SELECT * from CySwap2.suspend where username = ?", array($user));
		if(count($dbResult)){
			DB::update("UPDATE CySwap2.suspend set suspended_until_date = ?", array($suspendDate));
		}

		//increment suspend id
		$suspendID = 1;
		$dbResult = DB::select("SELECT * from CySwap2.suspend order by suspend_id DESC limit 0, 5");
		if(count($dbResult)){
			$suspendID = $dbResult[0]->suspend_id + 1;
		}
		DB::insert("INSERT into CySwap2.suspend VALUES(?, ?, ?, ?, ?, ?)", array($suspendID, $user, Session::get('user'), Date('Y-m-d'), $suspendDate, $reason));

	}

	public function banUser($user, $reason){
		DB::insert("INSERT into CySwap2.blacklist VALUES(?, ?, ?, ?)", array($user, Session::get('user'), date('Y-m-d'), $reason));
	}

	public function unBanUser($user){
		DB::delete("DELETE from CySwap2.blacklist where username = ?", array($user));
		DB::delete("DELETE from CySwap2.suspend where username = ?", array($user));
	}

	public function canUserEdit($postid){
		$canEdit = false;
		if(Session::has("usertype") && Session::get("usertype") == "admin" || Session::get("usertype") == "moderator"){
			$canEdit = true;
		}

		if(!$canEdit){
			$user = DB::select("SELECT username from CySwap2.posting where posting_id = ?", array($postid));	
			if(count($user) && $user[0]->username == Session::get("user")){
				$canEdit = true;
			}
		}

		return $canEdit;
	}

	public function promoteUser($user) {
		DB::update('update Cyswap2.user set role = \'moderator\' where username = ?', array($user));
	}

	public function demoteUser($user) {
		DB::update('update Cyswap2.user set role = \'user\' where username = ?', array($user));
	}

	//can't ban admins
	public function canBan($user){
		$dbResult = DB::select("SELECT * from CySwap2.user where username = ?", array($user));
		if(count($dbResult)){
			return $dbResult[0]->role != 'admin';
		}

		return false;
	}

	public function doesUserExist($user){
		$dbResult = DB::select("SELECT * from CySwap2.user where username = ?", array($user));
		return count($dbResult);
	}
}