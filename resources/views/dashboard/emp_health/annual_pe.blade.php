<?php
  

  function manageTabStatus($type){

    $status = '';

    if (Session::has('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS') || Session::has('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS') || Session::has('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS')) {
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

    if (Session::has('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS') || Session::has('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS') || Session::has('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS')) {
        $status = '';
    }

    return $status;

  }


  $table_sessions = [ 
                      Session::get('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS_SLUG'),
                      Session::get('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS_SLUG'), 
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
      <h2 class="box-title">Employee Annual Physical Examination</h2>
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
                  
                  <form method="POST" autocomplete="off" action="{{ route('dashboard.emp_health_annual_pe.store') }}">

                    <div class="box-body">
                      <div class="col-md-12">
                              
                        @csrf 

                        <input type="hidden" name="emp_health_id" value="{{ $emp_health->emp_health_id }}">

                        {!! __form::datepicker(
                          '4', 'date',  'Date *', old('date'), $errors->has('date'), $errors->first('date')
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'pe', 'text', 'PE', 'PE', old('pe'), $errors->has('pe'), $errors->first('pe'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'cbc', 'text', 'CBC', 'CBC', old('cbc'), $errors->has('cbc'), $errors->first('cbc'), ''
                        ) !!}

                        <div class="col-md-12"></div>
        
                        {!! __form::textbox(
                          '4', 'chem', 'text', 'CHEM', 'CHEM', old('chem'), $errors->has('chem'), $errors->first('chem'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'urinalysis', 'text', 'Urinalysis', 'Urinalysis', old('urinalysis'), $errors->has('urinalysis'), $errors->first('urinalysis'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'xray', 'text', 'XRAY', 'XRAY', old('xray'), $errors->has('xray'), $errors->first('xray'), ''
                        ) !!}

                        <div class="col-md-12"></div>
        
                        {!! __form::textbox(
                          '4', 'ecg', 'text', 'ECG', 'ECG', old('ecg'), $errors->has('ecg'), $errors->first('ecg'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'ultrasound', 'text', 'Ultrasound', 'Ultrasound', old('ultrasound'), $errors->has('ultrasound'), $errors->first('ultrasound'), ''
                        ) !!}
        
                        {!! __form::textbox(
                          '4', 'drug_test', 'text', 'Drug Test', 'Drug Test', old('drug_test'), $errors->has('drug_test'), $errors->first('drug_test'), ''
                        ) !!}

                        <div class="col-md-12"></div>
        
                        {!! __form::textbox(
                          '12', 'company_cond', 'text', 'Company Conducted', 'Company Conducted', old('company_cond'), $errors->has('company_cond'), $errors->first('company_cond'), ''
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
                      <th>@sortablelink('pe', 'PE')</th>
                      <th>@sortablelink('cbc', 'Pulse Rate')</th>
                      <th>@sortablelink('chem', 'CHEM')</th>
                      <th>@sortablelink('urinalysis', 'Urinalysis')</th>
                      <th>@sortablelink('xray', 'XRAY')</th>
                      <th>@sortablelink('ecg', 'ECG')</th>
                      <th>@sortablelink('ultrasound', 'Ultrasound')</th>
                      <th>@sortablelink('drug_test', 'Drug Test')</th>
                      <th>@sortablelink('company_cond', 'Company Conducted')</th>
                      <th>Action</th>
                    </tr>
                    @foreach($emp_health_annual_pe_list as $data) 
                      <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
                        <td id="mid-vert">{{ $data->date }}</td>
                        <td id="mid-vert">{{ $data->pe }}</td>
                        <td id="mid-vert">{{ $data->cbc }}</td>
                        <td id="mid-vert">{{ $data->chem }}</td>
                        <td id="mid-vert">{{ $data->urinalysis }}</td>
                        <td id="mid-vert">{{ $data->xray }}</td>
                        <td id="mid-vert">{{ $data->ecg }}</td>
                        <td id="mid-vert">{{ $data->ultrasound }}</td>
                        <td id="mid-vert">{{ $data->drug_test }}</td>
                        <td id="mid-vert">{{ $data->company_cond }}</td>
                        <td id="mid-vert">
                          <div class="btn-group">
                            @if(in_array('dashboard.emp_health_annual_pe.update', $global_user_submenus))
                              <a href="#" id="ape_update_btn" s="{{ $data->slug }}" data-url="{{ route('dashboard.emp_health_annual_pe.update', $data->slug) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i>
                              </a>
                            @endif
                            @if(in_array('dashboard.emp_health_annual_pe.destroy', $global_user_submenus))
                              <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.emp_health_annual_pe.destroy', $data->slug) }}">
                                <i class="fa fa-trash"></i>
                              </a>
                            @endif
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                </div>

                @if($emp_health_annual_pe_list->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif

                <div class="box-footer">
                  {!! __html::table_counter($emp_health_annual_pe_list) !!}
                  {!! $emp_health_annual_pe_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
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


  {!! __html::modal_delete('emp_health_annual_pe_delete') !!}


  {{-- Update Modal --}}
  <div class="modal fade bs-example-modal-lg" id="ape_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="ape_update_body">
          <form data-pjax id="ape_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              @csrf

              <input name="_method" value="PUT" type="hidden">

              {!! __form::datepicker(
                '4', 'e_date',  'Date *', old('e_date'), $errors->has('e_date'), $errors->first('e_date')
              ) !!}
        
              {!! __form::textbox(
                '4', 'e_pe', 'text', 'PE', 'PE', old('e_pe'), $errors->has('e_pe'), $errors->first('e_pe'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_cbc', 'text', 'CBC', 'CBC', old('e_cbc'), $errors->has('e_cbc'), $errors->first('e_cbc'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                '4', 'e_chem', 'text', 'CHEM', 'CHEM', old('e_chem'), $errors->has('e_chem'), $errors->first('e_chem'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_urinalysis', 'text', 'Urinalysis', 'Urinalysis', old('e_urinalysis'), $errors->has('e_urinalysis'), $errors->first('e_urinalysis'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_xray', 'text', 'XRAY', 'XRAY', old('e_xray'), $errors->has('e_xray'), $errors->first('e_xray'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                '4', 'e_ecg', 'text', 'ECG', 'ECG', old('e_ecg'), $errors->has('e_ecg'), $errors->first('e_ecg'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_ultrasound', 'text', 'Ultrasound', 'Ultrasound', old('e_ultrasound'), $errors->has('e_ultrasound'), $errors->first('e_ultrasound'), ''
              ) !!}

              {!! __form::textbox(
                '4', 'e_drug_test', 'text', 'Drug Test', 'Drug Test', old('e_drug_test'), $errors->has('e_drug_test'), $errors->first('e_drug_test'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! __form::textbox(
                '12', 'e_company_cond', 'text', 'Company Conducted', 'Company Conducted', old('e_company_cond'), $errors->has('e_company_cond'), $errors->first('e_company_cond'), ''
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
    
    {!! __js::button_modal_confirm_delete_caller('emp_health_annual_pe_delete') !!}

    @if(Session::has('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_ANNUAL_PE_CREATE_SUCCESS_SLUG')) !!}
    @endif

    @if(Session::has('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_ANNUAL_PE_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_ANNUAL_PE_DELETE_SUCCESS')) !!}
    @endif


    // Update Button Action
    $(document).on("click", "#ape_update_btn", function () {

      var slug = $(this).attr("s");

      $("#ape_update").modal("show");
      $("#ape_update_body #ape_update_form").attr("action", $(this).data("url"));

      // Date Picker
      $('.datepicker').each(function(){
          $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          });
      });

      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
          url: "/api/emp_health_annual_pe/"+slug+"/edit",
          type: "GET",
          dataType: "json",
          success:function(data) {       
            
            $.each(data, function(key, value) {
              $("#ape_update_form #e_date").val(value.date);
              $("#ape_update_form #e_pe").val(value.pe);
              $("#ape_update_form #e_cbc").val(value.cbc);
              $("#ape_update_form #e_chem").val(value.chem);
              $("#ape_update_form #e_urinalysis").val(value.urinalysis);
              $("#ape_update_form #e_xray").val(value.xray);
              $("#ape_update_form #e_ecg").val(value.ecg);
              $("#ape_update_form #e_ultrasound").val(value.ultrasound);
              $("#ape_update_form #e_drug_test").val(value.drug_test);
              $("#ape_update_form #e_company_cond").val(value.company_cond);
            });

          }
      });

    });

  </script>
    
@endsection