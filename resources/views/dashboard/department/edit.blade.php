@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit Department</h2>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.department.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.department.update', $department->slug) }}">

        <div class="box-body">

          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            {!! __form::textbox(
              '8', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $department->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'acronym', 'text', 'Acronym', 'Acronym', old('acronym') ? old('acronym') : $department->acronym, $errors->has('acronym'), $errors->first('acronym'), ''
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

