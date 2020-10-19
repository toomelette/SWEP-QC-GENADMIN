<?php

  $table_sessions = [ Session::get('JO_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'page' => Request::get('page'),
                        'e' => Request::get('e'),
                        'dept' => Request::get('dept'),
                        'div' => Request::get('div'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Job Order List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.jo.index') }}">

    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      {!! __form::select_dynamic_for_filter(
        '4', 'dept', 'Department', old('dept'), $global_departments_all, 'dept_id', 'name', 'submit_jo_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '4', 'div', 'Division', old('div'), $global_divisions_all, 'div_id', 'name', 'submit_jo_filter', 'select2', 'style="width:100%;"'
      ) !!}

    {!! __html::filter_close('submit_jo_filter') !!}

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.jo.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('jo_no', 'JO No.')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('department.name', 'Department')</th>
            <th>@sortablelink('division.name', 'Division')</th>
            <th>@sortablelink('created_at', 'Date Encoded')</th>
            <th style="width: 280px">Action</th>
          </tr>
          @foreach($jo_list as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{!! $data->displayJONoSpan() !!}</td>
              <td id="mid-vert">{{ $data->description }}</td>
              <td id="mid-vert">{{ optional($data->department)->acronym }}</td>
              <td id="mid-vert">{{ optional($data->division)->name }}</td>
              <td id="mid-vert">{{ __dataType::date_parse($data->created_at, 'm/d/Y h:i A') }}</td>
              
              <td id="mid-vert">

                <div class="btn-group">
                  <a type="button" 
                     class="btn btn-default" 
                     href="#" 
                     id="set_jo_no_btn" 
                     data-jo_no="{{ $data->jo_no }}" 
                     data-date="{{ __dataType::date_parse($data->date, 'm/d/Y') }}" 
                     data-jr_id="{{ $data->jr_id }}" 
                     data-url="{{ route('dashboard.jo.set_jo_no', $data->slug) }}">
                    {{ isset($data->jo_no) ? 'Update JO No.' : 'Set JO No' }}<b></b>
                  </a>
                </div>

                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.jo.show', $data->slug) }}">
                    <i class="fa fa-print"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.jo.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.jo.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>

            </tr>
            @endforeach
          </table>
      </div>

      @if($jo_list->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($jo_list) !!}
        {!! $jo_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('modals')

  {!! __html::modal_delete('jo_delete') !!}

  @if(Session::has('JO_UPDATE_SUCCESS'))
    {!! __html::modal_print(
    'jo_update', '<i class="fa fa-fw fa-check"></i> Updated!', Session::get('JO_UPDATE_SUCCESS'), route('dashboard.jo.show', Session::get('JO_UPDATE_SUCCESS_SLUG'))
    ) !!}
  @endif



  {{-- SET PO NO --}}
  <div class="modal fade" id="set_jo_no_modal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <i class="fa fa-certificate"></i> &nbsp;Set JO No
            <div class="pull-right">
              <code>Fields with asterisks(*) are required</code>
            </div> 
          </h4>
        </div>
        <div class="modal-body">
          
          <form method="POST" id="set_jo_no_form" autocomplete="off">
            
            @csrf

            <div class="row">

              {!! __form::textbox(
                '12', 'jo_no', 'text', 'JO No.', 'JO No.', '', $errors->has('jo_no'), $errors->first('jo_no'), ''
              ) !!}

              {!! __form::datepicker(
                '12', 'date',  'Date', '', $errors->has('date'), $errors->first('date')
              ) !!}

              {!! __form::select_dynamic(
                '12', 'jr_id', 'Reference J.R No.', '', $global_jr_all, 'jr_id', 'jr_no', $errors->has('jr_id'), $errors->first('jr_id'), 'select2', 'style="width:100%;"'
              ) !!}

          </div>

          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save <i class="fa fa-fw fa-save"></i></button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection 



@section('scripts')

  <script type="text/javascript">
  
    @if(Session::has('JO_UPDATE_SUCCESS'))
      $('#jo_update').modal('show');
    @endif

    {!! __js::button_modal_confirm_delete_caller('jo_delete') !!}

    @if(Session::has('JO_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('JO_DELETE_SUCCESS')) !!}
    @endif

    @if(Session::has('JO_SET_JO_NO_SUCCESS'))
      {!! __js::toast(Session::get('JO_SET_JO_NO_SUCCESS')) !!}
    @endif


    {{-- CALL PO SET JO NO MODAL --}}
    $(document).on("click", "#set_jo_no_btn", function () {

        $("#set_jo_no_modal").modal("show");
        $("#set_jo_no_form").attr("action", $(this).data("url"));

        $("#set_jo_no_form #jo_no").val($(this).data("jo_no"));
        $("#set_jo_no_form #date").val($(this).data("date"));
        $("#set_jo_no_form #jr_id").val($(this).data("jr_id")).change();

        $('.select2').select2();

        $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
          });
        });

    });

  </script>
    
@endsection