@extends('layouts.admin-master')

@section('content')

<section class="content">
            

    {{-- PR and JR Listings --}}
    <div class="box box-solid">
      <div class="box-header with-border">
        <h2 class="box-title">Purchase Request and Job Request Listings</h2>
      </div>
      <form method="GET" autocomplete="off" action="{{ route('dashboard.reports.prjr_output') }}" target="_blank">

        <div class="box-body">   
          
            {!! __form::select_dynamic(
              '4', 'dept', 'Department', old('dept'), $global_departments_all, 'dept_id', 'name', $errors->has('dept'), $errors->first('dept'), 'select2', ''
            ) !!} 

            {!! __form::datepicker(
              '4', 'df',  'Date from *', old('df'), $errors->has('df'), $errors->first('df')
            ) !!}

            {!! __form::datepicker(
              '4', 'dt',  'Date to *', old('dt'), $errors->has('dt'), $errors->first('dt')
            ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Print <i class="fa fa-fw fa-print"></i></button>
        </div>

      </form>
    </div>


</section>

@endsection