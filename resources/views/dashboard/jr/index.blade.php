<?php

  $table_sessions = [ 
                      Session::get('JR_UPDATE_SUCCESS_SLUG'), 
                      Session::get('JR_SET_JR_NO_SUCCESS_SLUG') 
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'page' => Request::get('page'),
                        'e' => Request::get('e'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Job Request List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.jr.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.jr.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('jr_no', 'PR No.')</th>
            <th>Items</th>
            <th>@sortablelink('department.name', 'Department')</th>
            <th>@sortablelink('division.name', 'Division')</th>
            <th>@sortablelink('created_at', 'Date Encoded')</th>
            <th style="width: 280px">Action</th>
          </tr>
          @foreach($jr_list as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{!! $data->displayJRNoSpan() !!}</td>
              <td id="mid-vert">
                @foreach ($data->jrParameter as $key => $data_jp)
                  {{ $key + 1}}. {{ $data_jp->item_name }}<br>
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
                     id="set_jr_no_btn" 
                     data-jr_no="{{ $data->jr_no }}" 
                     data-date="{{ __dataType::date_parse($data->date, 'm/d/Y') }}" 
                     data-url="{{ route('dashboard.jr.set_jr_no', $data->slug) }}">
                    {{ isset($data->jr_no) ? 'Update JR No.' : 'Set JR No' }}<b></b>
                  </a>
                </div>


                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.jr.show', $data->slug) }}">
                    <i class="fa fa-print"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.jr.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.jr.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>

            </tr>
            @endforeach
          </table>
      </div>

      @if($jr_list->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($jr_list) !!}
        {!! $jr_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('modals')

  {!! __html::modal_delete('jr_delete') !!}

  @if(Session::has('JR_UPDATE_SUCCESS'))
    {!! __html::modal_print(
    'jr_update', '<i class="fa fa-fw fa-check"></i> Updated!', Session::get('JR_UPDATE_SUCCESS'), route('dashboard.jr.show', Session::get('JR_UPDATE_SUCCESS_SLUG'))
    ) !!}
  @endif



  {{-- SET JR NO --}}
  <div class="modal fade" id="set_jr_no_modal" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <i class="fa fa-certificate"></i> &nbsp;Set JR No
            <div class="pull-right">
              <code>Fields with asterisks(*) are required</code>
            </div> 
          </h4>
        </div>
        <div class="modal-body">
          
          <form method="POST" id="set_jr_no_form" autocomplete="off">
            
            @csrf

            <div class="row">

              {!! __form::textbox(
                '6', 'jr_no', 'text', 'JR No.', 'JR No.', '', $errors->has('jr_no'), $errors->first('jr_no'), ''
              ) !!}

              {!! __form::datepicker(
                '6', 'date',  'Date', '', $errors->has('date'), $errors->first('date')
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
  
    @if(Session::has('JR_UPDATE_SUCCESS'))
      $('#jr_update').modal('show');
    @endif

    {!! __js::button_modal_confirm_delete_caller('jr_delete') !!}

    @if(Session::has('JR_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('JR_DELETE_SUCCESS')) !!}
    @endif

    @if(Session::has('JR_SET_JR_NO_SUCCESS'))
      {!! __js::toast(Session::get('JR_SET_JR_NO_SUCCESS')) !!}
    @endif


    {{-- CALL JR SET PO NO MODAL --}}
    $(document).on("click", "#set_jr_no_btn", function () {

        $("#set_jr_no_modal").modal("show");
        $("#set_jr_no_form").attr("action", $(this).data("url"));

        $("#set_jr_no_form #jr_no").val($(this).data("jr_no"));
        $("#set_jr_no_form #date").val($(this).data("date"));

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