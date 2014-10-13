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

}