<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Request Form</title>

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
<body onload="window.print();" onafterprint="window.close()">

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
          <span style="font-size:20px; font-weight:bold;">PURCHASE REQUEST</span><br>
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
          <span>&nbsp;{{ optional($pr->department)->acronym }}</span>
        </div>

        {{-- DIV --}}
        <div class="col-sm-3">
          <span>Section/Unit</span>
        </div>
        <div class="col-sm-1">
          :
        </div>
        <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
          <span>&nbsp;{{ optional($pr->division)->name }}</span>
        </div>

      </div>

      {{-- COL --}}
      <div class="col-sm-5" style="padding-top:9px; padding-bottom:9px;">

        {{-- PR No --}}
        <div class="col-sm-2 no-padding">
          <span>P.R. No.</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
          <span>&nbsp;{{ $pr->pr_no }}</span>
        </div>
        <div class="col-sm-2 no-padding">
          <span>Date:</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
          <span>&nbsp;{{ __dataType::date_parse($pr->pr_no_date, 'm/d/Y') }}</span>
        </div>

        {{-- SAI No. --}}
        <div class="col-sm-2 no-padding">
          <span>SAI No.</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
          <span>&nbsp;{{ $pr->sai_no }}</span>
        </div>
        <div class="col-sm-2 no-padding">
          <span>Date:</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
          <span>&nbsp;{{ __dataType::date_parse($pr->sai_no_date, 'm/d/Y') }}</span>
        </div>
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
      <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; text-align: center;">
        <span>Unit Cost</span><br>
        &nbsp;
      </div>
      
      {{-- COL --}}
      <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; text-align: center;">
        <span>Total Cost</span><br>
        &nbsp;
      </div>

    </div>




    {{-- Items Body --}}
    <div class="row" style="border-top:solid 1.4px; font-size:10px; position: relative;">
      
      {{-- Overlay --}}
      <div class="col-sm-12 no-padding">

        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
        
        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
        
        {{-- COL --}}
        <div class="col-sm-5" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
        
        {{-- COL --}}
        <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
        
        {{-- COL --}}
        <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
        
        {{-- COL --}}
        <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 50em;">
        </div>
          
      </div>


      {{-- Content --}}
      <div class="col-sm-12 no-padding" style="position: absolute;">
          
        @foreach ($pr->prParameter as $data)

          <div class="col-sm-1"><p>{{ $data->stock_no }}</p></div>
          <div class="col-sm-1 no-padding"><p>{{ $data->unit }}</p></div>
          <div class="col-sm-5 no-padding"><p>{!! strip_tags($data->description, '<br>') !!}</p></div>
          <div class="col-sm-1 no-padding"><p>{{ number_format($data->qty) }}</p></div>
          <div class="col-sm-2 no-padding"><p>{{ number_format($data->unit_cost, 3) }}</p></div>
          <div class="col-sm-2 no-padding"><p>{{ number_format($data->total_cost, 3) }}</p></div>

        @endforeach
        
      </div>

    </div>



  </div>

</div>


{{-- SUFFIX --}}
<div class="row">
  
  <div class="col-sm-8 div-height">
    &nbsp;
  </div>

  <div class="col-sm-4 div-height" style="border-right:solid; padding-left:0; line-height: 1.2;"> 
    <span style="font-size:11px;">FM-AFD-PPS-003,Rev.00</span>
    <br><span style="font-size:11px;">Effectivity Date : March 12, 2015</span>
  </div>

</div>


</body>
</html>

