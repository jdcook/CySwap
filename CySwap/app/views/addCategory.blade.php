@extends('layoutmain')



@section('content')
<div class="col-sm-12">
    <h1><b>Add Category</b></h1>
    <p>The following are required: Category Name, Field Name(s), and Order.<br/>Leaving the character limit empty means you do not wish there to be a character limit on this field.</p>
    <hr/>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


{{ Form::open(array('action'=>'CategoryController@createCategory')) }}

<div class="wrapper-cushy">
    <div class="input-group">
        <span class="input-group-addon">Category Name:</span>
        <input class="form-control" type="text" name="categoryName" />
    </div>

    <div class="row centered wrapper-cushy">
    	<div class="col-sm-3">
        	<strong>Has Item Condition: </strong>
        	<input type="checkbox" name="hasCondition" />
    	</div>
    	<div class="col-sm-3">
        	<strong>Item Condition is required: </strong>
        	<input type="checkbox" name="fieldCondition_isRequired" />
        </div>
		<div class="col-sm-4">
      		<strong>Item Condition's order: </strong>
      		<input class="one-fifth" type="number" min="1" name="fieldCondition_order" />
        </div>
    </div>
</div>
<br/>
<div class="container wrapper-cushy">
    <div class="row centered cushy bigger">
        <div class="col-sm-2">
            <strong>Field Name</strong>
        </div>

        <div class="col-sm-2">
            <strong>Order</strong>
        </div>
        <div class="col-sm-2">
            <strong>Is Searchable</strong>
        </div>
        <div class="col-sm-2">
            <strong>Is Required</strong>
        </div>
        <div class="col-sm-2">
            <strong>Character Limit</strong>
        </div>
    </div>
    <div class="row centered wrapper-cushy">
        <div class="col-sm-2">
            Title
        </div>

        <div class="col-sm-2">
            1
        </div>
        <div class="col-sm-2">
            <input type="checkbox" name="fieldTitle_isSearchable" />
        </div>
        <div class="col-sm-2">
            <input type="checkbox" checked="true" disabled="true"/>
        </div>
        <div class="col-sm-2">
            255
        </div>
    </div>

    <div class="row centered wrapper-cushy">
        <div class="col-sm-2">
            Description
        </div>

        <div class="col-sm-2">
            <input class="half" type="number" min="1" name="fieldDescription_order" />
        </div>
        <div class="col-sm-2">
            <input type="checkbox" name="fieldDescription_isSearchable" />
        </div>
        <div class="col-sm-2">
            <input type="checkbox" name="fieldDescription_isRequired" />
        </div>
        <div class="col-sm-2">
            <input class="half" type="number" min="0" name="fieldDescription_characterLimit" />
        </div>
    </div>

    <div id="addfield"></div>
    <br/>
    <br/>
    <a id="addFieldBtn" class="btn btn-default btn-positive">Add Field</a>
</div>
<input id="fieldCounter" name="counter" type="hidden" value="0">
{{ Form::submit('Create Category', ['class' => 'btn btn-hugeSubmit', 'role' => 'button']) }}
{{ Form::token().Form::close() }}

@stop




@section('javascript')

<script>
$('#addFieldBtn').click(function(){
    var counter = $('#fieldCounter');
    var counterVal = parseInt(counter.val());

    //field names are like so: name='field0_characterLimit'
    var namePrepend = "field"+counterVal+"_";
    $('#addfield').before(
        "<div class='row centered wrapper-cushy'>"
            +"<div class='col-sm-2'>"
                +"<input type='text' name='"+namePrepend+"fieldName' />"
            +"</div>"

            +"<div class='col-sm-2'>"
                +"<input class='half' type='number' min='1' name='"+namePrepend+"order' />"
            +"</div>"
            +"<div class='col-sm-2'>"
                +"<input type='checkbox' name='"+namePrepend+"isSearchable' />"
            +"</div>"
            +"<div class='col-sm-2'>"
                +"<input type='checkbox' name='"+namePrepend+"isRequired' />"
            +"</div>"
            +"<div class='col-sm-2'>"
                +"<input class='half' type='number' min='0' name='"+namePrepend+"characterLimit' />"
            +"</div>"
        +"</div>"
    );

    counter.val(counterVal + 1);
})
</script>
@stop