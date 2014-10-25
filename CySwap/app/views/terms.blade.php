@extends('layoutmain')

@section('content')

<h1>CySwap Terms of Use</h1>
<p class="centered">(scroll down to accept)</p>
<hr />
<br/>


<div class="panel panel-default">
    <div class="panel-body">
        NO swapping under the age of 18.  Almost all swap sites have this rule. Please remember that items like unrated or R rated movies and M rated games can NOT be sold to minors without a parent present.  Basically anything you buy at Walmart that you need to provide a birthdate for, can't be sold to minors.
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body">
        No sales of tobacco, alcohol, prescription medication, firearms, etc.  Use common sense.  If you have any doubts about what you are selling, please ask.
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        Drama.  Please don't start it, please don't add to it.  We are supposed to all be adults and it would be nice if we could act that way.  I know that sometimes people get upset about being passed over, or read into something the wrong way, but a private message would be a much better way to deal with it.
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-body">
    PLEASE remove your photos when the items are sold! If there is no description and price, it will be removed. If it has been 30 days with no activity, it will be deleted.  Utilize the search tool (magnifying glass) on the top right hand side.
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
    If you are interested in an item but have a question first, please specify that you are interested but first have a question!  The first person to ask about an item is the first in line.  When selling, please go in order of the people that inquire about the item not  by who says they WANT that item!  Please allow 12 hours for people to respond.
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
    In regards to pets/animal sales on the site:  Use caution when doing this.  Both the seller and the buyer need to be careful about scams/puppy mills/etc.  If you get a bad feeling about ANY part of the transactions, you have every right to not sell or buy.  Ask questions, like why they want to buy the animal, what other pets they have, etc.  You have the right to know where your pet is going, and who will be taking care of it.  A shelter asks these questions, so should you.  Also when buying a pet, make sure you ask the right questions.  Vet care, shots, temperament of the parent animals, etc.  Research and go with your instincts.  If you have any suspicions that people are buying or selling animals for anything other than pets please private message an admin and we will do our best to help you!
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
    Please list the price on all items, this is not an auction site.
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
    As a buyer YOU are responsible to check over the product before you purchase an item.  We cannot get your money back after you have taken the item home.
    </div>
</div>


{{ Form::open(array('action' => array('LoginController@acceptTerms'))) }}
<div class="col-md-6">
    <a> {{ Form::submit('Agree', ['class' => 'btn btn-default termsBtn accept', 'role' => 'button']) }} </a>
</div>
<div class="col-md-6">
    <a class="btn btn-default termsBtn decline" href="{{URL::route('logout')}}">Decline</a>
</div>
{{ Form::close() }}
{{Form::close() }}


@stop