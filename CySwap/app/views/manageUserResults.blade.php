<?php
$isAdmin = Session::has('usertype') && Session::get('usertype') == 'admin';
?>

<div class='panel panel-default centered'>
	<br/>
	<b>Username:</b> {{$result['username']}}<br/>
	<b>Role:</b> {{$result['role']}}<br/>
	<b>Feedback:</b> {{$result['positive']}} positive / {{$result['negative']}} negative <br/><br/>
	{{$result['suspended']}}<br/><br/>
	{{$result['banned']}}<br/>


	{{ Form::open(array('action' => array('UserController@suspendUser'))) }}
	{{ Form::hidden('suspendUser', $result['username']) }}
	<div class='wrapper-padded' style="margin: 1em">
		<div class='input-group'>
			<span class='input-group-addon'>Suspend Until</span>
			<input name='suspendDate' class='form-control' type='text' placeholder='yyyy-mm-dd'/>
		</div>
		<br/>
		<div class='input-group'>
			<span class='input-group-addon'>Reason</span>
			<input name='reason' class='form-control' type='text'/>
		</div>
		<br/>
	    <a> <input class="btn btn-default btn-negative" role="button" type="submit" value="Suspend"> </a>
		<br/>
		<br/>
	</div>
	{{ Form::token().Form::close() }}

	<br/>
	{{ Form::open(array('action' => array('UserController@banUser'))) }}
	{{ Form::hidden('banUser', $result['username']) }}
	<div class='wrapper-padded' style="margin: 1em">
		<br/>
		<div class='input-group'>
			<span class='input-group-addon'>Reason</span>
			<input name='reason' class='form-control' type='text'/>
		</div>
	    <a> <input class="btn btn-default btn-negative" role="button" type="submit" value="Ban"> </a>
		<br/>
		<br/>
	</div>
	{{ Form::token().Form::close() }}

	<br/>
	{{ Form::open(array('action' => array('UserController@unBanUser'))) }}
	{{ Form::hidden('unbannedUser', $result['username']) }}
	<div class='wrapper-padded' style="margin: 1em">
	    <a> <input class="btn btn-default btn-positive" role="button" type="submit" value="Clear Suspensions and Bans"> </a>
	</div>
	{{ Form::token().Form::close() }}

	@if($result['role'] != "admin" && $isAdmin) 
		@if($result['role'] != "moderator")
			<br/>
			{{ Form::open(array('action' => array('UserController@promoteUser'))) }}
			{{ Form::hidden('promotedUser', $result['username']) }}
			<div class='wrapper-padded' style="margin: 1em">
			    <a> <input class="btn btn-default btn-positive" role="button" type="submit" value="Promote To Moderator"> </a>
			</div>
			{{ Form::token().Form::close() }}
		@else
			<br/>
			{{ Form::open(array('action' => array('UserController@demoteUser'))) }}
			{{ Form::hidden('demotedUser', $result['username']) }}
			<div class='wrapper-padded' style="margin: 1em">
			    <a> <input class="btn btn-default btn-positive" role="button" type="submit" value="Demote To User"> </a>
			</div>
			{{ Form::token().Form::close() }}
		@endif
	@endif


	
</div>