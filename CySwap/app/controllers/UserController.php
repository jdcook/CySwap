<?php

class UserController extends BaseController {


	public function getUsers($user)
	{
		echo "<br/><br/><h2 class='centered'>Results</h2><br/>";



		$dbResult = App::make('User')->getUsernames($user);
		for($i=0; $i<count($dbResult); ++$i){
			$data = array();
			$data['username']=$dbResult[$i]->username;
			$data['role']=$dbResult[$i]->role;
			$data['positive']=$dbResult[$i]->positive;
			$data['negative']=$dbResult[$i]->negative;

			$banInfo = App::make('User')->getBanInfo($user);
			if($banInfo){
				$data['banned']="<span class='alert'><b>Banned on ".$banInfo->banned_date." by ".$banInfo->moderator.".</b> <br/>reason: " .$banInfo->reason."</span><br/>";
			}
			else{
				$data['banned']="<b>Not currently banned</b>";
			}

			$suspensionInfo = App::make('User')->getSuspensionInfo($user);
			if($suspensionInfo){
				$data['suspended']="<span class='alert'><b>Suspended from ".$suspensionInfo->suspended_on_date." until ".$suspensionInfo->suspended_until_date." by ".$suspensionInfo->moderator.".</b> <br/>reason: ".$suspensionInfo->reason."</span>";
			}
			else{
				$data['suspended']="<b>Not currently suspended</b>";
			}
			echo View::make('manageUserResults')->with('result', $data);
		}

	}

	public function suspendUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){
			try{
				$suspendDateTime = new DateTime(Input::get('suspendDate'));

				App::make('User')->suspendUser(Input::get('suspendUser'), $suspendDateTime, Input::get('reason'));

				$msg = $msg."User has been suspended";
			}
			catch(Exception $ex){
				$msg = $msg."Error suspending user: <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

	public function banUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){

			try{
				App::make('User')->banUser(Input::get('banUser'), Input::get('reason'));

				$msg = $msg."User has been banned";
			}
			catch(Exception $ex){
				$msg = $msg."Error banning user: <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

	public function unBanUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){
			try{
				App::make('User')->unBanUser(Input::get('unbannedUser'));

				$msg = $msg."User has been pardoned";
			}
			catch(Exception $ex){
				$msg = $msg."Error pardoning user: <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

}
