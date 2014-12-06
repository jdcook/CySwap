@extends('layoutmain')



@section('content')
<div class="col-md-12">
    

<h1><b>Update Content</b></h1>
<hr/>
</div>
</br>
</br>
</br>
</br>
</br>
</br>
<!-- Update Terms of Use -->
<?php
	$myfile = fopen(dirname(__FILE__)."/../CySwapContent/terms_of_use.txt", "r") or die("Unable to open file!");
	$terms = fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/terms_of_use.txt"));
	fclose($myfile);	
?>
{{ Form::open(array('url'=>'updateTermsOfUse')) }}
<div class="input-group detail">
	<span class="input-group-addon">{{ Form::label('Terms of Use') }}</span>
	{{ Form::textarea('terms_of_use',$terms,array('id'=>'terms_of_use','size' => '120x5')) }}
	<div class="col-md-12">
		{{ Form::submit('Update Terms Of Use', ['class' => 'btn btn-default']) }}
	</div>
</div>
{{ Form::close() }}

<!-- Update Contact Us -->
<?php
	$myfile = fopen(dirname(__FILE__)."/../CySwapContent/contact_us.txt", "r") or die("Unable to open file!");
	$contact_us = fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/contact_us.txt"));
	fclose($myfile);	
?>
{{ Form::open(array('url'=>'updateContactUs')) }}  
<div class="input-group detail">
	<span class="input-group-addon">{{ Form::label('Contact Us') }}</span>
	{{ Form::textarea('contact_us',$contact_us,array('id'=>'contact_us','size' => '120x5')) }}
	<div class="col-md-12">
		{{ Form::submit('Update Contact Us', ['class' => 'btn btn-default']) }}
	</div>
</div>
{{ Form::close() }}

<!-- Update About Us -->
<?php
	$myfile = fopen(dirname(__FILE__)."/../CySwapContent/about_us.txt", "r") or die("Unable to open file!");
	$about_us = fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/about_us.txt"));
	fclose($myfile);	
?>
{{ Form::open(array('url'=>'updateAboutUs')) }}
<div class="input-group detail">
	<span class="input-group-addon">{{ Form::label('About Us') }}</span>
	{{ Form::textarea('about_us',$about_us,array('id'=>'about_us','size' => '120x5')) }}
	<div class="col-md-12">
		{{ Form::submit('Update About Us', ['class' => 'btn btn-default']) }}
	</div>
</div>
{{ Form::close() }}

<!-- Update Safety -->
<?php
	$myfile = fopen(dirname(__FILE__)."/../CySwapContent/contact_us.txt", "r") or die("Unable to open file!");
	$safety = fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/contact_us.txt"));
	fclose($myfile);	
?>
{{ Form::open(array('url'=>'updateSafety')) }}  
<div class="input-group detail">
	<span class="input-group-addon">{{ Form::label('   Safety   ') }}</span>
	{{ Form::textarea('safety',$safety,array('id'=>'safety','size' => '120x5')) }}
	<div class="col-md-12">
		{{ Form::submit('Update Safety', ['class' => 'btn btn-default']) }}
	</div>
</div>
{{ Form::close() }}

@stop




@section('javascript')

<script>

</script>
@stop