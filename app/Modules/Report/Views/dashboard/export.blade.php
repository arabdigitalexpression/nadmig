@extends('layouts.admin')

@section('content')
    <h3>تصدير التقارير</h3>
    <div class="form-group">
        <label for="period_type">تصدير</label>
        <br>
        <select name="period_type" class="period_type"> 
            <option value="all">كل التقرير</option>
            <option value="period">فى خلال فترة معينة</option>
        </select>
    </div>
    <div class="period" style="display: none;">
        <div class="form-group">
            <label for="from_date">من :</label>
            <input type="date" name="from_date" class="from_date">
            <label for="from_date">إلي :</label>
            <input type="date" name="to_date" class="to_date">
        </div>
    </div>
    <div class="form-group">
        <label for="from_date">نوع التقرير</label>
        <br>
        <select class="report">
            <option value="TrainerReport">تقارير المدربين</option>
            <option value="SpaceManager2Report">تقرير مدير المساحة نموذج ٢</option>
            <option value="LikeDislikeReport">تقرير اعجبنى و لم يعجبنى</option>
            <option value="Report8">نموذج ٨</option>
        </select>
    </div>
    <button class="btn btn-primary export">تصدير</button>
    <script type="text/javascript">
    	$(function(){
            $(".period_type").change(function(){
                if ($(this).val() == "period") {
                    $(".period").show();
                }else{
                    $(".period").hide();
                }
            })
    		$('.export').click(function(){
                if( $('.period_type option:selected').val() == "all" ){
                    location.href = '/dashboard/report/' + $('.report option:selected').val() + '/export/all';
                }else if ( $('.period_type option:selected').val() == "period" ){
                    location.href = '/dashboard/report/' + $('.report option:selected').val() + '/export/period/from/' + $(".from_date").val() + '/to/' +  $(".to_date").val();
                }
    		});
    	});
    </script>
@endsection
