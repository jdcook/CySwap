@extends('layoutmain')



@section('content')
<div class="col-md-12">
<h1><b>View Reports</b></h1>
<hr/>
</div>	

<div class="col-md-4">
	<div class="wrapper-cushy centered">
		<h3>Filter By</h3>
		<hr/>

		<a class="btn btn-default btn-positive" href="{{URL::to('viewReports')}}">Clear Filter</a>

		<div class="wrapper-cushy">
			<div class="input-group">
				<span class="input-group-addon">Reporter</span>
				<input id="searchreporter" class="form-control" type="text" placeholder="username" />
			</div>
			<a data-search="reporter" class="btn btn-default">Search</a>
		</div>

		<br/>

		<div class="wrapper-cushy">
			<div class="input-group">
				<span class="input-group-addon">Offender</span>
				<input id="searchoffender" class="form-control" type="text" placeholder="username" />
			</div>
			<a data-search="offender" class="btn btn-default">Search</a>
		</div>
		<br/>

		<div class="wrapper-cushy">
			<div class="input-group">
				<span class="input-group-addon">Post ID</span>
				<input id="searchpostid" class="form-control" type="text" placeholder="username" />
			</div>
			<a data-search="postid" class="btn btn-default">Search</a>
		</div>
		<br/>

		<div class="wrapper-cushy">
			<div class="input-group">
				<span class="input-group-addon">Issue ID</span>
				<input id="searchissueid" class="form-control" type="text" placeholder="username" />
			</div>
			<a data-search="issueid" class="btn btn-default">Search</a>
		</div>
	</div>
</div>
<div class="col-md-4">
@if(count($reports) == 0)
	<br/><h3 class='faded'>--  No results found  --</h3><br/>
@else
	@foreach($reports as $report)
		<div class="wrapper-cushy centered darkened">
			<b>Issue ID:</b> {{$report->issue_number}}<br/>
			<b>Reporter:</b> {{$report->reporter}}<br/>
			<b>Offender:</b> {{$report->offender}}<br/>
			<b>Post:</b> <a style="color:red" href="{{URL::to('viewpost/'.$report->posting_id)}}">link</a><br/>
			<b>Description:</b><br/>
			<div class="wrapper-padded">{{$report->description}}</div><br/>
			<a class="btn btn-default btn-negative" data-issue="{{$report->issue_number}}" data-loading-text="Loading...">Close Issue</a>
		</div>
		<br/>
	@endforeach
	{{$reports->links();}}
@endif

</div>
<div class="col-md-4"></div>

@stop




@section('javascript')

<script>
$('a[data-issue]').click(function(){
	var me = $(this)
	var id = me.data("issue");
	$(this).button('loading');
	$.ajax({
		type:'GET',
		url:'close_issue?id='+id,
		success:function(result){
			me.button('reset');
			me.parent().html("Issue Closed.");
		}
	});
});

$('[data-search]').click(function(){
	var searchType = $(this).data('search');
	var searchData = $("#search"+searchType).val();

	window.location.href = "{{URL::to('viewReports')}}?"+searchType+"="+searchData;
})
</script>
@stop