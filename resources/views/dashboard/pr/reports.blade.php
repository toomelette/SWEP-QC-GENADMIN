@extends('layouts.admin-master')

@section('content')

<section class="content">
       

  {{-- PR Reports --}}
  <div class="box box-solid">
      
    <div class="box-header with-border">
      <h2 class="box-title"><b>Listings</b></h2>
      <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
      </div> 
    </div>
    
    <form method="GET" action="{{ route('dashboard.pr.reports_output') }}" target="_blank">

      <div class="box-body">
        <div class="col-md-12">

            {!! __form::select_dynamic(
                '3', 'dept', 'Department', old('dept'), $global_departments_all, 'dept_id', 'name', $errors->has('dept'), $errors->first('dept'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
                '3', 'div', 'Divisions', old('div'), $global_divisions_all, 'div_id', 'name', $errors->has('div'), $errors->first('div'), 'select2', ''
            ) !!}

            {!! __form::datepicker(
                '3', 'df',  'Date from *', old('df'), $errors->has('df'), $errors->first('df')
            ) !!}

            {!! __form::datepicker(
                '3', 'dt',  'Date to *', old('dt'), $errors->has('dt'), $errors->first('dt')
            ) !!}

        </div>
      </div>

      <div class="box-footer">
        <button class="btn btn-default submit_button_md" data-type="p">
          Print <i class="fa fa-fw fa-print"></i>
        </button>
      </div>

    </form>

  </div>



</section>

@endsection