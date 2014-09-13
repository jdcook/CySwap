<?php


class EmailController extends BaseController {

    public function emailContact () {


        Mail::send(array('text' => 'view'), array('key' => 'value'), function($message)
        {
            //$message->to(Input::get('contactInput').'@iastate.edu', 'John Smith')->subject('Welcome!');
            $message->to('jdcook@iastate.edu', 'John Smith')->subject('Welcome!');
        });
    }
}