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
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/><br/>";

		if(!App::make('User')->canBan(Input::get('suspendUser')))
		{
			$msg = $msg."<b class='alert'>You can't suspend that user.</b>";
		}else if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){
			try{
				$suspendDateTime = new DateTime(Input::get('suspendDate'));
			}
			catch(Exception $ex)
			{
				$msg = $msg."<b class='alert'>Error suspending user:</b> Invalid date input";
				return Redirect::to('/outputMessage')->with('message', $msg);
			}

			try{
				App::make('User')->suspendUser(Input::get('suspendUser'), $suspendDateTime, Input::get('reason'));

				$msg = $msg."User has been suspended";
			}
			catch(Exception $ex){
				$msg = $msg."<b class='alert'>Error suspending user:</b> <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

	public function banUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		
		if(!App::make('User')->canBan(Input::get('banUser')))
		{
			$msg = $msg."<b class='alert'>You can't ban that user.</b>";
		}else if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){

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

	public function promoteUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){
			try{
				App::make('User')->promoteUser(Input::get('promotedUser'));

				$msg = $msg."User has been promoted";
			}
			catch(Exception $ex){
				$msg = $msg."Error promoting user: <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

	public function demoteUser(){
		$msg = "<a class='btn btn-default' href='".URL::to('manageUsers')."'>Return to User Management</a><br/>";
		if(Session::has('user') && Session::has('usertype') && Session::get('usertype') != 'user'){
			try{
				App::make('User')->demoteUser(Input::get('demotedUser'));

				$msg = $msg."User has been demoted";
			}
			catch(Exception $ex){
				$msg = $msg."Error demoting user: <br/>".$ex->getMessage();
			}
		}

        return Redirect::to('/outputMessage')->with('message', $msg);
	}

}
