<?php

  $table_sessions = [ Session::get('DEPT_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                        'page' => Request::get('page'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Departments</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.department.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.department.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('name', 'Name')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($departments as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->name }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.department.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.department.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($departments->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($departments) !!}
        {!! $departments->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('modals')

  {!! __html::modal_delete('department_delete') !!}

@endsection 



@section('scripts')

  <script type="text/javascript">

    {!! __js::button_modal_confirm_delete_caller('department_delete') !!}

    @if(Session::has('DEPT_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('DEPT_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('DEPT_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('DEPT_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection