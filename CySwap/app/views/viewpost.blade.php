@extends('layoutmain')

@section('content')
<?php
$canEdit = Session::has('usertype') && (Session::get('usertype') == 'admin' || Session::get('usertype') == 'moderator') 
		   || Session::has('user') && Session::get('user') == $posting['username'];
?>
<div class="col-md-12 centered">
	<div id="titleHide">
		<h1 id="titleStatic">{{htmlentities($posting['title'])}}</h1>
	</div>
	@if($canEdit)
	<a class="link-edit" data-edit="title">Edit</a>
	<div id="titleEdit" style="display:none">
		<br/>
		<div class="col-md-4"></div>
		<div class="input-group col-md-4">
			<span class="input-group-addon">Title</span>
			<input class="form-control" type="text" maxlength="{{$posting['config']['title']->character_limit}}" value="{{htmlentities($posting['title'])}}"/>
		</div>
		<div class="col-md-4"></div>
		<a class="link-edit" data-save="title" data-loading-text="Saving...">Save</a>
	</div>
	@endif
	<hr />

	@if($canEdit)
	<div id="errorDiv"></div>
	@endif
</div>

<div id="postImages" class="col-md-4">
	@if($posting['num_images'] == 0)
		<span style="text-align: center" class="entryimg-glyph notfound glyphicon glyphicon-picture"></span>
		<br/><br/>
	@endif
	<div class="price">
		@if($canEdit)
		<a id="imageEditBtn" class="link-edit">Replace current pictures</a>
		<div id="imageEdit" style="display:none">
			{{ Form::open(array('action' => array('PostController@replaceImages'), 'files'=>true)) }}
				{{Form::hidden('postid', $posting['posting_id'])}}
				{{Form::hidden('category', $posting['category'])}}
				<input id="imageFile1" data-image-edit="1" class="form-control" type="file" name="picture1"/>
				<a><input id="imageSave" class="link-edit" role="button" type="submit" value="Save (Replace current pictures)" /></a>
			{{ Form::token().Form::close() }}
		</div>
		@endif
		<div id="imageStatic">
			@if($posting['num_images'] > 0)
				<img id="image_main" class="entryimg" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_0.jpg" />
			@endif

			@for($i = 0; $i < $posting['num_images']; $i++)
				<img class="thumb" id="thumb{{$i}}" src="{{asset('media/post_images')}}/{{$posting['posting_id']}}_{{$i}}.jpg" width=20 height=20 alt="ERROR"/>
			@endfor
		</div>
		<p><b class="detailHeading">Date Posted:</b>{{htmlentities($posting['date'])}} </p>
		@if($canEdit)
		<br/>
		<br/>
		<a class="link-edit" data-edit="suggested_price">Edit</a>
		<div id="suggested_priceEdit" class="wrapper-cushy" style="display:none">
			<a class="link-edit" data-save="suggested_price" data-loading-text="Saving...">Save</a>
			<div class="input-group">
				<input class="form-control" type="text" maxlength="{{$posting['config']['suggested_price']->character_limit}}" value="{{htmlentities($posting['suggested_price'])}}"/>
			</div>
		</div>
		@endif
		<div id="suggested_priceHide">
			<p><b>Suggested Price:</b> <span id="suggested_priceStatic">{{htmlentities($posting['suggested_price'])}}</span></p>
		</div>

		@if(Session::has('message'))
			{{ Session::get('message') }}
		@endif
		@if(Session::has('user'))
			<?php
			$accepted = 0;
			if(Session::has('accepted_terms') && Session::get('accepted_terms')){
				$accepted = 1;
			}
			?>
			@if(!$accepted)
				<p class="alert">You have to accept the Terms of Use before contacting a seller.</p>
				<a class="btn btn-default accept termsBtn" href="{{URL::to('terms')}}">Terms of Use</a>
			@else
				<!-- if the poster is the same as the current user, let them mark as complete -->
				@if(Session::get('user') == $posting['username'])
					<p><b>Poster:</b><br/> {{$posting['username']}} (me)</p><br/>
					<p>	<a id="markCompleteBtn" data-toggle="collapse" data-target='#markCompletePanel' class="btn btn-default center-block" role="button">Close Post</a></p>
					<div class='panel-collapse collapse wrapper' id="markCompletePanel">
						{{ Form::open(array('action'=>'TransactionController@completeTransaction')) }}
						{{Form::hidden('postid', $posting['posting_id'])}}
						{{Form::hidden('isFinishing', 'y', ['id'=>'isFinishing'])}}
						<a id='deleteBtn' class='btn btn-default center-block switch-inactive switch' role='button'>Delete Post</a>
						<a id='finishBtn' class='btn btn-default center-block positive-active switch' role='button'>Complete Transaction</a>
						<div class='panel-collapse switch' style="margin-top: 0" id='netidInput'>
					  		<span id="textareaLabel" class="input-group-addon topTextLabel">{{Form::label('NetID of Buyer')}}</span>
							{{Form::text('buyerName', '', ['id'=>'buyerName', 'class'=>'form-control'])}}
							<br/>
						</div>
						<br/>
						{{ Form::submit('Submit', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default positive-active center-block', 'role' => 'button']) }}<br /><br />
						{{Form::token()}}
					</div>

				<!-- otherwise, show contact seller button -->
				@else
					<p><b>Poster:</b><br/> {{$posting['username']}}</p><br/>
					<p><a id="contactSellerBtn" data-toggle="collapse" data-target='#contactPanel' class="btn btn-default" role="button">Contact Seller</a></p>

					<div class='panel-collapse collapse' id="contactPanel">
							<p>
							<p id="confirmText">Send Email to {{$posting['username']}}</p>

								{{ Form::open(array('action'=>'TransactionController@beginTransaction')) }}
								<br>


								<div class="detail">
								  <span id="textareaLabel" class="input-group-addon textareaLabel">{{Form::label('Email')}}</span>
								  	{{Form::textarea('emailText', 'Hi ' . $posting['username'] . ', I am interested in buying your ' . $posting['title'] . '         -'.Session::get("user") ,
								  	['id' => 'contactInput', 'class' => 'form-control description'])}}
								</div>

								{{Form::hidden('posterName', ''.$posting['username'])}}


								<br />
								<div class="col-md-6">
									{{ Form::submit('Send Email', ['id' => 'sendEmailBtn', 'class' => 'btn btn-default positive-active center-block', 'role' => 'button']) }}
								</div>
								<div class="col-md-6">
									<a id="cancelBtn" data-toggle="collapse" data-target="#contactPanel" class="btn btn-default center-block negative-active" role="button">Cancel</a>
								</div>
								{{ Form::token().Form::close() }}
								<br/>
							</p>
					</div>
				@endif
			@endif
		@endif
	</div>
</div>

<div class="col-md-6 container">
	<div class="detailContainer">
			@foreach($posting as $key => $value)
				@if($key != "posting_id" and $key != "seller_has_rated" and $key != "buyer_has_rated" and $key != "tags"
					and $key != "hide_post" and $key != "title"
					and $key != "description" and $key != 'username' and $key != "suggested_price")
				@if($key != 'num_images' and $key != 'date' and $key != 'category' and $key != 'config' and !is_null($value))
					
					<div class="singleDetail row">
					@if($canEdit)
						@if($key == 'item_condition')
						<a class="link-edit" data-edit="{{$key}}">Edit</a>
						<div id="{{$key}}Edit" class="wrapper-cushy" style="display:none">
							<a class="link-edit" data-save="{{$key}}" data-loading-text="Saving...">Save</a>
							<div class="input-group">
								<span class="input-group-addon">{{$key}}</span>
								<select class="form-control">
									<option name="none">--</option>
									<option name="poor">Poor</option>
									<option name="used">Used</option>
									<option name="good">Good</option>
									<option name="new">New</option>
								</select>
							</div>
						</div>
						@else
						<a class="link-edit" data-edit="{{$key}}">Edit</a>
						<div id="{{$key}}Edit" class="wrapper-cushy" style="display:none">
							<a class="link-edit" data-save="{{$key}}" data-loading-text="Saving...">Save</a>
							<div class="input-group">
								<span class="input-group-addon">{{$key}}</span>
								@if($posting['config'][$key]->character_limit == '0') 
									<input class="form-control" type="text" value="{{htmlentities($value)}}"/>
								@else
									<input class="form-control" type="text" maxlength="{{$posting['config'][$key]->character_limit}}" value="{{htmlentities($value)}}"/>
								@endif
							</div>
						</div>
						@endif
					@endif
					<div id="{{$key}}Hide">
						<p><b class="detailHeading">{{$key}}:</b> <span id="{{$key}}Static">{{htmlentities($value)}}</span></p>
					</div>
				</div>
				@endif
				@endif
			@endforeach
			<br/>

			@if(array_key_exists("description", $posting))
				<div class="row centered">
					<br/>
				@if($canEdit)
					<a class="link-edit" data-edit="description">Edit</a>
					<div id="descriptionEdit" style="display:none">
						<a class="link-edit" data-save="description" data-loading-text="Saving...">Save</a>
						<textarea class="form-control description">{{htmlentities($posting['description'])}}</textarea>
					</div>
					@endif

					<div id="descriptionHide">
						<p><b>Description:</b><br/><div class="wrapper-cushy"><span id="descriptionStatic">{{htmlentities($posting['description'])}}</span></div></p>
					</div>
				</div>
			@endif
	</div>
	<br/><a style="color:red" href="{{URL::to('/report/'.$posting['posting_id'])}}">Report Post</a>
</div>



@stop



@section('javascript')
<script>

$('.detailHeading').each(function(){
	var cur = $(this).html();
	var newstr = formatDetailHeading(cur);
	$(this).text(newstr);
});

function formatDetailHeading(string)
{
	var ret = string.charAt(0).toUpperCase() + string.slice(1);
	ret = ret.replace('_', ' ');
	return ret;
}

$('#cancelBtn').click(function(){
	$('#contactInput').val("{{'Hi ' . $posting['username'] . ', I would like to buy ' . htmlentities($posting['title']) . ' (' . $posting['posting_id'] . ')'}}");
});

$('#deleteBtn').click(function(){
	$('#netidInput').slideUp();
	$('#isFinishing').val('n');
	$('#finishBtn').removeClass('positive-active');
	$('#finishBtn').addClass('switch-inactive');
	$(this).removeClass('switch-inactive');
	$(this).addClass('negative-active');
});

$('#finishBtn').click(function(){
	$('#netidInput').slideDown();
	$('#isFinishing').val('y');

	$('#deleteBtn').removeClass('negative-active');
	$('#deleteBtn').addClass('switch-inactive');
	$(this).removeClass('switch-inactive');
	$(this).addClass('positive-active');

	$('#buyerName').focus();
});

$('img').click(function(){
	var image_id = $(this).attr('id');
	if(image_id.indexOf("thumb") > -1)
	{
		var match = image_id.match(/\d+/);
		var src = "{{asset('media/post_images')}}/{{$posting['posting_id']}}_"+match+".jpg";
		$('#image_main').attr("src", src);
	}
});

$('[data-edit]').click(function(){
	$(this).hide();
	$('#'+$(this).data('edit')+'Edit').show();
	$('#'+$(this).data('edit')+'Hide').hide();
});

$('[data-save]').click(function(){
	var me = $(this);

	if(!me.attr('disabled')){
		me.button('loading');
		$('#errorDiv').html('');

		var fieldName = me.data('save');
		var staticElement = $('#'+fieldName+'Static');
		var editElement = $('#'+fieldName+'Edit');
		var hiddenElement = $('#'+fieldName+'Hide');

		var input = "";
		var inputElement = editElement.children().find('input');
		if(!inputElement.length){
			inputElement = editElement.children('textarea');
		}
		if(!inputElement.length){
			inputElement = editElement.children().find('select');
		}

		input = inputElement.val();
		if(!input){
			input = "derp";
		}

		$.ajax({
			type:'POST',
			url:'{{URL::to("alter_post")}}',
			data: {postid: '{{$posting["posting_id"]}}', category: '{{$posting["category"]}}', key: fieldName, value: input}
		})
		.done(function(result){
			$('[data-edit="'+fieldName+'"]').show();
			editElement.hide();
			hiddenElement.show();
			staticElement.html(input);
			//alert(result);
		})
		.fail(function(){
			$('#errorDiv').html('<b class="alert">Error saving changes</b><br/>');
		})
		.always(function(){
			me.button('reset');
		});
	}
});

$('#imageEditBtn').click(function(){
	$(this).hide();
	$('#imageEdit').show();
	$('#imageStatic').hide();
});

var maxPictures = 10;
function updatePictureForm(){
	$('[data-image-edit]').on('change', function(){
		var me = $(this);
		var nextIndex = parseInt(me.data('image-edit')) + 1;
		if(nextIndex < maxPictures){
			me.after('<input id="imageFile'+nextIndex+'" data-image-edit="'+nextIndex+'" class="form-control" type="file" name="picture'+nextIndex+'"/>');
			updatePictureForm();
		}
	});
}

$('#image_main').click(function(){
	var dialog = $('#dialog');
	if(dialog.length){
		dialog.dialog("open");
	}
	else{
		$(this).append("<div id='dialog' class='wrapper-cushy'><img src='"+$(this).attr("src")+"'></div>");
		$('#dialog').dialog({title: 'Image', width: $(window).width() * .98, height: $(window).height() * .95});
	}
})

updatePictureForm();
</script>
@stop
