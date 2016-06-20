@extends('layouts.admin')

@section('content')
    {!! form_start($form) !!}
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
    {!! form_row($form->manager_id) !!}
    {!! form_row($form->save) !!}
    {!! form_row($form->clear) !!}
    {!! form_end($form, false)!!}
    <script src="{{ url( 'packages/tinymce/tinymce.min.js' ) }}" type="text/javascript"></script>
    <script type="text/javascript">
    	$(function(){
    		var $template = $(".template");
			$(".btn-add-panel").on("click", function (e) {
				e.preventDefault();
				links(null, $template);
			});
			$(document).on('click', '.glyphicon-remove-circle', function () {
			  $(this).parents('.panel').get(0).remove();
			});
    		editor_init("#description");
			@if(old('links'))
                @foreach(old('links') as $link)
                    links({!! json_encode($link) !!}, $template);
                @endforeach
            @endif
    	})
    </script>
@endsection
