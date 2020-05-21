<?php
  
  function displayCheckbox($value, $bool){

    $txt = '<span><i class="fa fa-square-o"></i></span>';

    if ($value == $bool) {
      $txt = '<span><i class="fa fa-check-square-o"></i></span>';
    }

    return $txt;

  }



  function displayCheckboxMh($emp_health, $id){

    $mh_list = $emp_health->empHealthMedHistory;
    $txt = '<span><i class="fa fa-square-o"></i></span>';

    if(isset($mh_list[$id]->is_checked)){
      if ($mh_list[$id]->is_checked == true) {
        $txt = '<span><i class="fa fa-check-square-o"></i></span>';
      }
    }

    return $txt;

  }



  function displayMedicationMh($emp_health, $id){

    $mh_list = $emp_health->empHealthMedHistory;
    $value = '';

    if(isset($mh_list[$id]->medication)){
      $value = $mh_list[$id]->medication;
    }

    return $value;

  }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Declaration Form</title>
	<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

  <style type="text/css">
    
    .border {
      border:solid 1px;
      border-color:gray;
      padding:5px;
    }

    table {
      width: 460px;
    }
    
    table, th, td {
      border: 1px solid gray;
      font-size: 10px;
    }

    th, td {
      padding: 3px;
      text-align: left;
    }

    td{
      font-size:11px;
    }

  </style>

