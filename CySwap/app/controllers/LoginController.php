<?php

class LoginController extends BaseController {

	public function login_function ($myusername, $mypassword) {

		require_once(dirname(__FILE__) . "/../../vendor/adldap/adldap/lib/adLDAP/adLDAP.php");
		try {
			//echo "Instatiating...";
			$adldap = new adLDAP\adLDAP();
			//$adldap->setUseTLS(true);
			$adldap->setAccountSuffix("@iastate.edu");
			$adldap->setDomainControllers(array("windc1.iastate.edu","windc2.iastate.edu","windc3.iastate.edu","windc4.iastate.edu","windc5.iastate.edu"));
			//$adldap->baseDn='dc=iastate,dc=edu';

			//echo $adldap->getAccountSuffix();
			//echo $adldap->getUseSSL();
			//var_dump($adldap->getDomainControllers());
			//echo "Instatiated... Now connecting...";
			$adldap->connect();
			$adldap->setUseTLS(true);
			//var_dump($adldap->getldapConnection());
			//echo $adldap->getldapConnection();
		}
		catch (adLDAPException $e) {
			return $e;
			exit();
		}
		$z=$adldap->authenticate($myusername, $mypassword);
		//LDAP ends
		if($z) {
			// Authentication successful
			//$user = User::find(1);
			//Auth::login($myusername);
			return "valid";
		} else {
			// Error- Invalid ISU NET-ID/Password.
			return "invalid";
		}
	}

	public function getLogout() {

		{{Session::flush();}}
		return Redirect::to('/');
	}

	public function getLogin() {
			return View::make('Account/login');
	}

	public function postLogin() {

		$data = Input::all();

		$rules = array(
			'netid'	=> 'required|max:20',
			'password'	=> 'required'
		);

		$validator = Validator::make($data, $rules);
		//print_r(Input::all());

		if($validator->fails()) {
			return Redirect::route('login')
				->withErrors($validator)
				->withInput();
		} else {

			$msg = LoginController::login_function($data['netid'], $data['password']);

	    	if($msg == 'valid') {

				//check for ban
				$baninfo = App::make('User')->getBanInfo($data['netid']);
				if($baninfo){
					return Redirect::route('login')
					->with('message', 'Login unsuccessful<br/><p class="alert">'.$data['netid'].' has been banned on '.$baninfo->banned_date.' for this reason:<br/><br/>"'.$baninfo->reason.'"</p>');
				}

				//check for suspension
				$info = App::make('User')->getSuspensionInfo($data['netid']);
				if($info){
					//check to see if the suspension time is up
					if($info->suspended_until_date > date("Y-m-d")){
						return Redirect::route('login')
						->with('message', 'Login unsuccessful<br/><p class="alert">'.$data['netid'].' has been suspended until '.$info->suspended_until_date.' for this reason:<br/><br/>"'.$info->reason.'"</p>');
					}
				}

	    		//set valid message, set session info
	    		$msg = 'Login succesful!';
				Session::put('user', $data['netid']);

				//look up user
				$hasAcceptedTerms = 0;
				$result = DB::select("SELECT * from CySwap2.user where username = ?", array($data['netid']));
				if(count($result)){
					$hasAcceptedTerms = $result[0]->accepted_terms;
					Session::put('usertype', $result[0]->role);
				}

				//check for terms of use
				if(!App::make('User')->hasAccepted($data['netid'])){
					Session::put('accepted_terms', 0);
					return Redirect::to('terms');
				}
				else{
					Session::put('accepted_terms', 1);
				}

	    		return Redirect::intended('/');
	    	} else {
	    		//set invalid message
	    		return Redirect::route('login')
	    			->with('message', 'Login unsuccessful');
	    	}
	    }

	}

	public function acceptTerms(){
		App::make("User")->acceptTerms(Session::get("user"));
		Session::put('accepted_terms', 1);
		return Redirect::to('home');
	}
}
