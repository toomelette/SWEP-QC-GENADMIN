
<?php
  

  $old_mh_list = old('row');


  $civil_status = [
    'Single' => '1',
    'Married' => '2',
    'Widowed' => '3',
    'Seperated' => '4',
    'Others' => '5',
  ];


  function checkboxVal($old_value, $bool_string, $value, $bool){

    $txt = '';

    if (isset($old_value)) {
      if ($old_value == $bool_string) {
        $txt = 'checked';
      }
    }else{
      if ($value == $bool) {
        $txt = 'checked';
      }
    }

    return $txt;

  }



  function mhCheckboxVal($emp_health, $old_value, $id){

    $mh_list = $emp_health->empHealthMedHistory;
    $txt = '';

    if (isset($old_value[$id]['is_checked'])) {
      if ($old_value[$id]['is_checked'] == 'true') {
        $txt = 'checked';
      }
    }elseif(isset($mh_list[$id]->is_checked)){
      if ($mh_list[$id]->is_checked == true) {
        $txt = 'checked';
      }
    }

    return $txt;

  }



  function mhMedicationVal($emp_health, $old_value, $id){

    $mh_list = $emp_health->empHealthMedHistory;
    $value = '';

    if (isset($old_value[$id]['medication'])) {
      $value = $old_value[$id]['medication'];
    }elseif(isset($mh_list[$id]->medication)){
      $value = $mh_list[$id]->medication;
    }

    return $value;

  }


?>

@extends('layouts.admin-master')

@section('content')

