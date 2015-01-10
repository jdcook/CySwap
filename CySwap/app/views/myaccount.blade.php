@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Profile of {{$data['username']}}</b></h1>
<hr/>
</div>

<div class="wrapper-padded text-center col-md-2">
    <h2>Ratings</h2><br/>

    <span class="like glyphicon glyphicon-thumbs-up">
        {{$data['positive']}}
    </span>

    <span class="dislike glyphicon glyphicon-thumbs-down">
        {{$data['negative']}}
    </span>



</div>
<br/>
<div class="col-md-2"></div>
<div class="wrapper-padded text-center col-md-8">
    <h2>Active Posts</h2>
    <hr/>

<?php
if(!count($data['posts'])){
    echo "<br/><h3 class='faded'>--  No active posts found  --</h3><br/>";
}

?>
@foreach($data['posts'] as $posting)

<a class="entry-link" href="{{URL::to('viewpost/'.$posting->posting_id)}}" >
<div class="entry" data-postid="{{$posting->posting_id}}">
    <div class="row centered">
        <h4>{{htmlentities($posting->title)}}</h4>
        <br>
        <p><b>Category:</b> {{$posting->category}}</p>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">  
        @if($posting->num_images == 0)
            <span class="entryimg notfound glyphicon glyphicon-picture"></span>
        @else
            <img class="entryimg liteimg" src="{{asset('media/post_images')}}/{{$posting->posting_id}}_0.jpg" />
        @endif
        <br/>
        <br/>
        </div>
    </div>
</div>
</a>


@endforeach

{{$data['posts']->links()}}


</div>
@stop




@section('javascript')

<script>

</script>
@stop