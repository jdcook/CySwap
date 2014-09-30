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
                ->to($poster.'@iastate.edu', $poster)
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
        try{
            if(Input::get('isFinishing') == 'y'){
                App::make('Post')->hidePost(Input::get('postid'));
                Mail::send('emails.contact', array('emailText'=>'Rate so-and-so'), function($message)
                {
                    $buyerName = Input::get('buyerName');
                    $username = Session::get('user');
                    $message->sender('kabernsj@iastate.edu', 'CySwap')
                    ->to($buyerName.'@iastate.edu', $buyerName)
                    ->subject('Rate so-and-so');
                });
                return Redirect::to('/rateBuyer')->with('posting', App::make('PostController')->getPost(Input::get('postid')));
            }
            else{
                App::make('Post')->deletePost(Input::get('postid'));
                return Redirect::to('/finishedEmail')->with('message', 'The post has been deleted.'); 
            }

        }
        catch(Exception $e){
            return Redirect::to('/finishedEmail')->with('message', 'An error has occurred:'.$e->getMessage());
        }
    }
}