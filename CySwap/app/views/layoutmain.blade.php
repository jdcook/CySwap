<html>
<head>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="app/css/bootstrapOverrides.css" rel="stylesheet" />
	<link href="app/css/main.css" rel="stylesheet" />

</head>
<body>

	<!-- header -->
	<div id="header" class="jumbotron">
		<div class="row">
			<div class="col-md-2">
				<img id="logo" src="app/storage/media/logo.jpg" style="width:14em; height:10em" />
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<h1 style="text-align:left">Cyswap</h1>
				<p>The place to swap</p>
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
						<a href="">Home</a>
					</li>
					<li>
						<a href="">Categories</a>
					</li>
					<li>
						<a href="">Post an Item</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="">Safety</a>
					</li>
					<li>
						<a href="">About Us</a>
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
	<div class="col-md-3"><a href="">Copyright</a></div>
	<div class="col-md-3"><a href="">Terms of Use</a></div>
	<div class="col-md-3"><a href="">Report</a></div>
	<div class="col-md-3"><a href="">Contact Us</a></div>
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
    top: $('#header').height()
  }
});



</script>
</body>
</html>