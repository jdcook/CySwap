@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Moderator Area</b></h1>
<hr/>
</div>

<div class="col-md-4"></div>
<div class="col-md-4 centered">
    <a class="btn btn-default" href="{{URL::to('manageUsers')}}">Manage Users</a><br/><br/>
    <a class="btn btn-default" href="{{URL::to('viewReports')}}">View Reports</a><br/><br/>
</div>
<div class="col-md-4"></div>


@stop




@section('javascript')

<script>

</script>
@stop