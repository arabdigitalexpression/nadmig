@extends('layouts.application')

@section('title'){{ getTitle($extra->name) }}@endsection
@section('content')
    {{ $extra->name }}
    {!! form_start($form) !!}
    {!! form_row($form->name) !!}
    {!! form_row($form->space_info) !!}
    <div class="panel-group" id="accordion" aria-multiselectable="true" data-prototype="{{ form_row($form->session->prototype()) }}">
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
                                {!! form_row($form->session) !!}
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-add-panel"> <i class="glyphicon glyphicon-plus"></i> أضف جلسه</button>
    {!! form_rest($form) !!}
    <script src="{{ url( 'packages/tinymce/tinymce.min.js' ) }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('select').on('change', function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('#' + $(this).attr('id') + ' option:selected').val() == "null") {
                    $('#'+id+'_period').attr('type', 'hidden');
                }else{
                    $('#'+id+'_period').attr('type', 'number');
                }
            });
            var $template = $(".template");
            var hash = 0;
            @foreach($object->sessions as $session)
                new_session({!! json_encode($session) !!});
                date();
            @endforeach
            editor_init("#apply_agreement");
            $(".btn-add-panel").on("click", function (e) {
                e.preventDefault();
                new_session();
                date();
            });
            $(document).on('click', '.glyphicon-remove-circle', function () {
                $(this).parents('.panel').get(0).remove();
            });
            function new_session(data = null){
                var $newPanel = $template.clone();
                $newPanel.find(".collapse").removeClass("in");
                $newPanel.find(".accordion-toggle").attr("href", "#" + (++hash)).text("الجلسة # " + hash);
                var count = $("#accordion").children().length;
                var proto = $("#accordion").data('prototype').replace(/__NAME__/g, count)
                                .replace(/\[start_time\[date\]\]/g, "[start_time][date]")
                                .replace(/\[start_time\[time\]\]/g, "[start_time][time]")
                                .replace(/\[period\[type\]\]/g, "[period][type]")
                                .replace(/\[period\[period\]\]/g, "[period][period]");
                $newPanel.find(".panel-collapse").attr("id", hash);
                $newPanel.find('.panel-body').empty().append(proto);
                // replace sessions data
                if(data){
                    $.each(data, function(index, value){
                        if(typeof value === 'object'){
                            $.each(value, function(key, val){
                                $newPanel.find("#start_" + key).val(val);
                                $newPanel.find("#period_" + key).val(val);
                            });
                        }else{
                            $newPanel.find("#" + index).val(value);    
                        }
                    })    
                }
                // rename the fields for the pickers
                $newPanel.find("#start_date").attr("id", "start_date_" + hash);
                $newPanel.find("#start_time").attr("id", "start_time_" + hash);
                $newPanel.find("#description").attr("id", "description_" + hash);
                $("#accordion").append($newPanel.fadeIn());
                editor_init("#description_" + hash);
            }
            function date(){
                $('#start_date_' + hash).pickadate({
                    firstDay: 0,
                    format: 'dd/mm/yyyy',
                    min: new Date(2016,3,1),
                    disable: [
                        // get not working days
                        @if ($extra->working_week_days)
                            {!! implode(",",getNotWorkingWeekdays($extra->working_week_days)); !!}
                        @endif
                    ]
                });
                $('#start_time_' + hash).pickatime();                
            }
            var $deadline = $('#apply_deadline').pickadate({
                firstDay: 0,
                format: 'dd/mm/yyyy',
                min: new Date(2016,3,1),
                disable: [
                    // get not working days
                    @if ($extra->working_week_days)
                        {!! implode(",",getNotWorkingWeekdays($extra->working_week_days)); !!}
                    @endif
                ]
            });
            function editor_init(selector){
                tinymce.init({
                    selector: selector,
                    theme: "modern",
                    menubar : false,
                    relative_urls: false,
                    forced_root_block: false, // Start tinyMCE without any paragraph tag
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars media nonbreaking",
                        "table contextmenu directionality paste textcolor code localautosave"
                    ],
                    toolbar1: "localautosave | bold italic underline hr | forecolor backcolor paste | bullist numlist outdent indent",
                    entity_encoding: "raw",
                    directionality : "rtl",
                    language: "ar"
                });    
            }
            $('select').each(function() {
                var id = $(this).attr('name').replace("[type]", ""); 
                if ($('#' + $(this).attr('id') + ' option:selected').val() == "null") {
                    $('#'+id+'_period').attr('type', 'hidden');
                }else{
                    $('#'+id+'_period').attr('type', 'number');
                }
            });
        });
    </script>
@endsection
