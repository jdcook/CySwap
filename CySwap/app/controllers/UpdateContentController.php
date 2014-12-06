<?php

class UpdateContentController extends BaseController {

	public function updateTermsOfUse() {
		return UpdateContentController::saveFileAndRedirect('terms_of_use');
	}
	public function updateContactUs() {
		return UpdateContentController::saveFileAndRedirect('contact_us');
	}
	public function updateAboutUs() {
		return UpdateContentController::saveFileAndRedirect('about_us');
	}
	public function updateSafety() {
		return UpdateContentController::saveFileAndRedirect('safety');
	}

	//file_name is also expected to be key to use to get data from form
	public function saveFileAndRedirect($file_name) {

		if(Session::has('usertype')){
			$usertype = Session::get('usertype');
			if($usertype == "admin" || $usertype == "moderator"){
				$terms = Input::get($file_name);

				//write to file
				$myfile = fopen(dirname(__FILE__)."/../storage/CySwapContent/".$file_name.".txt", "w") or die("Unable to open file!");
				fwrite($myfile, $terms);
				fclose($myfile);
			}
		}
		return Redirect::to('/updateContent');
	}
}