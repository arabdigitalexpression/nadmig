@extends('layouts.application')

@section('title'){{ getTitle($report->user->name) }}@endsection


@section('content')
    <h3><img class="img-responsive user-thumbnail" src="{{ url($report->user->picture) }}">  {{ $report->user->name }}</h3>
    @if(diff_in_weeks_and_days(\Carbon\Carbon::createFromFormat('Y/m/d', $report->event->reservation->sessions()->first()['start_date'])->format('Y-m-d'), \Carbon\Carbon::now()) == $report->week)
	    <div class="pull-left">
	    	<a style="font-size: 18px;" href="{{ route('report.page.event.edit', ['event_slug' => $report->event->slug, 'week' => $report->week, 'user_id' => $report->user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	    </div>
    @endif
    <h4>الاسبوع {{ $report->week }}</h4>
    <h4>الورشة {{ $report->event->reservation->name }}</h4>
    <h3 class="page-header">الشق القيمي</h3>
    <h4>الثقة في النفس</h4>
    {{ TrainerReportAnswer($report->confidence->percentage) }}
    </br>
    {{ $report->confidence->text }}
    <h4>الأخذ بالمبادرة</h4>
    {{ TrainerReportAnswer($report->initiative->percentage) }}
    </br>
    {{ $report->initiative->text }}
    <h4>احترام وتقبل رأي الأخر</h4>
    {{ TrainerReportAnswer($report->respect_and_accept->percentage) }}
    </br>
    {{ $report->respect_and_accept->text }}
    <h4>القدرة على العمل الجماعي</h4>
    {{ TrainerReportAnswer($report->team_work->percentage) }}
    </br>
    {{ $report->team_work->text }}
    <h4>التفكير النقدي</h4>
    {{ TrainerReportAnswer($report->critical_thinking->percentage) }}
    </br>
    {{ $report->critical_thinking->text }}
    <h4>القدرة على الخيال</h4>
    {{ TrainerReportAnswer($report->imagination->percentage) }}
    </br>
    {{ $report->imagination->text }}
    <h4>منفتح على التغــُير والتغيير 	</h4>
    {{ TrainerReportAnswer($report->open_to_change->percentage) }}
    </br>
    {{ $report->open_to_change->text }}
    <h3 class="page-header">الشق المعرفي والمهاري</h3>
    <h4>القدرة على فهم المحتوى</h4>
    {{ TrainerReportAnswer($report->ability_to_understand_the_content->percentage) }}
    </br>
    {{ $report->ability_to_understand_the_content->text }}
    <h4>القدرة على انتاج عمل فني</h4>
    {{ TrainerReportAnswer($report->ability_to_produce_art->percentage) }}
    </br>
    {{ $report->ability_to_produce_art->text }}
    <h4>القدرة على التحليل</h4>
    {{ TrainerReportAnswer($report->ability_to_thinking->percentage) }}
    </br>
    {{ $report->ability_to_thinking->text }}
    <h4>القدرة على الابتكار</h4>
    {{ TrainerReportAnswer($report->ability_to_inovate->percentage) }}
    </br>
    {{ $report->ability_to_inovate->text }}
@endsection
