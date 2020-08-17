@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">New Division</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.division.store') }}">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf

            {!! __form::textbox(
              '6', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
            ) !!}

            {!! __form::select_dynamic(
              '6', 'dept_id', 'Department *', old('dept_id'), $global_departments_all, 'dept_id', 'name', $errors->has('dept_id'), $errors->first('dept_id'), 'select2', ''
            ) !!}

            {!! __form::textbox(
              '6', 'acronym', 'text', 'Acronym', 'Acronym', old('acronym'), $errors->has('acronym'), $errors->first('acronym'), ''  
            ) !!}

          </div>
        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('DIV_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('DIV_CREATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection