<?php

/**Controller that governs interactions between the view and model that puts reports to the database**/
class ReportController extends BaseController {

public function reportPost()
	{$report_params = Input::get();
	
	App::make('Report')->reportPost($report_params);
	
	
	return Redirect::to('/outputMessage')->with('message', 'The report has been submitted, thanks!');
	
	}
