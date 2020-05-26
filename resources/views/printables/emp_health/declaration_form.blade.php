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
<body onload="window.print();" onafterprint="window.close()" style="font-size:11px;">

	<section class="invoice">

    {{-- HEADER --}}
    <div class="row" style="padding:10px; margin-bottom:10px;">

      <div class="col-xs-1"></div>
      <div class="col-xs-12">
        <div class="col-xs-3"></div>
        <div class="col-xs-1 no-padding">
          <img src="{{ asset('favicon.ico') }}" style="width:60px;">
        </div>
        <div class="col-xs-8" style="padding-right:125px;">
          <span>REPUBLIC OF THE PHILIPPINES</span><br>
          <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span>North Avenue, Diliman, Quezon City</span><br>
        </div>
      </div>
      <div class="col-xs-1"></div>
    </div>


    <div class="row" style="text-align:center; border-bottom: solid 2px; margin-bottom:20px;">
      <span style="font-size:15px; font-weight:bold;">HEALTH DECLARATION FORM</span>
    </div>


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

        <div class=" col-xs-2 border">
          <span>Birthday: {{ $emp_health->birthday->format('F d,Y') }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>Age: {{ $emp_health->birthday->age }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>Sex: {{ $emp_health->displaySex() }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>Civil Status: {{ $emp_health->displayCivilStatus() }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>Height: {{ $emp_health->height }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>Weight: {{ $emp_health->weight }}</span>
        </div>

        <div class=" col-xs-2 border">
          <span>PHILHEALTH:</span><br>
          <span>&nbsp;{{ $emp_health->philhealth_no }}</span>
        </div>
        <div class=" col-xs-2 border">
          <span>BLOOD TYPE:</span><br>
          <span>&nbsp;{{ $emp_health->bloodtype }}</span>
        </div>
        <div class=" col-xs-3 border">
          <span>Family Doctor, if any:</span><br>
          <span>&nbsp;{{ $emp_health->family_doctor }}</span>
        </div>
        <div class=" col-xs-5 border">
          <span>CONTACT PERSON and Mobile No. #, incase of emergency:</span><br>
          <span>&nbsp;{{ $emp_health->contact_person }}</span>
        </div>

        <div class=" col-xs-12 border">
          <span>Cities in the Philippines you have worked, visited, transited in the past 14 days / ECQ Period:</span><br>
          &nbsp;<span>{{ $emp_health->travel_history }}</span>
        </div>

        <div class=" col-xs-4 border" style="padding-bottom: 6px;">
          <span>Have you been sick in the past 30 days?</span><br>
          <span>Hospital Visited if any? &nbsp;{{ $emp_health->is_has_sick_history_hos_visited }}</span><br>
        </div>
        <div class=" col-xs-8 border">
          <div class="col-xs-4">
            {!! displayCheckbox($emp_health->is_has_sick_history, true) !!} Yes (pls. describe condition)
          </div>
          <div class="col-xs-8" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_sick_history_condition }}</span>
          </div>
          <div class="col-xs-12">
            {!! displayCheckbox($emp_health->is_has_sick_history, false) !!} No
          </div>
        </div>

        <div class=" col-xs-4 border">
          <span>In the last 14 days, did you have any of the following: fever, colds, cough, sore throat or difficulty in breathing, diarrhea?</span>
        </div>
        <div class=" col-xs-8 border" style="padding-bottom: 18px;">
          <div class="col-xs-4">
            {!! displayCheckbox($emp_health->is_has_fever_history, true) !!} Yes (pls. describe condition)
          </div>
          <div class="col-xs-8" style="border-bottom: solid 1px;">
            &nbsp;<span>{{ $emp_health->is_has_fever_history_condition }}</span>
          </div>
          <div class="col-xs-12">
            {!! displayCheckbox($emp_health->is_has_fever_history, false) !!} No
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
            <div class="col-xs-7">
              <span>If YES, number of PACKS PER DAY</span>
            </div>
            <div class="col-xs-5" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_smoking_packs_per_day }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you Drink Alcohol? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_drinking_alcohol, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_drinking_alcohol, false) !!} No
            <br>
            <div class="col-xs-4">
              <span>If YES, how often?</span>
            </div>
            <div class="col-xs-8" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_drinking_alcohol_how_often }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>3. Do you take Prohibited DRUGS? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_drugs, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_taking_drugs, false) !!} No
            <br>
            <div class="col-xs-4">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-8" style="border-bottom: solid 1px;">
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
            <div class="col-xs-4">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-8" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_taking_vitamins_specific }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you wear EYEGLASSES? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_wearing_eyeglass, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_wearing_eyeglass, false) !!} No
            <br>
            <div class="col-xs-6">
              <span>If YES, specify visual acuity</span>
            </div>
            <div class="col-xs-6" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_wearing_eyeglass_va }}</span>
            </div>
          </div>

          <div class="col-xs-12" style="padding:10px; border-top:solid 1px;">
            <span>2. Do you do Physical Conditioning (Exercise) ? </span>&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_exercising, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_exercising, false) !!} No
            <br>
            <div class="col-xs-4">
              <span>If YES, how often</span>
            </div>
            <div class="col-xs-8" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_exercising_how_often }}</span>
            </div>
          </div>

        </div>

        <div class=" col-xs-12 border" style="text-align: center;">
          <span>CURRENT MEDICAL CONDITIONS</span>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-4">
            <span>
              Are you currently being treated for any underlying medical conditions?
              <br>(ie. Diabetes, hypertension, cancer, COPD, etc.)
            </span>
          </div>
          <div class="col-xs-8">
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_treating_medical_condition, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_treating_medical_condition, false) !!} No
            <br>
            <div class="col-xs-3">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-9" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_treating_medical_condition_medicines }}</span>
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-9">
              <span>(Name, dose and frequency of any medicines)</span>
            </div>
          </div>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-4">
            <span>
              Do you have any chronic illness or injuries that must be pointed out?
            </span>
          </div>
          <div class="col-xs-8">
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_chronic_illness, true) !!} Yes 
            &nbsp;&nbsp;&nbsp;&nbsp;
            {!! displayCheckbox($emp_health->is_has_chronic_illness, false) !!} No
            <br>
            <div class="col-xs-3">
              <span>If YES, specify</span>
            </div>
            <div class="col-xs-9" style="border-bottom: solid 1px;">
              &nbsp;<span>{{ $emp_health->is_has_chronic_illness_details }}</span>
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-9">
              <span>(Give details of illness or injuries and their treatment details)</span>
            </div>
          </div>
        </div>

        <div class="col-xs-12 border">
          <div class="col-xs-12" style="margin-bottom:10px;">
            <span style="font-weight:bold;">DECLARATION, DISCLAIMER AND DATA PRIVACY CONSENT FORM</span>
          </div>
          <div class="col-xs-12">
            <p>I hereby declare that the above information provided is to the best of my knowledge complete and true.</p>
            <p>All confidential information delivered by the undersigned to the SRA shall be used solely and exclusively as reference to carry out the purposes of the office and for no other purpose.  This document shall be made available only to the Head of the Human Resource Section of SRA Quezon City  or SRA Bacolod City as the case maybe, as well as to the Administrator, who shall treat the same with utmost confidentiality.</p>
          </div>
          <div class="col-xs-12" style="margin-top:40px;">
            <div class="col-xs-2"></div>
            <div class="col-xs-4" style="border-bottom: solid 1px;"></div>
            <div class="col-xs-1"></div>
            <div class="col-xs-4" style="border-bottom: solid 1px;"></div>
            <div class="col-xs-1"></div>
            <div class="col-xs-2"></div>
            <div class="col-xs-4" style="text-align:center;">Name and Signature</div>
            <div class="col-xs-1"></div>
            <div class="col-xs-4" style="text-align:center;">Date</div>
            <div class="col-xs-1"></div>
          </div>
          <div class="col-xs-12" style="margin-top:10px;">
            <p style="font-style:italic;">Please be advised that the above information shall only be used in relation to the COVID-19 and other medical internal protocols in accordance with the Data Privacy Act.</p>
          </div>
        </div>

      </div>
    </div>



  </section>

</body>
</html>