@extends('layoutmain')

@section('content')

<br />
<br />
    <div class="col-md-12">
        <b>{{ Session::get('message') }}</b>
    </div>

@stop