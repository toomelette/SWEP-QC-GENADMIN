<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Request Form</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">
      
    .div-height{

      margin-bottom: -50px; 
      padding-bottom: 50px; 
      overflow: hidden;

    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()" style="margin-top:70px;">

  <div style="border:solid;">

    <div class="wrapper">


      {{-- HEADER --}}
      <div class="row" style="padding:10px;">
        
        <div class="col-md-1"></div>

        <div class="col-md-12">
          <div class="col-sm-1"></div>
          <div class="col-sm-3" style="width:150px;">
            <img src="{{ asset('images/sra.png') }}">
          </div>
          <div class="col-sm-8" style="text-align: center; padding-right:150px; padding-top:20px;">
            <span style="font-size:20px; font-weight:bold;">JOB REQUEST</span><br>
            <small>SUGAR REGULATORY ADMINISTRATION</small><br>
          </div>
        </div>

        <div class="col-md-1"></div>

      </div>



      {{-- 1st Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        
        {{-- COL --}}
        <div class="col-sm-7" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px;">

          {{-- DEPT --}}
          <div class="col-sm-3">
            <span>Department</span>
          </div>
          <div class="col-sm-1">
            :
          </div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ optional($jr->department)->acronym }}</span>
          </div>

          {{-- DIV --}}
          <div class="col-sm-3">
            <span>Section/Unit</span>
          </div>
          <div class="col-sm-1">
            :
          </div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ optional($jr->division)->acronym }}</span>
          </div>

        </div>

        {{-- COL --}}
        <div class="col-sm-5" style="padding-top:9px; padding-bottom:9px;">

          {{-- PR No --}}
          <div class="col-sm-2 no-padding">
            <span>J.R. No.</span>
          </div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ $jr->jr_no }}</span>
          </div>
          <div class="col-sm-2 no-padding">&nbsp;</div>

          <div class="col-sm-12"></div>

          <div class="col-sm-2 no-padding">
            <span>Date:</span>
          </div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ __dataType::date_parse($jr->date, 'm/d/Y') }}</span>
          </div>
          <div class="col-sm-2 no-padding">&nbsp;</div>

        </div>

      </div>




      {{-- Items Header --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        
        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; text-align: center;">
          <span>Stock No.</span>
        </div>
        
        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; text-align: center;">
          <span>Unit</span><br>
          &nbsp;
        </div>
        
        {{-- COL --}}
        <div class="col-sm-5" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; text-align: center;">
          <span>Item Description</span><br>
          &nbsp;
        </div>
        
        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; text-align: center;">
          <span>Qty</span><br>
          &nbsp;
        </div>
        
        {{-- COL --}}
        <div class="col-sm-4" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; text-align: center;">
          <span>Nature of Work</span><br>
          &nbsp;
        </div>

      </div>




      {{-- Items Body --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; position: relative;">
        
        {{-- Overlay --}}
        <div class="col-sm-12 no-padding">

          {{-- COL --}}
          <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 35em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-1" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 35em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-5" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 35em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 35em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-4" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 35em;">
          </div>
            
        </div>


        {{-- Content --}}
        <div class="col-sm-12 no-padding" style="position: absolute; margin-left: 4px; margin-top: 10px; word-wrap: break-word;">

          @foreach ($jr->jrParameter as $data)

            <div class="col-sm-1"><p>{{ $data->stock_no }}</p></div>
            <div class="col-sm-1 no-padding"><p>{{ $data->unit }}</p></div>
            <div class="col-sm-5 no-padding">
              <p>
                <b>{{ $data->item_name }}</b><br>
                {!! strip_tags($data->item_description, '<br>') !!}
              </p>
            </div>
            <div class="col-sm-1 no-padding"><p>{{ number_format($data->qty) }}</p></div>
            <div class="col-sm-4 no-padding">
              <p>{!! strip_tags($data->nature_of_work, '<br>') !!}</p>
            </div>
            <div class="col-sm-12"></div>

          @endforeach

            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-1 no-padding">&nbsp;</div>
            <div class="col-sm-5 no-padding">
              <p>*************** Nothing Follows ***************</p>
            </div>
            <div class="col-sm-1 no-padding">&nbsp;</div>
            <div class="col-sm-4 no-padding">&nbsp;</div>
            
        </div>

      </div>




      {{-- CERTIFICATION --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; position: relative; padding-bottom:10px;">

        <div class="col-sm-12" style="margin-left: 4px; border-right:solid 1.4px; padding-bottom:10px;">
          <p>To be Certified by General Services/MIS/Authorized PErsonnel in case of repair and replacement of parts.</p>
        </div>

        <div class="col-sm-12" style="text-align:center;">
          <p style="font-weight:bold; font-style: italic;">CERTIFICATION</p>
        </div>

        <div class="col-sm-2"></div>
        <div class="col-sm-8" style="margin-left:4px; padding-bottom:14px;">
          <p>
            I hereby certify that the repair and replacement of the parts of the items described above are <br>
            necessary in the interest of public service and that all defects and/or damages were caused due <br>
            to wear and tear and not through the fault, negligence or carelessness of the accountable/ <br>
            respomsible officer or employee.
          </p>
        </div>

        <div class="col-sm-7"></div>
        <div class="col-sm-3" style="border-top:solid 1.4px; text-align: center;">
          (Signature over printed name)
        </div>
        <div class="col-sm-2"></div>

      </div>




      {{-- PURPOSE --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; position: relative;">
        

        {{-- Overlay --}}
        <div class="col-sm-12" style="margin-left: 4px; border-right:solid 1.4px; padding-top:9px; padding-bottom:14px;">

          <div class="col-sm-1 no-padding"><span>Purpose:</span></div>
          <div class="col-sm-11" style="border-bottom: solid 1px;">&nbsp;</div>

          <div class="col-sm-1">&nbsp;</div>
          <div class="col-sm-11" style="border-bottom: solid 1px;">&nbsp;</div>

          <div class="col-sm-1">&nbsp;</div>
          <div class="col-sm-11" style="border-bottom: solid 1px;">&nbsp;</div>

        </div>


        {{-- Content --}}
        <div class="col-sm-12" style="padding-top:9px; position: absolute;">
    
          <div class="col-sm-1">&nbsp;</div>
          <div class="col-sm-11"><p>{!! strip_tags($jr->purpose, '<br>') !!}</p></div>

        </div>


      </div>




      {{-- SIGNATORIES --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        
        {{-- COL --}}
        <div class="col-sm-2" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px;">
          <span style="margin-left: 4px;">Signature</span>
        </div>

        <div class="col-sm-5 no-padding" style="border-right:solid 1.4px;">
          <div class="col-sm-12" style="border-bottom:solid 1.4px; text-align: center; padding-top:2px;">
            <span>Requested by:</span>
          </div>
          <div class="col-sm-12">
            &nbsp;
          </div>
        </div>

        <div class="col-sm-5 no-padding">
          <div class="col-sm-12" style="border-bottom:solid 1.4px; text-align: center; padding-top:2px;">
            <span>Approved by:</span>
          </div>
        </div>

      </div>




      {{-- SIGNATORIES 2 --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        
        {{-- COL --}}
        <div class="col-sm-2" style="border-right:solid 1.4px;">
          <span style="margin-left: 4px;">Printed Name</span>
        </div>

        <div class="col-sm-5 no-padding" style="border-right:solid 1.4px; text-align: center;">
          <span>{{ $jr->req_by_name }}</span>
        </div>

        <div class="col-sm-5 no-padding" style="text-align: center;">
          <span>{{ $jr->appr_by_name }}</span>
        </div>

      </div>




      {{-- SIGNATORIES 3 --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        
        {{-- COL --}}
        <div class="col-sm-2" style="border-right:solid 1.4px;">
          <span style="margin-left: 4px;">Designation</span>
        </div>

        <div class="col-sm-5 no-padding" style="border-right:solid 1.4px; text-align: center;">
          <span>{{ $jr->req_by_designation }}</span>
        </div>

        <div class="col-sm-5 no-padding"  style="text-align: center;">
          <span>{{ $jr->appr_by_designation }}</span>
        </div>

      </div>




    </div>

  </div>


  {{-- SUFFIX --}}
  <div class="row">
    
    <div class="col-sm-8 div-height">&nbsp;</div>

    <div class="col-sm-4 div-height" style="border-right:solid; padding-left:0; line-height: 1.2;"> 
      <span style="font-size:11px;">FM-AFD-PPS-001,Rev.00</span>
      <br><span style="font-size:11px;">Effectivity Date : March 12, 2015</span>
    </div>

  </div>


</body>
</html>

