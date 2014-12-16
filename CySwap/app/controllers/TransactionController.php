<?php


class TransactionController extends BaseController {

    public function beginTransaction () {
        $msg = 'The email has been sent.<br/>';
        try{
            $emailBody = Input::get('emailText')."<br/><br/>Please reply directly to this email. Your response will go directly to ".Session::get('user');
            Mail::send('emails.contact', array('emailText'=>$emailBody), function($message)
            {
                $poster = Input::get('posterName');
                $buyer = Session::get('user');
                $message->sender('cyswap@iastate.edu', 'CySwap')
                ->to($poster.'@iastate.edu', $poster)
                ->subject($buyer.' is interested in buying your item!')
                ->replyTo($buyer.'@iastate.edu', $buyer);
            });
        }
        catch(Exception $e){
            $msg = 'An error has occurred: '.$e->getMessage();
        }

        return Redirect::to('/outputMessage')->with('message', $msg . Input::get('emailText'));
    }


    public function completeTransaction(){
        try{
            if(Input::get('isFinishing') == 'y'){
                $postid = Input::get('postid');
                App::make('Post')->deletePost($postid);
                $username = Session::get('user');
                Mail::send('emails.rate', array('postid'=>$postid, 'poster'=>$username), function($message)
                {
                    $buyerName = Input::get('buyerName');
                    $message->sender('cyswap@iastate.edu', 'doNotReply:CySwap')
                    ->to($buyerName.'@iastate.edu', $buyerName)
                    ->subject('Cyswap Transaction Completed');
                });
                return Redirect::to('/rateBuyer/'.Input::get('buyerName').'/'.$postid);
            }
            else{
                App::make('Post')->deletePost(Input::get('postid'));
                return Redirect::to('/outputMessage')->with('message', 'The post has been deleted.');
            }

        }
        catch(Exception $e){
            return Redirect::to('/outputMessage')->with('message', 'An error has occurred:'.$e->getMessage());
        }
    }
}
