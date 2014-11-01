<html>
<head>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	{{ HTML::style('css/bootstrapOverrides.css')}}
	{{ HTML::style('css/main.css')}}

</head>
<body>



	<!-- header -->
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-2">
				<img id="logo" src="{{asset('media/logo.jpg')}}" style="width:14em; height:10em" />
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<h1 style="text-align:left">Cyswap</h1>
			</div>
			<div class="col-md-2">
			</div>
			<div class="col-md-2">
				<br/>
				{{Form::open(array('url'=>'/search_results', 'method' => 'get'))}}
					{{Form::text('keyword', null, array('placeholder'=>'Search'))}}
					{{Form::submit('search')}}
				{{Form::close()}}
				@if(Session::has('user'))
					<a href="{{URL::to('myaccount')}}">{{Session::get('user')}}</a> (<a href="{{URL::route('logout')}}">logout</a>)
				@else
					<a href="{{URL::route('login')}}">login</a>
				@endif
			</div>
		</div>
	</div>

	<div id="navwrapper">
	<div id="nav" class="navbar navbar-default navbar-static">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	              <span class="sr-only">Toggle navigation</span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
            	</button>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="{{URL::to('/')}}">Home</a>
					</li>
					<li>
						<a href="{{URL::to('categories')}}">Categories</a>
					</li>
					<li>
						<a href="{{URL::to('postItem')}}">Post an item</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="{{URL::to('safety')}}">Safety</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	</div>

<div id="content" class="container-fluid">
	@yield('content')
</div>


<br /><br />
<!-- footer -->
<div id="footer" class="row">
	<!--<div class="col-md-3"><a href="{{URL::to('/copyright')}}">Copyright</a></div>-->
	<div class="col-md-4"><a href="{{URL::to('/termsofuse')}}">Terms of Use</a></div>
	<div class="col-md-4"><a href="{{URL::to('/about')}}">About Us</a></div>
	<div class="col-md-4"><a href="{{URL::to('/contact')}}">Contact Us</a></div>
</div>
<!-- end footer -->





<!-- javascript includes -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!-- end javascript includes -->

<script>

$('#navwrapper').height($("#nav").height());
/* affixing navbar to top */
$('#nav').affix({
	offset:{top:$('#nav').offset().top }
});


$('.entry').click(function(){
	window.location.href="{{URL::to('viewpost')}}" + "/" + $(this).attr("data-postid");
});

var maxTextLength = 375;
$('.cliptext').each(function(){
	var text = $(this).html();
	if(text.length > maxTextLength){
		text = text.slice(0, maxTextLength);
		text += "...";
		$(this).html(text);
	}

});

</script>

@yield('javascript')

</body>
</html>
