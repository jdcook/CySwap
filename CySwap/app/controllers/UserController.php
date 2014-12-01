<?php

class UserController extends BaseController {


	public function getUsers($user)
	{
		$dbResult = App::make('User')->getUsernames($user);

		echo View::make('manageUserResults')->with('dbResult', $dbResult);
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
