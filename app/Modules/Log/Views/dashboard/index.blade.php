@extends('layouts.admin')

@section('content')
	<style type="text/css">
		tr{
			direction: ltr  !important; 
			text-align:right !important; 
		}
	</style>
    @include('partials.admin.datatable', ['dataTable' => $dataTable, 'buttons' => true])
@endsection
