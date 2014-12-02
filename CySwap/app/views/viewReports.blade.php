@extends('layoutmain')



@section('content')
<div class="col-md-12">
<h1><b>View Reports</b></h1>
<hr/>
</div>

<div class="col-md-4"></div>
<div class="col-md-4">
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


</script>
@stop