<section class="content">
  
  <div class="box box-solid">
      
    <div class="box-header with-border">
      <h2 class="box-title">Edit Health Record</h2>
      <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.emp_health.index']) !!}
      </div> 
    </div>
    
    <form method="POST" action="{{ route('dashboard.emp_health.update', $emp_health->slug) }}">

      <div class="box-body">

        <input name="_method" value="PUT" type="hidden">
                
        @csrf    

        {!! __form::textbox(
          '4', 'emp_no', 'text', 'Employee No. *', 'Employee No.', old('emp_no') ? old('emp_no') : $emp_health->emp_no, $errors->has('emp_no'), $errors->first('emp_no'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname') ? old('fullname') : $emp_health->fullname, $errors->has('fullname'), $errors->first('fullname'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'department_text', 'text', 'Department / Division / Section *', 'Department / Division / Section', old('department_text') ? old('department_text') : $emp_health->department_text, $errors->has('department_text'), $errors->first('department_text'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'position', 'text', 'Position *', 'Position', old('position') ? old('position') : $emp_health->position, $errors->has('position'), $errors->first('position'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'contact_no', 'text', 'Contact No / Email', 'Contact No / Email', old('contact_no') ? old('contact_no') : $emp_health->contact_no, $errors->has('contact_no'), $errors->first('contact_no'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'address', 'text', 'Address *', 'Address', old('address') ? old('address') : $emp_health->address, $errors->has('address'), $errors->first('address'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::datepicker(
          '4', 'birthday',  'Birthday *', old('birthday') ? old('birthday') : $emp_health->birthday, $errors->has('birthday'), $errors->first('birthday')
        ) !!}

        <div class="form-group col-md-4">
          <div class="checkbox">
            <span>Sex *</span><br>
            <label>
              <input type="checkbox" class="minimal sex" name="sex" value="M" {{ checkboxVal(old('sex'), 'M', $emp_health->sex, 'M') }}>
              Male
            </label>
            &nbsp;
            <label>
              <input type="checkbox" class="minimal sex" name="sex" value="F" {{ checkboxVal(old('sex'), 'F', $emp_health->sex, 'F') }}>
              Female
            </label><br>
            <small class="text-danger">{{ $errors->first('sex') }}</small>
          </div>
        </div>

        {!! __form::select_static(
          '4', 'civil_status', 'Civil Status *', old('civil_status') ? old('civil_status') : $emp_health->civil_status , $civil_status, $errors->has('civil_status'), $errors->first('civil_status'), '', ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'height', 'text', 'Height', 'Height', old('height') ? old('height') : $emp_health->height, $errors->has('height'), $errors->first('height'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'weight', 'text', 'Weight', 'Weight', old('weight') ? old('weight') : $emp_health->weight, $errors->has('weight'), $errors->first('weight'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'philhealth_no', 'text', 'PHILHEALTH', 'PHILHEALTH', old('philhealth_no') ? old('philhealth_no') : $emp_health->philhealth_no, $errors->has('philhealth_no'), $errors->first('philhealth_no'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '4', 'bloodtype', 'text', 'Blood Type', 'Blood Type', old('bloodtype') ? old('bloodtype') : $emp_health->bloodtype, $errors->has('bloodtype'), $errors->first('bloodtype'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'family_doctor', 'text', 'Family Doctor, if any', 'Family Doctor', old('family_doctor') ? old('family_doctor') : $emp_health->family_doctor, $errors->has('family_doctor'), $errors->first('family_doctor'), ''
        ) !!}

        {!! __form::textbox(
          '4', 'contact_person', 'text', 'Contact Person and Mobile No., in case of emergency', 'Contact Person', old('contact_person') ? old('contact_person') : $emp_health->contact_person, $errors->has('contact_person'), $errors->first('contact_person'), ''
        ) !!}

        <div class="col-md-12"></div>

        {!! __form::textbox(
          '12', 'travel_history', 'text', 'Cities in the Philippines you have worked, visited, transited in the past 14 days / ECQ Period', 'Cities Visited', old('travel_history') ? old('travel_history') : $emp_health->travel_history, $errors->has('travel_history'), $errors->first('travel_history'), ''
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
                           value="true" {{ checkboxVal(old('is_has_sick_history'), 'true', $emp_health->is_has_sick_history, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_sick_history" 
                           name="is_has_sick_history" 
                           value="false" {{ checkboxVal(old('is_has_sick_history'), 'false', $emp_health->is_has_sick_history, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_has_sick_history') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_sick_history_condition', 'text', 'if (Yes) pls. describe condition', 'Condition', old('is_has_sick_history_condition') ? old('is_has_sick_history_condition') : $emp_health->is_has_sick_history_condition, $errors->has('is_has_sick_history_condition'), $errors->first('is_has_sick_history_condition'), ''
              ) !!}

              {!! __form::textbox(
                '12', 'is_has_sick_history_hos_visited', 'text', 'Hospital Visited if any?', 'Hospital Visited', old('is_has_sick_history_hos_visited') ? old('is_has_sick_history_hos_visited') : $emp_health->is_has_sick_history_hos_visited, $errors->has('is_has_sick_history_hos_visited'), $errors->first('is_has_sick_history_hos_visited'), ''
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
                           value="true" {{ checkboxVal(old('is_has_fever_history'), 'true', $emp_health->is_has_fever_history, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_fever_history" 
                           name="is_has_fever_history" 
                           value="false" {{ checkboxVal(old('is_has_fever_history'), 'false', $emp_health->is_has_fever_history, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_has_fever_history') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_fever_history_condition', 'text', 'if (Yes) pls. describe condition', 'Condition', old('is_has_fever_history_condition') ? old('is_has_fever_history_condition') : $emp_health->is_has_fever_history_condition, $errors->has('is_has_fever_history_condition'), $errors->first('is_has_fever_history_condition'), ''
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
                                 value="true" {!! mhCheckboxVal($emp_health, $old_mh_list, $i) !!}>
                        </label>&nbsp;

                        <small class="text-danger">{{ $errors->first('row.'. $i .'.mc_id') }}</small>

                        {{ $global_medical_history_all[$i]['name'] }}
                      
                      </td>

                      <td id="mid-vert">
                        <div class="form-group">
                          <input type="text" 
                                 name="row[{{ $i }}][medication]" 
                                 class="form-control" 
                                 value="{{ mhMedicationVal($emp_health, $old_mh_list, $i) }}">
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
                           value="true" {{ checkboxVal(old('is_smoking'), 'true', $emp_health->is_smoking, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_smoking" 
                           name="is_smoking" 
                           value="false" {{ checkboxVal(old('is_smoking'), 'false', $emp_health->is_smoking, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_smoking') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_smoking_packs_per_day', 'text', 'if YES, number of PACKS PER DAY', 'PACKS PER DAY', old('is_smoking_packs_per_day') ? old('is_smoking_packs_per_day') : $emp_health->is_smoking_packs_per_day, $errors->has('is_smoking_packs_per_day'), $errors->first('is_smoking_packs_per_day'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>2. Do you Drink Alcohol?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_drinking_alcohol" 
                           name="is_drinking_alcohol" 
                           value="true" {{ checkboxVal(old('is_drinking_alcohol'), 'true', $emp_health->is_drinking_alcohol, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_drinking_alcohol" 
                           name="is_drinking_alcohol" 
                           value="false" {{ checkboxVal(old('is_drinking_alcohol'), 'false', $emp_health->is_drinking_alcohol, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_drinking_alcohol') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_drinking_alcohol_how_often', 'text', 'if YES, how often?', 'How often', old('is_drinking_alcohol_how_often') ? old('is_drinking_alcohol_how_often') : $emp_health->is_drinking_alcohol_how_often, $errors->has('is_drinking_alcohol_how_often'), $errors->first('is_drinking_alcohol_how_often'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>3. Do you take Prohibited DRUGS?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_drugs" 
                           name="is_taking_drugs" 
                           value="true" {{ checkboxVal(old('is_taking_drugs'), 'true', $emp_health->is_taking_drugs, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_drugs" 
                           name="is_taking_drugs" 
                           value="false" {{ checkboxVal(old('is_taking_drugs'), 'false', $emp_health->is_taking_drugs, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_taking_drugs') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_taking_drugs_specific', 'text', 'if YES, specify', 'Specify drugs', old('is_taking_drugs_specific') ? old('is_taking_drugs_specific') : $emp_health->is_taking_drugs_specific, $errors->has('is_taking_drugs_specific'), $errors->first('is_taking_drugs_specific'), ''
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
                           value="true" {{ checkboxVal(old('is_taking_vitamins'), 'true', $emp_health->is_taking_vitamins, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_taking_vitamins" 
                           name="is_taking_vitamins" 
                           value="false" {{ checkboxVal(old('is_taking_vitamins'), 'false', $emp_health->is_taking_vitamins, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_taking_vitamins') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_taking_vitamins_specific', 'text', 'if YES, specify', 'Specific Vitamins', old('is_taking_vitamins_specific') ? old('is_taking_vitamins_specific') : $emp_health->is_taking_vitamins_specific, $errors->has('is_taking_vitamins_specific'), $errors->first('is_taking_vitamins_specific'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>2. Do you wear EYEGLASSES?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_wearing_eyeglass" 
                           name="is_wearing_eyeglass" 
                           value="true" {{ checkboxVal(old('is_wearing_eyeglass'), 'true', $emp_health->is_wearing_eyeglass, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_wearing_eyeglass" 
                           name="is_wearing_eyeglass" 
                           value="false" {{ checkboxVal(old('is_wearing_eyeglass'), 'false', $emp_health->is_wearing_eyeglass, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_wearing_eyeglass') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_wearing_eyeglass_va', 'text', 'if YES, specify visual acuity', 'Visual acuity', old('is_wearing_eyeglass_va') ? old('is_wearing_eyeglass_va') : $emp_health->is_wearing_eyeglass_va, $errors->has('is_wearing_eyeglass_va'), $errors->first('is_wearing_eyeglass_va'), ''
              ) !!}


              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>3. Do you do Physical Conditioning (Exercise)</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_exercising" 
                           name="is_exercising" 
                           value="true" {{ checkboxVal(old('is_exercising'), 'true', $emp_health->is_exercising, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_exercising" 
                           name="is_exercising" 
                           value="false" {{ checkboxVal(old('is_exercising'), 'false', $emp_health->is_exercising, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_exercising') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_exercising_how_often', 'text', 'if YES, How often', 'How often', old('is_exercising_how_often') ? old('is_exercising_how_often') : $emp_health->is_exercising_how_often, $errors->has('is_exercising_how_often'), $errors->first('is_exercising_how_often'), ''
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
                           value="true" {{ checkboxVal(old('is_treating_medical_condition'), 'true', $emp_health->is_treating_medical_condition, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_treating_medical_condition" 
                           name="is_treating_medical_condition" 
                           value="false" {{ checkboxVal(old('is_treating_medical_condition'), 'false', $emp_health->is_treating_medical_condition, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_treating_medical_condition') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_treating_medical_condition_medicines', 'text', 'if YES, specify', 'Name, dose and frequency of any medicines', old('is_treating_medical_condition_medicines') ? old('is_treating_medical_condition_medicines') : $emp_health->is_treating_medical_condition_medicines, $errors->has('is_treating_medical_condition_medicines'), $errors->first('is_treating_medical_condition_medicines'), ''
              ) !!}



              <div class="form-group col-md-12">
                <div class="checkbox">
                  <span>Do you have any chronic illness or injuries that must be pointed out?</span>
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_chronic_illness" 
                           name="is_has_chronic_illness" 
                           value="true" {{ checkboxVal(old('is_has_chronic_illness'), 'true', $emp_health->is_has_chronic_illness, true) }}>
                    &nbsp;Yes
                  </label>
                  &nbsp;
                  <label>
                    <input type="checkbox" 
                           class="minimal is_has_chronic_illness" 
                           name="is_has_chronic_illness" 
                           value="false" {{ checkboxVal(old('is_has_chronic_illness'), 'false', $emp_health->is_has_chronic_illness, false) }}>
                    &nbsp;No
                  </label><br>
                  <small class="text-danger">{{ $errors->first('is_has_chronic_illness') }}</small>
                </div>
              </div>

              {!! __form::textbox(
                '12', 'is_has_chronic_illness_details', 'text', 'if YES, specify', 'Give details of illness or injuries and their treatment details', old('is_has_chronic_illness_details') ? old('is_has_chronic_illness_details') : $emp_health->is_has_chronic_illness_details, $errors->has('is_has_chronic_illness_details'), $errors->first('is_has_chronic_illness_details'), ''
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