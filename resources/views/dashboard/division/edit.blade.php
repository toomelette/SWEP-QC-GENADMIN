@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit Division</h2>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.division.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.division.update', $division->slug) }}">

        <div class="box-body">

          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            {!! __form::textbox(
              '6', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $division->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

            {!! __form::select_dynamic(
              '6', 'dept_id', 'Department *', old('dept_id')? old('dept_id') : $division->dept_id, $global_departments_all, 'dept_id', 'name', $errors->has('dept_id'), $errors->first('dept_id'), 'select2', ''
            ) !!}

            {!! __form::textbox(
              '6', 'acronym', 'text', 'Acronym', 'Acronym', old('acronym') ? old('acronym') : $division->acronym, $errors->has('acronym'), $errors->first('acronym'), ''
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

