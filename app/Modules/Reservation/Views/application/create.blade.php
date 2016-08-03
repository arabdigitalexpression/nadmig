@extends('layouts.application')

@section('title'){{ getTitle('الحجز '. $extra->name) }}@endsection

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
        $(function () {
            // apply check action
            $("#apply").change(function() {
                if(this.checked) {
                    $('.apply').show();
                }else{
                    $('.apply').hide();
                }
            });
            
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
            @if(old('session'))
                @foreach(old('session') as $session)
                    new_session({!! json_encode($session) !!});
                @endforeach
            @else
                new_session();
            @endif
            var week_days = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
            $(".btn-add-panel").on("click", function (e) {
                e.preventDefault();
                new_session();
            });
            $(document).on('click', '.glyphicon-remove-circle', function () {
                $(this).parents('.panel').get(0).remove();
            });
            
            function new_session(data){
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
                }else{
                    $newPanel.find("#name").val("الجلسة # " + hash);
                }
                $newPanel.find("#period_period").after( '<span class="help-block"></span>' );
                // rename the fields for the pickers
                $newPanel.find("#start_date").attr("id", "start_date_" + hash);
                $newPanel.find("#name").attr("id", "name_" + hash);
                $newPanel.find("#start_time").attr("id", "start_time_" + hash);
                $newPanel.find("#description").attr("id", "description_" + hash);
                $newPanel.find("#space_select").attr("id", "space_select_" + hash);
                $newPanel.find("#period_type").attr("id", "period_type_" + hash);
                $newPanel.find("#period_period").attr("id", "period_period_" + hash);
                $newPanel.find("#fees").attr("id", "fees_" + hash);
                $newPanel.find('.agreement').attr("class", "agreement_text_"+hash);
                $("#accordion").append($newPanel.fadeIn());
                editor_init("#description_" + hash);
                getSpaceData($("#space_select_" + hash ).val(), true);
                $("#space_select_" + hash ).change(function() {
                    getSpaceData($(this).val());
                });
                
            }
            function getSpaceData(space_id,  is_data) {
                var picker = date();
                var picker_time = time();
                $(".panel-body").find(".fa-spin").show();
                $.getJSON('/api/space/' + space_id , function( json ) {
                    agreement(json);
                    fees(json);
                    min_res(json);
                    var working_hours = json.working_hours_days;
                    var working_week_days = json.working_week_days;
                    var difference = $(week_days).not(working_week_days).get();
                    var max_before = json.max_time_before_reservation;                    
                    @if(Auth::user()->hasRole('admin') && Auth::user()->manageOrganization['id'] == $extra->id)
                        if(max_before.type == 'days'){
                            picker.set('max', parseInt(max_before.period));
                        }
                        picker.set('min', true);
                    @endif
                    if (!is_data) {
                        picker.clear();
                        picker.set('enable', true);
                        picker_time.clear();
                    }
                    picker.set('disable', getNotWorkingDays(difference));
                    picker.on({ set: function(context) {
                        var day = null;
                        if(moment(context.select).weekday() < 6){
                            day = moment(context.select).weekday();
                        }else{
                            day = 0;
                        }
                        picker_time.set('disable', false);
                        var date = moment(context.select).format("YYYY/MM/DD");
                        if(working_hours[week_days[day]]['from'] != "" && working_hours[week_days[day]]['to'] != ""){
                            picker_time.set('disable', [{ from: [00, 0], to: getTime(moment(working_hours[week_days[day]].from, "hh:mm a").subtract(30, 'minutes').format("h:mm A"))},{ from: getTime(moment(working_hours[week_days[day]].to, "hh:mm a").add(30, 'minutes').format("h:mm A")) , to:[23, 30]}]);     
                        }
                        $.getJSON('/api/space/' + space_id + '/' + date, function( data ) {
                            $.each(data, function( index, value ) {
                              picker_time.set('disable', [{ from: getTime(value.start_time), to: getTime(moment(value.start_time, "hh:mm a").add(value.period.period, value.period.type).format("h:mm A"))}]);
                            }); 
                        });
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
                var $input = $('#start_date_' + hash).pickadate({
                    firstDay: 0,
                    format: 'dd/mm/yyyy',
                });
                return $input.pickadate('picker');
            }
            function min_res(json){
                var min = json.min_type_for_reservation;
                var max = json.max_type_for_reservation;                
                $("#period_period_" + hash).parent().find('.help-block').text('الحجز الأدنى ' + min.period + ' ' + TimeTypeArabic(min) + ' | الحجز الأقصى ' + max.period + ' ' + TimeTypeArabic(max));
                $("#period_period_" + hash).bind('input propertychange', function() {
                    if(($(this).val() < parseInt(min.period)  && min.type == $("#period_type_" + hash).val()) || (min.type == 'hours' && $("#period_type_" + hash).val() == 'mins') || ($(this).val() > parseInt(max.period)  && max.type == $("#period_type_" + hash).val())){
                        $(this).parent().addClass('has-error');
                        $(this).parent().find('.help-block').text('الحجز الأدنى ' + min.period + ' ' + TimeTypeArabic(min) + ' | الحجز الأقصى ' + max.period + ' ' + TimeTypeArabic(max));
                        $('button[type=submit]').attr('disabled', '');
                        $(this).closest(".panel").css("border", "#a94442 1px solid");
                    }else{
                        $(this).parent().removeClass('has-error');
                        $(this).parent().find('.help-block').text("");
                        $('button[type=submit]').removeAttr('disabled');
                        $(this).closest(".panel").css("border", "#ddd 1px solid");
                    }
                });
            }
            function TimeTypeArabic(period){
                var Atype;
                if(period.type == 'hours'){
                    if(parseInt(period.period) > 1){
                        Atype = 'ساعات';
                    }else{
                        Atype = 'ساعة';
                    }
                }else if(period.type == 'mins'){
                    Atype = 'دقيقة';   
                }
                else if(period.type == 'days'){
                    Atype = 'يوم';   
                }
                return Atype;
            }
            function time(){
                var $input = $('#start_time_' + hash).pickatime();
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
                     $("#fees_" + hash).hide();

                }else if(json.in_return_key == 'min'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.min') }}" + ' ' +json.in_return);
                }
                else if(json.in_return_key == 'exact'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.exact') }}" + ' ' +json.in_return);
                }
                else if(json.in_return_key == 'any'){
                    $(".panel-body").find(".fees").text("{{ trans('Reservation::application.fields.reservation.any') }}" + ' ' +json.in_return);
                }
                $("#fees_" + hash).bind('input propertychange', function() {
                    if($(this).val() < parseInt(json.in_return) && (json.in_return_key == 'min' || json.in_return_key == 'exact')){
                        $(this).parent().addClass('has-error');
                        $('button[type=submit]').attr('disabled', '');
                        $(this).closest(".panel").css("border", "#a94442 1px solid");
                    }else{
                        $(this).parent().removeClass('has-error');
                        $('button[type=submit]').removeAttr('disabled');
                        $(this).closest(".panel").css("border", "#ddd 1px solid");
                    }
                });
            }
            function getTime(time){
                var hour = time.split(":")[0];
                var mins = time.split(":")[1].split(" ")[0];
                var type = time.split(":")[1].split(" ")[1];
                if( type == 'PM' ){
                    hour = parseInt(hour) + 12;
                }
                if( parseInt(hour) == 24 ){
                    hour = parseInt("00");
                }
                
                return [hour, mins];
            }
            $('#apply_deadline').pickadate({
                firstDay: 0,
                format: 'dd/mm/yyyy',
                min: true,
                disable: [
                    // get not working days
                    @if ($extra->working_week_days)
                        {!! implode(",",getNotWorkingWeekdays($extra->working_week_days)); !!}
                    @endif
                ]
            });
        });
    </script>
@endsection
