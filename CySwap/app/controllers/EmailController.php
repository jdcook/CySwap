<?php


class EmailController extends BaseController {

    public function emailContact () {
        $msg = 'The email has been sent.<br/>';
        try{
            Mail::send('emails.contact', array('emailText'=>Input::get('emailText')), function($message)
            {
                $poster = Input::get('posterName');
                $buyer = Session::get('user');
                $message->sender('kabernsj@iastate.edu', 'CySwap')
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


    public function emailBuyer(){
        try{
            if(Input::get('isFinishing') == 'y'){
                $postid = Input::get('postid');
                App::make('Post')->hidePost($postid);
                $username = Session::get('user');
                Mail::send('emails.rate', array('postid'=>$postid, 'poster'=>$username), function($message)
                {
                    $buyerName = Input::get('buyerName');
                    $message->sender('kabernsj@iastate.edu', 'CySwap')
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