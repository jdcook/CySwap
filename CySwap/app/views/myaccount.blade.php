@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Profile of {{Session::get('user')}}</b></h1>
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
    <h2>Current Posts</h2>
    <hr/>


@foreach($data['posts'] as $posting)
    
    <div class="entry" data-postid="{{$posting->posting_id}}">
        <div class="row">
            <h4>{{$posting->title}}</h4>
            <br>
            <p><b>Category:</b> {{$posting->category}}</p>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-12">  
                @if($posting->num_images == 0)
                    <span class="entryimg notfound glyphicon glyphicon-picture"></span>
                @else
                    <img class="entryimg" src="{{asset('media/post_images')}}/{{$posting->posting_id}}_0.jpg" />
                @endif
            </div>
        </div>
    </div>

@endforeach


</div>
@stop




@section('javascript')

<script>

</script>
@stop