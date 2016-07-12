@extends('layouts.admin')

@section('content')
    <h3>قم بأختير التقرير الذي ترغب فى تصديره</h3>
    <select class="report">
    	<option value="TrainerReport">تقارير المدربين</option>
    	<option value="SpaceManager2Report">تقرير مدير المساحة نموذج ٢</option>
    	<option value="LikeDislikeReport">تقرير اعجبنى و لم يعجبنى</option>
    </select>
    </br>
    </br>
    <button class="btn btn-primary export">تصدير</button>
    <script type="text/javascript">
    	$(function(){
    		$('.export').click(function(){
    			location.href = '/dashboard/report/' + $('.report option:selected').val() + '/export';
    		});
    	});
    </script>
@endsection
