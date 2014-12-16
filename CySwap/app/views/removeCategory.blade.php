@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Remove Category</b></h1>
<hr/>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="col-md-4">
</div>
<div class="col-md-4">
	Category To Remove:<br/>

		{{ Form::open(array('action' => array('CategoryController@removeCategory'))) }}
		<select id="categorySelect" class="form-control" name="categoryDropdown">
			<option name="none">---</option>
			@for($i = 0; $i < count($categories); $i++)
				@if($categories[$i] != "textbook" && $categories[$i] != "miscellaneous" && $categories[$i] != "tickets")
					<option name="{{$categories[$i]}}">
					<?php $categories[$i] = str_replace("_"," ",$categories[$i]);
		    			$categories[$i] = ucwords($categories[$i]);?> 
					{{$categories[$i]}}</option>
				@endif
			@endfor
		</select>
		<br />
	    <a> <input class="btn btn-default btn-hugeSubmit" role="button" type="submit" value="Remove Category"> </a>
		{{ Form::token().Form::close() }}
</div>

@stop




@section('javascript')

<script>

</script>
@stop