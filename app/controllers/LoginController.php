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
			return View::make('account.login');
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
	    		//set valid message
	    		$msg = 'Login succesful!';

				Session::put('user', $data['netid']);

	    		return Redirect::intended('/');
	    	} else {
	    		//set invalid message
	    		return Redirect::route('login')
	    			->with('message', 'Login unsuccessful');
	    	}
	    }

	}

}