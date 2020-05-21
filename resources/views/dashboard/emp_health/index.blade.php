<?php

  $table_sessions = [ Session::get('EMP_HEALTH_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>List of Personnel Health Records</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.emp_health.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.emp_health.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('emp_no', 'ID No.')</th>
            <th>@sortablelink('fullname', 'Fullname')</th>
            <th>@sortablelink('position', 'Position')</th>
            <th>@sortablelink('department_text', 'Department')</th>
            <th style="width: 200px">Action</th>
          </tr>
          @foreach($emp_health as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->emp_no }}</td>
              <td id="mid-vert">{{ $data->fullname }}</td>
              <td id="mid-vert">{{ $data->position }}</td>
              <td id="mid-vert">{{ $data->department_text }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  @if(in_array('dashboard.emp_health.show', $global_user_submenus))
                    <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.emp_health.show', $data->slug) }}">
                      <i class="fa fa-print"></i>
                    </a>
                  @endif
                  @if(in_array('dashboard.emp_health.edit', $global_user_submenus))
                    <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.emp_health.edit', $data->slug) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                  @endif
                  @if(in_array('dashboard.emp_health.destroy', $global_user_submenus))
                    <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.emp_health.destroy', $data->slug) }}">
                      <i class="fa fa-trash"></i>
                    </a>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($emp_health->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($emp_health) !!}
        {!! $emp_health->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('modals')

  {!! __html::modal_delete('emp_health_delete') !!}

@endsection 



@section('scripts')

  <script type="text/javascript">

    {!! __js::button_modal_confirm_delete_caller('emp_health_delete') !!}

    @if(Session::has('EMP_HEALTH_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('EMP_HEALTH_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection