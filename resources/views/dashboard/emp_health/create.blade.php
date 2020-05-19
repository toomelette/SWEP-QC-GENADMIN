<?php
  
  $rows = old('row');

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
              <input type="checkbox" class="minimal sex" name="sex" value="M" {{ old('sex') == "M" ? 'checked' : '' }}>
              Male
            </label>
            &nbsp;
            <label>
              <input type="checkbox" class="minimal sex" name="sex" value="F" {{ old('sex') == "F" ? 'checked' : '' }}>
              Female
            </label><br>
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
          '4', 'bloodtype', 'text', 'Blood Type', 'Blood Type', old('bloodtype'), $errors->has('bloodtype'), $errors->first('bloodtype'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'family_doctor', 'text', 'Family Doctor, if any', 'Family Doctor', old('family_doctor'), $errors->has('family_doctor'), $errors->first('family_doctor'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'contact_person', 'text', 'Contact Person and Mobile No., in case of emergency *', 'Contact Person', old('contact_person'), $errors->has('contact_person'), $errors->first('contact_person'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '12', 'travel_history', 'text', 'Cities in the Philippines you have worked, visited, transited in the past 14 days / ECQ Period', 'Cities Visited', old('travel_history'), $errors->has('travel_history'), $errors->first('travel_history'), ''
        ) !!}



        <div class="col-md-12" style="margin-top:10px;">
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">

              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>Have you been sick in the past 30 days? *</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_sick_history" 
                           name="is_has_sick_history" 
                           value="true" {{ old('is_has_sick_history') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_sick_history" 
                           name="is_has_sick_history" 
                           value="false" {{ old('is_has_sick_history') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
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
                           class="minimal is_has_fever_history" 
                           name="is_has_fever_history" 
                           value="true" {{ old('is_has_fever_history') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_fever_history" 
                           name="is_has_fever_history" 
                           value="false" {{ old('is_has_fever_history') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
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
          <h3>Medical History</h3>
          <div class="box box-solid" style="border:solid 1px;">
      
            <div class="box-header with-border">
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

                      <input type="hidden" 
                             name="row[{{ $i }}][mc_id]" 
                             value="{{ $global_medical_history_all[$i]['id'] }}">

                      <td id="mid-vert">

                        <label>
                          <input type="checkbox" 
                                 class="minimal" 
                                 name="row[{{ $i }}][is_checked]" 
                                 value="true" {{ !empty($rows[$i]['is_checked']) ? 'checked' : '' }}>
                        </label>&nbsp;
                        <small class="text-danger">{{ $errors->first('row.'. $i .'.mc_id') }}</small>

                        {{ $global_medical_history_all[$i]['name'] }}
                      
                      </td>

                      <td id="mid-vert">
                        <div class="form-group">
                          <input type="text" 
                                 name="row[{{ $i }}][medication]" 
                                 class="form-control" 
                                 value="{{ !empty($rows) ? $rows[$i]['medication'] : '' }}">
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



        <div class="col-md-6">
          <h3>Social History / Current</h3>
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>1. Do you SMOKE / VAPE? *</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_smoking" 
                           name="is_smoking" 
                           value="true" {{ old('is_smoking') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_smoking" 
                           name="is_smoking" 
                           value="false" {{ old('is_smoking') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_smoking') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_smoking_packs_per_day', 'text', 'if YES, number of PACKS PER DAY', 'PACKS PER DAY', old('is_smoking_packs_per_day'), $errors->has('is_smoking_packs_per_day'), $errors->first('is_smoking_packs_per_day'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>2. Do you Drink Alcohol?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_drinking_alcohol" 
                           name="is_drinking_alcohol" 
                           value="true" {{ old('is_drinking_alcohol') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_drinking_alcohol" 
                           name="is_drinking_alcohol" 
                           value="false" {{ old('is_drinking_alcohol') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_drinking_alcohol') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_drinking_alcohol_how_often', 'text', 'if YES, how often?', 'How often', old('is_drinking_alcohol_how_often'), $errors->has('is_drinking_alcohol_how_often'), $errors->first('is_drinking_alcohol_how_often'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>3. Do you take Prohibited DRUGS?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_drugs" 
                           name="is_taking_drugs" 
                           value="true" {{ old('is_taking_drugs') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_drugs" 
                           name="is_taking_drugs" 
                           value="false" {{ old('is_taking_drugs') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_taking_drugs') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_taking_drugs_specific', 'text', 'if YES, specify', 'Specify drugs', old('is_taking_drugs_specific'), $errors->has('is_taking_drugs_specific'), $errors->first('is_taking_drugs_specific'), ''
              ) !!}

                
            </div>
          </div>
        </div>



        <div class="col-md-6">
          <h3>Health Routines</h3>
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>1. Do you take VITAMINS?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_vitamins" 
                           name="is_taking_vitamins" 
                           value="true" {{ old('is_taking_vitamins') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_vitamins" 
                           name="is_taking_vitamins" 
                           value="false" {{ old('is_taking_vitamins') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_taking_vitamins') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_taking_vitamins_specific', 'text', 'if YES, specify', 'Specific Vitamins', old('is_taking_vitamins_specific'), $errors->has('is_taking_vitamins_specific'), $errors->first('is_taking_vitamins_specific'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>2. Do you wear EYEGLASSES?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_wearing_eyeglass" 
                           name="is_wearing_eyeglass" 
                           value="true" {{ old('is_wearing_eyeglass') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_wearing_eyeglass" 
                           name="is_wearing_eyeglass" 
                           value="false" {{ old('is_wearing_eyeglass') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_wearing_eyeglass') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_wearing_eyeglass_va', 'text', 'if YES, specify visual acuity', 'Visual acuity', old('is_wearing_eyeglass_va'), $errors->has('is_wearing_eyeglass_va'), $errors->first('is_wearing_eyeglass_va'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>3. Do you do Physical Conditioning (Exercise)</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_exercising" 
                           name="is_exercising" 
                           value="true" {{ old('is_exercising') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_exercising" 
                           name="is_exercising" 
                           value="false" {{ old('is_exercising') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_exercising') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_exercising_how_often', 'text', 'if YES, How often', 'How often', old('is_exercising_how_often'), $errors->has('is_exercising_how_often'), $errors->first('is_exercising_how_often'), ''
              ) !!}

                
            </div>
          </div>
        </div>



        <div class="col-md-12">
          <h3>Current Medical Conditions</h3>
          <div class="box box-solid" style="border:solid 1px;">
            <div class="box-body">

              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>Are you currently being treated for any underlying medical conditions? (ie. Diabetes, Hypertension, Cancer, COPD, etc.)</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_treating_medical_condition" 
                           name="is_treating_medical_condition" 
                           value="true" {{ old('is_treating_medical_condition') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_treating_medical_condition" 
                           name="is_treating_medical_condition" 
                           value="false" {{ old('is_treating_medical_condition') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_treating_medical_condition') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_treating_medical_condition_medicines', 'text', 'if YES, specify', 'Name, dose and frequency of any medicines', old('is_treating_medical_condition_medicines'), $errors->has('is_treating_medical_condition_medicines'), $errors->first('is_treating_medical_condition_medicines'), ''
              ) !!}



              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>Do you have any chronic illness or injuries that must be pointed out?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_chronic_illness" 
                           name="is_has_chronic_illness" 
                           value="true" {{ old('is_has_chronic_illness') == "true" ? 'checked' : '' }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_chronic_illness" 
                           name="is_has_chronic_illness" 
                           value="false" {{ old('is_has_chronic_illness') == "false" ? 'checked' : '' }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_has_chronic_illness') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_chronic_illness_details', 'text', 'if YES, specify', 'Give details of illness or injuries and their treatment details', old('is_has_chronic_illness_details'), $errors->has('is_has_chronic_illness_details'), $errors->first('is_has_chronic_illness_details'), ''
              ) !!}
                
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

    function checkboxTick(c){
      $(c).on('ifChecked', function(event){
        $(c).not(this).iCheck('uncheck');
      });
    }

    checkboxTick('.sex');
    checkboxTick('.is_has_sick_history');
    checkboxTick('.is_has_fever_history');
    checkboxTick('.is_smoking');
    checkboxTick('.is_drinking_alcohol');
    checkboxTick('.is_taking_drugs');
    checkboxTick('.is_taking_vitamins');
    checkboxTick('.is_wearing_eyeglass');
    checkboxTick('.is_exercising');
    checkboxTick('.is_treating_medical_condition');
    checkboxTick('.is_has_chronic_illness');

  </script>
    
@endsection