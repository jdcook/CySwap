<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Report extends Eloquent {

public function reportPost($report_params){

$sellerUsername = DB::select('select user from cyswap2.postings where posting_id='."'".$report_params['postId']."'")[0]->user;

DB::insert('insert into CySwap2.report (reporter, offender, posting_id, description, closed ) values (?, ?, ?, ?, ?)',
			array(Session::get('user'), $sellerUsername, $report_params['postId'], $report_params['reportDescription'], 0)); 
			
			}
}