</head>
<body {{-- onload="window.print();" onafterprint="window.close()" --}} style="font-size:11px;">

	<section class="invoice">

    <div class="row">
      <div class="col-xs-12">
        <div class=" col-xs-4 border">
          <span>EMPNO: {{ $emp_health->emp_no }}</span>
        </div>
        <div class=" col-xs-8 border">
          <span>NAME: {{ $emp_health->fullname }}</span>
        </div>
        <div class=" col-xs-12 border">
          <span>DEPARTMENT / DIVISION / SECTION: {{ $emp_health->department_text }}</span>
        </div>
        <div class=" col-xs-6 border">
          <span>POSITION: {{ $emp_health->position }}</span>
        </div>
        <div class=" col-xs-6 border">
          <span>CONTACT NUMBER / EMAIL: {{ $emp_health->contact_email }}</span>
        </div>
        <div class=" col-xs-12 border">
          <span>ADDRESS: {{ $emp_health->address }}</span>
        </div>
        <div class=" col-xs-12 border">
          <span>Cities in the Philippines you have worked, visited, transited in the past 14 days / ECQ Period:</span><br>
          &nbsp;<span>{{ $emp_health->travel_history }}</span>
        </div>

        <div class="col-xs-12 border">
          <span>
            Have you been sick in the past 30 days?
          </span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          {!! displayCheckbox($emp_health->is_has_sick_history, true) !!} Yes 
          &nbsp;&nbsp;&nbsp;&nbsp;
          {!! displayCheckbox($emp_health->is_has_sick_history, false) !!} No
          <br>
          <div class="col-xs-3">
            <span>Hospital Visited if any?</span>
          </div>
          <div class="col-xs-9" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_sick_history_hos_visited }}</span>
          </div>
          <div class="col-xs-3">
            <span>If YES, (pls. describe condition)</span>
          </div>
          <div class="col-xs-9" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_sick_history_condition }}</span>
          </div>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-12 no-padding">
            <div class="col-xs-10 no-padding">
              <span>
                In the last 14 days, did you have any of the following: fever, colds, cough, sore throat or difficulty in breathing, diarrhea?
              </span><br>
            </div>
            &nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_fever_history, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_fever_history, false) !!} No
          </div>
          <br>
          <div class="col-xs-4">
            <span>If YES, (pls. describe condition)</span>
          </div>
          <div class="col-xs-8" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_fever_history_condition }}</span>
          </div>
        </div>

        <div class=" col-xs-12 border" style="text-align: center;">
          <span>MEDICAL HISTORY</span><br>
          <span>Have you ever had the following medical condition(s)? Please put a CHECK in the box(es) below:</span>
        </div>

        <div class="col-xs-6 border no-padding" style="overflow: hidden;">

          <table>
            <thead>
              <td style="width:180px;">Medical Condition</td>  
              <td>Medication</td>
            </thead>
            <tbody>

              @for ($i = 0; $i < count($global_medical_history_all); $i++)

                @if ($i >= 0 && $i <= 10)

                  <tr>
                    @if ($i == 7)
                      <td style="padding-bottom:10px;">
                        {!! displayCheckboxMh($emp_health, $i) !!} 
                        {{ $global_medical_history_all[$i]['name'] }}
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pulmonary Disease (COPD)
                      </td>
                    @else
                      <td>
                        {!! displayCheckboxMh($emp_health, $i) !!} 
                        {{ $global_medical_history_all[$i]['name'] }}
                      </td>
                    @endif

                    <td>
                      {!! displayMedicationMh($emp_health, $i) !!}
                    </td>

                  </tr>

                @endif

              @endfor

            </tbody>
          </table>

        </div>


        <div class="col-xs-6 border no-padding">

          <table>
            <thead>
              <td style="width:180px;">Medical Condition</td>  
              <td>Medication</td>
            </thead>
            <tbody>

              @for ($i = 0; $i < count($global_medical_history_all); $i++)

                @if ($i > 10 && $i <= 22)

                  <tr>

                    <td>
                      {!! displayCheckboxMh($emp_health, $i) !!} 
                      {{ $global_medical_history_all[$i]['name'] }}
                    </td>

                    <td>
                      {!! displayMedicationMh($emp_health, $i) !!} 
                    </td>

                  </tr>

                @endif

              @endfor

            </tbody>
          </table>
          
        </div>

        <div class=" col-xs-6 border" style="text-align: center;">
          <span>SOCIAL HISTORY / CURRENT</span>
        </div>
        <div class=" col-xs-6 border" style="text-align: center;">
          <span>HEALTH ROUTINES</span>
        </div>

        <div class="col-xs-6 border no-padding">

          <div class="col-xs-12" style="padding:10px;">
            <span>1. Do you SMOKE / VAPE? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_smoking, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_smoking, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, number of PACKS PER DAY</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_smoking_packs_per_day }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you Drink Alcohol? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_drinking_alcohol, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_drinking_alcohol, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, how often?</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_drinking_alcohol_how_often }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>3. Do you take Prohibited DRUGS? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_drugs, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_drugs, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_taking_drugs_specific }}</span>
            </div>
          </div>

        </div>

        <div class="col-xs-6 border no-padding">

          <div class="col-xs-12" style="padding:10px;">
            <span>1. Do you take VITAMINS? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_vitamins, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_vitamins, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_taking_vitamins_specific }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you wear EYEGLASSES? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_wearing_eyeglass, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_wearing_eyeglass, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, specify visual acuity</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_wearing_eyeglass_va }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you do Physical Conditioning (Exercise) ? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_exercising, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_exercising, false) !!} No
            <br>
            <div class="col-xs-12">
              <span>If YES, how often</span>
            </div>
            <div class="col-xs-12" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_exercising_how_often }}</span>
            </div>
          </div>

        </div>

        <div class=" col-xs-12 border" style="text-align: center;">
          <span>CURRENT MEDICAL CONDITIONS</span>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-12">
            <span>
              Are you currently being treated for any underlying medical conditions?
              (ie. Diabetes, hypertension, cancer, COPD, etc.)
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_treating_medical_condition, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_treating_medical_condition, false) !!} No
            <br>
          </div>
          <div class="col-xs-2">
            <span>If YES, how specify</span>
          </div>
          <div class="col-xs-10" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_treating_medical_condition_medicines }}</span>
          </div>
          <div class="col-xs-2"></div>
          <div class="col-xs-10">
            <span>(Name, dose and frequency of any medicines)</span>
          </div>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-12">
            <span>
              Do you have any chronic illness or injuries that must be pointed out?
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_chronic_illness, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_chronic_illness, false) !!} No
            <br>
          </div>
          <div class="col-xs-2">
            <span>If YES, how specify</span>
          </div>
          <div class="col-xs-10" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_chronic_illness_details }}</span>
          </div>
          <div class="col-xs-2"></div>
          <div class="col-xs-10">
            <span>(Give details of illness or injuries and their treatment details)</span>
          </div>
        </div>

      </div>
    </div>



  </section>

</body>
</html>