@extends('layouts.application')

@section('title'){{ getTitle($extra->name) }}@endsection
@section('content')
    {{ $extra->name }}
    {!! form_start($form) !!}
    {!! form_row($form->name) !!}
    {!! form_row($form->artwork) !!}
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
     {!! form_until($form, 'apply'); !!}
    <div class="apply" style="display: none;">
        {!! form_until($form, 'apply_agreement'); !!}
    </div>
    {!! form_end($form, true); !!}
    <script src="{{ url( 'packages/tinymce/tinymce.min.js' ) }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            // apply check action
            $("#apply").change(function() {
                if(this.checked) {
                    $('.apply').show();
                }else{
                    $('.apply').hide();
                }
            });
            if($("#apply").is(":checked")) {
                $('.apply').show();
            }else{
                $('.apply').hide();
            }
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
            @endforeach
            var week_days = ["sat", "sun", "mon", "tue", "wed", "thu", "fri"];
            $(".btn-add-panel").on("click", function (e) {
                e.preventDefault();
                new_session();
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
                        if(typeof value === 'object' && value != null){
                            $.each(value, function(key, val){
                                $newPanel.find("#start_" + key).val(val);
                                $newPanel.find("#period_" + key).val(val);
                            });
                        }else{
                            if(index == 'space_id'){
                                $newPanel.find("#space_select").val(value);       
                            }else{
                                $newPanel.find("#" + index).val(value);        
                            }
                            
                        }
                    })    
                }
                // rename the fields for the pickers
                $newPanel.find("#start_date").attr("id", "start_date_" + hash);
                $newPanel.find("#start_time").attr("id", "start_time_" + hash);
                $newPanel.find("#description").attr("id", "description_" + hash);
                $newPanel.find("#space_select").attr("id", "space_select_" + hash);
                $newPanel.find("#fees").attr("id", "fees_" + hash);
                $("#accordion").append($newPanel.fadeIn());
                editor_init("#description_" + hash);
                $("#space_select_" + hash ).change(function() {
                    getSpaceData($(this).val());
                });
            }
            function getSpaceData(space_id) {
                let picker = date();
                let picker_time = time();
                $(".panel-body").find(".fa-spin").show();
                $.getJSON('/api/space/' + space_id , function( json ) {
                    agreement(json);
                    fees(json);
                    let working_hours = JSON.parse(json.working_hours_days);
                    let working_week_days = JSON.parse(json.working_week_days);
                    let difference = $(week_days).not(working_week_days).get();
                    picker.clear();
                    picker.set('enable', true);
                    picker_time.clear();
                    picker.set('disable', getNotWorkingDays(difference));
                    picker.on({ set: function(context) {
                        let day = 0;
                        if(moment(context.select).weekday() < 6){
                            day = moment(context.select).weekday() + 1;
                        }
                        picker_time.set('disable', false);
                        picker_time.set('disable', [{ from: [00, 0], to: [23, 30] },{ from: getTime(working_hours[week_days[day]]['from']), to: getTime(working_hours[week_days[day]]['to']), inverted: true }]);
                      }
                    })
                })
                .done(function() {
                    $(".panel-body").find(".fa-spin").hide();
                });
            }
            function agreement(json){
                $('.agreement_text_'+hash).attr("data-content", json.agreement_text);
                $('.agreement_text_'+hash).popover();
            }
            function date(){
                let $input = $('#start_date_' + hash).pickadate({
                    firstDay: 0,
                    format: 'dd/mm/yyyy',
                    min: new Date(2016,3,1)
                });
                return $input.pickadate('picker');
            }
            function time(){
                let $input = $('#start_time_' + hash).pickatime();
                return $input.pickatime( 'picker' );
            }
            function getNotWorkingDays(difference){
                var days = {"sun": 1, "mon": 2, "tue": 3, "wed": 4, "thu": 5, "fri": 6,"sat": 7};
                var array = [];
                $.each(difference, function( index, value ) {
                  array.push(days[value]);
                });
                return array;
            }
            function fees(json){
                 if(json.in_return_key == 'free'){
                     $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.free') }}");

                }else if(json.in_return_key == 'min'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.min') }}" + ' ' +json.in_return);
                }
                else if(json.in_return_key == 'max'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.max') }}" + ' ' +json.in_return);
                }
                else if(json.in_return_key == 'any'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.any') }}" + ' ' +json.in_return);
                }
            }
            function getTime(time){
                var hour = time.split(":")[0];
                var mins = time.split(":")[1].split(" ")[0];
                var type = time.split(":")[1].split(" ")[1];
                if( type == 'PM' ){
                    hour = parseInt(hour) + 12;
                }
                if( parseInt(hour) == 24 ){
                    hour = 00
                }
                return [hour, mins];
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
