<?php

/**Controller that governs interactions between the view and model that puts reports to the database**/
class ReportController extends BaseController {

	public function reportPost() {
		$report_params = Input::get();

		App::make('Report')->reportPost($report_params);

		$msg = 'The following report has been submitted for post "'.$report_params['postId'].'":<br/><br/>';
		return Redirect::to('/outputMessage')->with('message', $msg . Input::get('reportDescription'));

	}

	public function closeReport($id){
		DB::update("UPDATE CySwap2.report set closed = '1' where issue_number = ?", array($id));
	}

}
