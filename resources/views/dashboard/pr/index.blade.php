<?php

  $table_sessions = [ 
                      Session::get('PR_UPDATE_SUCCESS_SLUG'), 
                      Session::get('PR_SET_PR_NO_SUCCESS_SLUG')
                    ];

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
      <h1>Purchase Request List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.pr.index') }}">

    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      {!! __form::select_dynamic_for_filter(
        '4', 'dept', 'Department', old('dept'), $global_departments_all, 'dept_id', 'name', 'submit_pr_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '4', 'div', 'Division', old('div'), $global_divisions_all, 'div_id', 'name', 'submit_pr_filter', 'select2', 'style="width:100%;"'
      ) !!}

    {!! __html::filter_close('submit_pr_filter') !!}

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.pr.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('pr_no', 'PR No.')</th>
            <th>Items</th>
            <th>@sortablelink('department.name', 'Department')</th>
            <th>@sortablelink('division.name', 'Division')</th>
            <th>@sortablelink('created_at', 'Date Encoded')</th>
            <th style="width: 280px">Action</th>
          </tr>
          @foreach($pr_list as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{!! $data->displayPRNoSpan() !!}</td>
              <td id="mid-vert">
                @foreach ($data->prParameter as $key => $data_pp)
                  {{ $key + 1}}. {{ $data_pp->item_name }}<br>
                @endforeach
              </td>
              <td id="mid-vert">{{ optional($data->department)->acronym }}</td>
              <td id="mid-vert">{{ optional($data->division)->name }}</td>
              <td id="mid-vert">{{ __dataType::date_parse($data->created_at, 'm/d/Y') }}</td>
              
              <td id="mid-vert">

                <div class="btn-group">
                  <a type="button" 
                     class="btn btn-default" 
                     href="#" 
                     id="set_pr_no_btn" 
                     data-pr_no="{{ $data->pr_no }}" 
                     data-pr_no_date="{{ __dataType::date_parse($data->pr_no_date, 'm/d/Y') }}" 
                     data-sai_no="{{ $data->sai_no }}" 
                     data-sai_no_date="{{ __dataType::date_parse($data->sai_no_date, 'm/d/Y') }}" 
                     data-url="{{ route('dashboard.pr.set_pr_no', $data->slug) }}">
                    {{ isset($data->pr_no) ? 'Update PR No.' : 'Set PR No' }}<b></b>
                  </a>
                </div>

                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.pr.show', $data->slug) }}">
                    <i class="fa fa-print"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.pr.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.pr.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>

              </td>

            </tr>
            @endforeach
          </table>
      </div>

      @if($pr_list->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($pr_list) !!}
        {!! $pr_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('pr_delete') !!}

  @if(Session::has('PR_UPDATE_SUCCESS'))
    {!! __html::modal_print(
    'pr_update', '<i class="fa fa-fw fa-check"></i> Updated!', Session::get('PR_UPDATE_SUCCESS'), route('dashboard.pr.show', Session::get('PR_UPDATE_SUCCESS_SLUG'))
    ) !!}
  @endif



  {{-- SET PR NO --}}
  <div class="modal fade" id="set_pr_no_modal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <i class="fa fa-certificate"></i> &nbsp;Set PR No
            <div class="pull-right">
              <code>Fields with asterisks(*) are required</code>
            </div> 
          </h4>
        </div>
        <div class="modal-body">
          
          <form method="POST" id="set_pr_no_form" autocomplete="off">
            
            @csrf

            <div class="row">

              {!! __form::textbox(
                '6', 'pr_no', 'text', 'PR No.', 'PR No.', '', $errors->has('pr_no'), $errors->first('pr_no'), ''
              ) !!}

              {!! __form::datepicker(
                '6', 'pr_no_date',  'PR No. Date', '', $errors->has('pr_no_date'), $errors->first('pr_no_date')
              ) !!}

              {!! __form::textbox(
                '6', 'sai_no', 'text', 'SAI No.', 'SAI No.', '', $errors->has('sai_no'), $errors->first('sai_no'), ''
              ) !!}

              {!! __form::datepicker(
                '6', 'sai_no_date',  'SAI No. Date', '', $errors->has('sai_no_date'), $errors->first('sai_no_date')
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
  
    @if(Session::has('PR_UPDATE_SUCCESS'))
      $('#pr_update').modal('show');
    @endif

    {!! __js::button_modal_confirm_delete_caller('pr_delete') !!}

    @if(Session::has('PR_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('PR_DELETE_SUCCESS')) !!}
    @endif

    @if(Session::has('PR_SET_PR_NO_SUCCESS'))
      {!! __js::toast(Session::get('PR_SET_PR_NO_SUCCESS')) !!}
    @endif


    {{-- CALL PR SET PO NO MODAL --}}
    $(document).on("click", "#set_pr_no_btn", function () {

        $("#set_pr_no_modal").modal("show");
        $("#set_pr_no_form").attr("action", $(this).data("url"));

        $("#set_pr_no_form #pr_no").val($(this).data("pr_no"));
        $("#set_pr_no_form #pr_no_date").val($(this).data("pr_no_date"));
        $("#set_pr_no_form #sai_no").val($(this).data("sai_no"));
        $("#set_pr_no_form #sai_no_date").val($(this).data("sai_no_date"));

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