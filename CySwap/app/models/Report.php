<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Report extends Eloquent {

	public function reportPost($report_params){

		//get username
		$dbResult = DB::select("SELECT username from CySwap2.posting where posting_id = ? ", array($report_params['postId']));
		$offender = "unknown";
		if(count($dbResult)){
			$offender = $dbResult[0]->username;
		}

					
		DB::insert('insert into CySwap2.report (reporter, offender, posting_id, description, closed ) values (?, ?, ?, ?, ?)',
					array(Session::get('user'), $offender, $report_params['postId'], $report_params['reportDescription'], 0)); 
	}

	public function getReports(){
		$numPerPage = 10;
		$offset = (intval(Input::get("page", 1)) - 1) * $numPerPage;

		$dbResult = null;
		if(Input::has('reporter'))
		{
			$dbResult = DB::select("SELECT * from CySwap2.report where closed = '0' and reporter = ? order by issue_number ASC", array(Input::get('reporter')));
		}
		else if(Input::has('offender')){
			$dbResult = DB::select("SELECT * from CySwap2.report where closed = '0' and offender = ? order by issue_number ASC", array(Input::get('offender')));
		}
		else if(Input::has('postid')){
			$dbResult = DB::select("SELECT * from CySwap2.report where closed = '0' and posting_id = ? order by issue_number ASC", array(Input::get('postid')));
		}
		else if(Input::has('issueid')){
			$dbResult = DB::select("SELECT * from CySwap2.report where closed = '0' and issue_number = ? order by issue_number ASC", array(Input::get('issueid')));
		}
		else{
			$dbResult = DB::select("SELECT * from CySwap2.report where closed = '0' order by issue_number ASC");
		}

		$total = count($dbResult);
		return Paginator::make(array_slice($dbResult, $offset, $numPerPage), $total, $numPerPage);
	}
}