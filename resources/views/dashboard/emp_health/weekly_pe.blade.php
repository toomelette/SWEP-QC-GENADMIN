<?php
  

  function manageTabStatus($type){

    $status = '';

    if (Session::has('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS') || Session::has('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS') || Session::has('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS')) {
      if ($type == 'H') {
        $status = 'class="active"';
      }elseif ($type == 'C') {
        $status = 'active';
      }
    }

    return $status;

  }
  


  function newTabStatus($type){
  
    if ($type == 'H') {
      $status = 'class="active"';
    }elseif ($type == 'C') {
      $status = 'active';
    }

    if (Session::has('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS') || Session::has('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS') || Session::has('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS')) {
        $status = '';
    }

    return $status;

  }


  $table_sessions = [ 
                      Session::get('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS_SLUG'),
                      Session::get('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS_SLUG'), 
                    ];


  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];
  

?>

@extends('layouts.admin-master')

@section('content')

<section class="content">

  <div class="box box-solid">
      
    <div class="box-header with-border">
      <h2 class="box-title">Employee Weekly Physical Examination</h2>
      <div class="pull-right">
        <a href="{{ route('dashboard.emp_health.index') }}" class="btn btn-sm btn-default"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
      </div>
    </div>


    <div class="box-body">

      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li {!! newTabStatus('H') !!}><a href="#new" data-toggle="tab">Add New</a></li>
              <li {!! manageTabStatus('H') !!}><a href="#manage" data-toggle="tab">Manage</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane {!! newTabStatus('C') !!}" id="new">
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <code>Fields with asterisks(*) are required</code> 
                  </div>
                  
                  <form method="POST" autocomplete="off" action="{{ route('dashboard.emp_health_weekly_pe.store') }}">

                    <div class="box-body">
                      <div class="col-md-12">
                              
                        @csrf 

                        <input type="hidden" name="emp_health_id" value="{{ $emp_health->emp_health_id }}">

                        {!! __form::datepicker(
                          '4', 'date',  'Date *', old('date'), $errors->has('date'), $errors->first('date')
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'blood_pressure', 'text', 'Blood Pressure', 'Blood Pressure', old('blood_pressure'), $errors->has('blood_pressure'), $errors->first('blood_pressure'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'pulse_rate', 'text', 'Pulse Rate', 'Pulse Rate', old('pulse_rate'), $errors->has('pulse_rate'), $errors->first('pulse_rate'), ''
                        ) !!}

                        <div class="col-md-12"></div>
        
                        {!! __form::textbox(
                          '4', 'temperature', 'text', 'Temperature', 'Temperature', old('temperature'), $errors->has('temperature'), $errors->first('temperature'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'condition', 'text', 'Symptoms / Condition', 'Symptoms / Condition', old('condition'), $errors->has('condition'), $errors->first('condition'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'medication', 'text', 'Medication Given', 'Medication Given', old('medication'), $errors->has('medication'), $errors->first('medication'), ''
                        ) !!}

                        <div class="col-md-12"></div>
        
                        {!! __form::textbox(
                          '12', 'recommendation', 'text', 'Recommendation', 'Recommendation', old('recommendation'), $errors->has('recommendation'), $errors->first('recommendation'), ''
                        ) !!}

                      </div>
                    </div>

                    <div class="box-footer">
                      <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
                    </div>

                  </form>

                </div>
              </div>


              <div class="tab-pane {!! manageTabStatus('C') !!}" id="manage">

                {{-- Table Grid --}}        
                <div class="box-body no-padding">
                  <table class="table table-bordered">
                    <tr>
                      <th>@sortablelink('date', 'Date')</th>
                      <th>@sortablelink('blood_pressure', 'Blood Pressure')</th>
                      <th>@sortablelink('pulse_rate', 'Pulse Rate')</th>
                      <th>@sortablelink('temperature', 'Temperature')</th>
                      <th>@sortablelink('condition', 'Condition')</th>
                      <th>@sortablelink('medication', 'Medication')</th>
                      <th>@sortablelink('recommendation', 'Recommendation')</th>
                      <th>Action</th>
                    </tr>
                    @foreach($emp_health_weekly_pe_list as $data) 
                      <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
                        <td id="mid-vert">{{ optional($data->date)->format('F d, Y') }}</td>
                        <td id="mid-vert">{{ $data->blood_pressure }}</td>
                        <td id="mid-vert">{{ $data->pulse_rate }}</td>
                        <td id="mid-vert">{{ $data->temperature }}</td>
                        <td id="mid-vert">{{ $data->condition }}</td>
                        <td id="mid-vert">{{ $data->medication }}</td>
                        <td id="mid-vert">{{ $data->recommendation }}</td>
                        <td id="mid-vert">
                          <div class="btn-group">
                            @if(in_array('dashboard.emp_health_weekly_pe.update', $global_user_submenus))
                              <a href="#" id="wpe_update_btn" s="{{ $data->slug }}" data-url="{{ route('dashboard.emp_health_weekly_pe.update', $data->slug) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i>
                              </a>
                            @endif
                            @if(in_array('dashboard.emp_health_weekly_pe.destroy', $global_user_submenus))
                              <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.emp_health_weekly_pe.destroy', $data->slug) }}">
                                <i class="fa fa-trash"></i>
                              </a>
                            @endif
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                </div>

                @if($emp_health_weekly_pe_list->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif

                <div class="box-footer">
                  {!! __html::table_counter($emp_health_weekly_pe_list) !!}
                  {!! $emp_health_weekly_pe_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
                </div>


              </div>


            </div>
          </div>
        </div>
      </div>
      
    </div>

  </div>

</section>

@endsection




@section('modals')


  {!! __html::modal_delete('emp_health_weekly_pe_delete') !!}


  {{-- Update Modal --}}
  <div class="modal fade bs-example-modal-lg" id="wpe_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="wpe_update_body">
          <form data-pjax id="wpe_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              @csrf

              <input name="_method" value="PUT" type="hidden">

              {!! __form::datepicker(
                '4', 'e_date',  'Date *', old('e_date'), $errors->has('e_date'), $errors->first('e_date')
              ) !!}

              {!! __form::textbox(
                '4', 'e_blood_pressure', 'text', 'Blood Pressure', 'Blood Pressure', old('e_blood_pressure'), $errors->has('e_blood_pressure'), $errors->first('e_blood_pressure'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_pulse_rate', 'text', 'Pulse Rate', 'Pulse Rate', old('e_pulse_rate'), $errors->has('e_pulse_rate'), $errors->first('e_pulse_rate'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                '4', 'e_temperature', 'text', 'Temperature', 'Temperature', old('e_temperature'), $errors->has('e_temperature'), $errors->first('e_temperature'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_condition', 'text', 'Symptoms / Condition', 'Symptoms / Condition', old('e_condition'), $errors->has('e_condition'), $errors->first('e_condition'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_medication', 'text', 'Medication Given', 'Medication Given', old('e_medication'), $errors->has('e_medication'), $errors->first('e_medication'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                '12', 'e_recommendation', 'text', 'Recommendation', 'Recommendation', old('e_recommendation'), $errors->has('e_recommendation'), $errors->first('e_recommendation'), ''
              ) !!}

            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection 




@section('scripts')

  <script type="text/javascript">
    
    {!! __js::button_modal_confirm_delete_caller('emp_health_weekly_pe_delete') !!}

    @if(Session::has('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_WEEKLY_PE_CREATE_SUCCESS_SLUG')) !!}
    @endif

    @if(Session::has('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_WEEKLY_PE_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_WEEKLY_PE_DELETE_SUCCESS')) !!}
    @endif


    // Update Button Action
    $(document).on("click", "#wpe_update_btn", function () {

      var slug = $(this).attr("s");

      $("#wpe_update").modal("show");
      $("#wpe_update_body #wpe_update_form").attr("action", $(this).data("url"));

      // Date Picker
      $('.datepicker').each(function(){
          $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          });
      });

      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="cwpef-token"]').attr("content")},
          url: "/api/emp_health_weekly_pe/"+slug+"/edit",
          type: "GET",
          dataType: "json",
          success:function(data) {       
            
            $.each(data, function(key, value) {
              $("#wpe_update_form #e_date").val(value.date);
              $("#wpe_update_form #e_blood_pressure").val(value.blood_pressure);
              $("#wpe_update_form #e_pulse_rate").val(value.pulse_rate);
              $("#wpe_update_form #e_temperature").val(value.temperature);
              $("#wpe_update_form #e_condition").val(value.condition);
              $("#wpe_update_form #e_medication").val(value.medication);
              $("#wpe_update_form #e_mode_of_payment").val(value.mode_of_payment);
              $("#wpe_update_form #e_recommendation").val(value.recommendation);
            });

          }
      });

    });

  </script>
    
@endsection