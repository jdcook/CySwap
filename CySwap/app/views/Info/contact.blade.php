@extends('layoutmain')

@section('content')

<h1>Contact Us</h1>
<hr />
<br/>


<div class="panel panel-default">
    <div class="panel-body">
       <?php
        $myfile = fopen(dirname(__FILE__)."/../CySwapContent/contact_us.txt", "r") or die("Unable to open file!");
        $file = fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/contact_us.txt"));
        $file_with_breaks =  nl2br($file);
        fclose($myfile);
        ?>
        {{$file_with_breaks}}
    </div>
</div>



@stop