<?php


class EmailController extends BaseController {

    public function emailContact () {
        $msg = 'The email has been sent.';
        try{
            Mail::send('emails.contact', array('emailText'=>Input::get('emailText')), function($message)
            {
                $poster = Input::get('posterName');
                $buyer = Session::get('user');
                $message->sender('kabernsj@iastate.edu', 'CySwap')
                ->to($poster.'@gmail.com', $poster)
                ->subject($buyer.' is interested in buying your item!')
                ->replyTo($buyer.'@iastate.edu', $buyer);
            });
        }
        catch(Exception $e){
            $msg = 'An error has occurred: '.$e->getMessage();
        }

        return Redirect::to('/finishedEmail')->with('message', $msg);
    }


    public function emailBuyer(){

        $msg = 'The transaction has been completed.';
        try{
            DB::update('update cyswap.postings set hide_post = 1 where posting_id = '.Input::get('postid').';');

            Mail::send('emails.contact', array('emailText'=>'Rate so-and-so'), function($message)
            {
                $buyerName = Input::get('buyerName');
                $username = Session::get('user');
                $message->sender('kabernsj@iastate.edu', 'CySwap')
                ->to($buyerName.'@iastate.edu', $buyerName)
                ->subject('Rate so-and-so');
            });
        }
        catch(Exception $e){
            $msg = 'An error has occurred:'.$e->getMessage();
        }


        return Redirect::to('/finishedEmail')->with('message', $msg);
    }
}