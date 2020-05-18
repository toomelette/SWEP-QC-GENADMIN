<?php
  
  $civil_status = [
    'Single' => '1',
    'Married' => '2',
    'Widowed' => '3',
    'Seperated' => '4',
    'Others' => '5',
  ];

?>

@extends('layouts.admin-master')

@section('content')

<section class="content">
            
  <div class="box box-solid">
      
    <div class="box-header with-border">
      <h2 class="box-title">New Health Record</h2>
      <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
      </div> 
    </div>
    
    <form method="POST" autocomplete="off" action="{{ route('dashboard.emp_health.store') }}">

      <div class="box-body">
                
        @csrf    

        {!! __form::textbox(
          '4', 'emp_no', 'text', 'Employee No. *', 'Employee No.', old('emp_no'), $errors->has('emp_no'), $errors->first('emp_no'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname'), $errors->has('fullname'), $errors->first('fullname'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'department_text', 'text', 'Department / Division / Section *', 'Department / Division / Section', old('department_text'), $errors->has('department_text'), $errors->first('department_text'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'contact_no', 'text', 'Contact No / Email', 'Contact No / Email', old('contact_no'), $errors->has('contact_no'), $errors->first('contact_no'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::datepicker(
          '4', 'birthday',  'Birthday *', old('birthday'), $errors->has('birthday'), $errors->first('birthday')
        ) !!}

        <div class="form-group col-md-4">
          <div class="checkbox">
            <span>Sex *</span><br>
            <label>
              <input type="checkbox" class="minimal file_ext" name="sex" value="M" {{ old('sex') == "M" ? 'checked' : '' }}>
              Male
            </label>
            &nbsp;
            <label>
              <input type="checkbox" class="minimal file_ext" name="sex" value="F" {{ old('sex') == "F" ? 'checked' : '' }}>
              Female
            </label>
            <small class="text-danger">{{ $errors->first('sex') }}</small>
          </div>
        </div>

        {!! __form::select_static(
          '4', 'civil_status', 'Civil Status *', old('civil_status'), $civil_status, $errors->has('civil_status'), $errors->first('civil_status'), '', ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'height', 'text', 'Height', 'Height', old('height'), $errors->has('height'), $errors->first('height'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'weight', 'text', 'Weight', 'Weight', old('weight'), $errors->has('weight'), $errors->first('weight'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'philhealth_no', 'text', 'PHILHEALTH', 'PHILHEALTH', old('philhealth_no'), $errors->has('philhealth_no'), $errors->first('philhealth_no'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'blood_type', 'text', 'Blood Type', 'Blood Type', old('blood_type'), $errors->has('blood_type'), $errors->first('blood_type'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'family_doctor', 'text', 'Family Doctor, if any', 'Family Doctor', old('family_doctor'), $errors->has('family_doctor'), $errors->first('family_doctor'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'contact_person', 'text', 'Contact Person and Mobile No., in case of emergency', 'Contact Person', old('contact_person'), $errors->has('contact_person'), $errors->first('contact_person'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '12', 'travel_history', 'text', 'Cities in the Philippines you have worked, visited, transited in the past 14 days / ECQ Period', 'Cities Visited', old('travel_history'), $errors->has('travel_history'), $errors->first('travel_history'), ''
        ) !!}


        <div class="col-md-12">
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">

              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>Have you been sick in the past 30 days? *</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal file_ext" 
                           name="is_has_sick_history" 
                           value="true" {{ old('true') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal file_ext" 
                           name="is_has_sick_history" 
                           value="false" {{ old('false') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label>
                  <small class="text-danger">{{ $errors->first('is_has_sick_history') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_sick_history_condition', 'text', 'if (Yes) pls. describe condition', 'Condition', old('is_has_sick_history_condition'), $errors->has('is_has_sick_history_condition'), $errors->first('is_has_sick_history_condition'), ''
              ) !!}

              {!! __form::textbox(
                '12', 'is_has_sick_history_hos_visited', 'text', 'Hospital Visited if any?', 'Hospital Visited', old('is_has_sick_history_hos_visited'), $errors->has('is_has_sick_history_hos_visited'), $errors->first('is_has_sick_history_hos_visited'), ''
              ) !!}
                
            </div>
          </div>
        </div>


        <div class="col-md-12">
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">

              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>In the last 14 days, did you have any of the following: fever, colds, cough, sore throat or difficulty in breathing, diarrhea? *</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal file_ext" 
                           name="is_has_fever_history" 
                           value="true" {{ old('true') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal file_ext" 
                           name="is_has_fever_history" 
                           value="false" {{ old('false') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label>
                  <small class="text-danger">{{ $errors->first('is_has_fever_history') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_fever_history_condition', 'text', 'if (Yes) pls. describe condition', 'Condition', old('is_has_fever_history_condition'), $errors->has('is_has_fever_history_condition'), $errors->first('is_has_fever_history_condition'), ''
              ) !!}
                
            </div>
          </div>
        </div>


        <div class="col-md-12">

          <div class="box box-solid" style="border:solid 1px;">
      
          <div class="box-header with-border">
            <h2 class="box-title"><b>Medical History</b></h2>
          </div>

          <div class="box-body">

            <table class="table table-bordered">
                
              <thead>
                <td style="width:400px;">Medical Condition</td>
                <td>Medication</td>
              </thead>

              <tbody>

                @for ($i = 0; $i < count($global_medical_history_all); $i++)

                  <tr>

                    <td id="mid-vert">

                      <label>
                        <input type="checkbox" 
                               class="minimal file_ext" 
                               name="row[{{ $i }}][mc_id]" 
                               value="false">
                      </label>&nbsp;
                      <small class="text-danger">{{ $errors->first('row.'. $i .'.mc_id') }}</small>

                      {{ $global_medical_history_all[$i]['name'] }}
                    
                    </td>

                    <td id="mid-vert">
                      <div class="form-group">
                        <input type="text" name="row[{{ $i }}][medication]" class="form-control" value="">
                        <small class="text-danger">{{ $errors->first('row.'. $i .'.medication') }}</small>
                      </div>
                    </td>

                  </tr>

                @endfor

              </tbody>

            </table>
              
          </div>
          </div>
        </div>


      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
      </div>

    </form>

  </div>

</section>

@endsection




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('EMP_HEALTH_SUCCESS'))
      {!! __js::toast(Session::get('EMP_HEALTH_SUCCESS')) !!}
    @endif

  </script>
    
@endsection