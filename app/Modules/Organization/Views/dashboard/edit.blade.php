@extends('layouts.admin')

@section('content')
	
    {!! form_start($form) !!}
    {!! form_until($form, "name_en") !!}
    <img width="200" src="{{ $object->logo }}">
    {!! form_row($form->logo) !!}
     {!! form_until($form, "description") !!}
     <div class="panel-group" id="accordion" aria-multiselectable="true" data-prototype="{{ form_row($form->links->prototype()) }}">
        <div class="panel panel-default template" style="display: none;">
            <div class="panel-heading"> <span class="glyphicon glyphicon-remove-circle pull-left "></span>

              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true">
                  Collapsible Group Item #1 (template panel)
                </a>
              </h4>

            </div>
            <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">
                               
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-add-panel"> <i class="glyphicon glyphicon-plus"></i> أضف رابط</button>

    {!! form_row($form->organization_reservation) !!}
    {!! form_row($form->{"min_time_before_usage_to_edit[type]"}) !!}
    {!! form_row($form->{"min_time_before_usage_to_edit[period]"}) !!}
    {!! form_row($form->{"change_fees[type]"}) !!}
    {!! form_row($form->{"change_fees[amount]"}) !!}
    {!! form_row($form->{"min_to_cancel[type]"}) !!}
    {!! form_row($form->{"min_to_cancel[period]"}) !!}
    {!! form_row($form->{"cancel_fees[type]"}) !!}
    {!! form_row($form->{"cancel_fees[amount]"}) !!}
    {!! form_row($form->{"max_to_confirm[type]"}) !!}
    {!! form_row($form->{"max_to_confirm[period]"}) !!}
    {!! form_row($form->manager_id) !!}
    </br>
    </br>
    {!! form_row($form->submit) !!}
    {!! form_end($form, false)!!}
    <script src="{{ url( 'packages/tinymce/tinymce.min.js' ) }}" type="text/javascript"></script>
    <script type="text/javascript">
    	$(function(){
    		var $template = $(".template");
    		$template.find('.panel-body').html("");
			$(".btn-add-panel").on("click", function (e) {
				e.preventDefault();
				links(null, $template);
			});
			$(document).on('click', '.glyphicon-remove-circle', function () {
			  $(this).parents('.panel').get(0).remove();
			});
			@foreach($object->links as $link)          
                links({!! json_encode($link) !!}, $template);
            @endforeach
			
    		editor_init("#description");
            $('input[type=\'radio\']').change( function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('input[name="'+$(this).attr('name')+'"]:checked').val() == "null") {
                    $('#'+id+'_period').attr('type', 'hidden').val("");
                }else{
                    $('#'+id+'_period').attr('type', 'number');
                }
            });
            $('input[type=\'radio\']').change( function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('input[name="'+$(this).attr('name')+'"]:checked').val() == "null") {
                    $('#'+id).attr('type', 'hidden').val("");
                }else{
                    $('#'+id).attr('type', 'number');
                }
            });
            $('input[type=\'radio\']').each( function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('input[name="'+$(this).attr('name')+'"]:checked').val() == "null") {
                    $('#'+id+'_period').attr('type', 'hidden').val("");
                }else{
                    $('#'+id+'_period').attr('type', 'number');
                    $('#'+id).attr('type', 'number');
                }
            });
    	})
    </script>
@endsection
