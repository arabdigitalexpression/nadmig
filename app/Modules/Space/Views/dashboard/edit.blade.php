@extends('layouts.admin')

@section('content')
    {!! form_start($form) !!}
    {!! form_until($form, "description") !!}
     <div class="panel-group" id="accordion" aria-multiselectable="true" data-prototype="{{ form_row($form->links->prototype()) }}">
        <div class="panel panel-default template" style="display: none;">
            <div class="panel-heading"> <span class="glyphicon glyphicon-remove-circle pull-left "></span>
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true">
                </a>
              </h4>

            </div>
            <div id="collapseThree" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">
                               {!! form_row($form->links) !!} 
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-add-panel"> <i class="glyphicon glyphicon-plus"></i> أضف رابط</button>
    {!! form_rest($form)!!}
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
			@if($object->links)
				@foreach($object->links as $link)          
	                links({!! json_encode($link) !!}, $template);
	            @endforeach
            @endif


			$('#in_return_key').change( function() {
				if ($('#in_return_key option:selected').val() == "free" || $('#in_return_key option:selected').val() == "any") {
					$('#in_return').attr('type', 'hidden').val("");
				}else{
					$('#in_return').attr('type', 'number');
				}
			});
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
			$(".chosen-select").chosen({width: "100%", placeholder_text_multiple: "قم بأختيار تجهيزات المساحة"});
			var weekdays = ['sat', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri'];
			$.each(weekdays, function(index, value){
				$('#'+value+'_from').pickatime();
				$('#'+value+'_to').pickatime();
			});
			editor_init("#description");
			editor_init("#agreement_text");
		});
	</script>
@endsection

