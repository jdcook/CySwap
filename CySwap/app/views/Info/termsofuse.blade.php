@extends('layoutmain')

@section('content')

<h1>CySwap Terms of Use</h1>
<hr />
<br/>


<div class="panel panel-default">
    <div class="panel-body">
       <?php
        $myfile = fopen(dirname(__FILE__)."/../CySwapContent/terms_of_use.txt", "r") or die("Unable to open file!");
        $file = (string) fread($myfile,filesize(dirname(__FILE__)."/../CySwapContent/terms_of_use.txt"));
        $file_with_breaks =  nl2br($file);
        fclose($myfile);
        ?>
        {{$file_with_breaks}}
    </div>
</div>
@stop