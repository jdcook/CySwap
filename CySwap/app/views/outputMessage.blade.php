@extends('layoutmain')

@section('content')

<br />
<br />
    <div class="col-md-12">
        <strong>{{ Session::get('message') }}</strong>
    </div>

@stop