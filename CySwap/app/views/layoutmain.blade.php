<html>
<head>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	{{ HTML::style('css/bootstrapOverrides.css')}}
	{{ HTML::style('css/main.css')}}

</head>
<body>

	<!-- header -->
	<div id="header" class="jumbotron">
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
				<input type="text" placeholder="Search" />
				<br/>
				<a href="">login</a>
			</div>
		</div>
	</div>

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
						<a href="{{URL::to('isbnexample')}}">Post an item</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="{{URL::to('safety')}}">Safety</a>
					</li>
					<li>
						<a href="{{URL::to('about')}}">About Us</a>
					</li>
				</ul>
			</div>
		</div>
	</div>


<div id="content" class="container-fluid">
	@yield('content')
</div>


<br /><br />
<!-- footer -->
<div id="footer" class="row">
	<div class="col-md-3"><a href="{{URL::to('/copyright')}}">Copyright</a></div>
	<div class="col-md-3"><a href="{{URL::to('/legaljargon')}}">Terms of Use</a></div>
	<div class="col-md-3"><a href="{{URL::to('/report')}}">Report</a></div>
	<div class="col-md-3"><a href="{{URL::to('/contact')}}">Contact Us</a></div>
</div>
<!-- end footer -->





<!-- javascript includes -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!-- end javascript includes -->

<script>

/* affixing navbar to top */
$('#nav').affix({
  offset: {
    top: $('#header').outerHeight()
  }
})

</script>

<!--script to add padding to @content equal to the displacement of the navbar switching to a fixed position-->
<script>

/*run when document is ready*/
$(document).ready( function() {
    var header_done = $('#header').outerHeight();
    var nav_height = $('#nav').outerHeight();
    var adjusted = 0;
    var content = document.getElementById("content");

    /*run when user scrolls*/
    $(window).scroll(function() {
        if($(window).scrollTop() > header_done && !adjusted) { //scrolled past header?
            content.setAttribute("style","padding-top: " + nav_height + ";");
            adjusted = 1;
        }
        else if($(window).scrollTop() < header_done && adjusted) { //header back in view?
        	content.setAttribute("style","padding-top: 0px;");
        	adjusted = 0;
        }
    });
});

</script>
</body>
</html>