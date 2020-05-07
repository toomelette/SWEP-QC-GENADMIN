<?php

  $table_sessions = [ Session::get('EMP_MASTER_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Employee Master List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.emp_med_record.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.emp_med_record.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('emp_no', 'Employee No.')</th>
            <th>@sortablelink('firstname', 'Fullname')</th>
            <th>@sortablelink('position', 'Position')</th>
            <th style="width: 250px">Action</th>
          </tr>
          @foreach($employees as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->emp_no }}</td>
              <td id="mid-vert">{{ $data->fullname() }}</td>
              <td id="mid-vert">{{ $data->position }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  @if(in_array('dashboard.emp_med_record.edit', $global_user_submenus))
                    <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.emp_med_record.edit', $data->slug) }}">
                      Medical History &nbsp;<i class="fa fa-stethoscope"></i>
                    </a>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($employees->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($employees) !!}
        {!! $employees->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('scripts')

  <script type="text/javascript">

    @if(Session::has('EMP_MASTER_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_MASTER_UPDATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection