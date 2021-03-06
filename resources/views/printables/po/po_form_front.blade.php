<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Order Form</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    @media print {

      html, body {
        margin-top:15px;
        padding: 0 !important;
        height:100%; 
        overflow: hidden;
      }

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
          <div class="col-sm-8" style="text-align: center; padding-right:150px; padding-top:5px;">
            <span style="font-size:20px; font-weight:bold;">PURCHASE ORDER</span><br>
            <small>Sugar Regulatory Administration</small><br>
            <small>North Avenue, Diliman, Quezon City</small><br>
            <small>Telefax No.(02) 929-61-36</small>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>




      {{-- 1st Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        

        {{-- COL --}}
        <div class="col-sm-7" style="border-right:solid 1.4px; padding-top:9px; padding-left:20px; padding-bottom:9px;">

          {{-- To --}}
          <div class="col-sm-1 no-padding"><span>To</span></div>
          <div class="col-sm-1 no-padding">:</div>
          <div class="col-sm-10 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ $po->to }}</span>
          </div>

          {{-- Address --}}
          <div class="col-sm-1 no-padding"><span>Address</span></div>
          <div class="col-sm-1 no-padding">:</div>
          <div class="col-sm-10 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ $po->address }}</span>
          </div>

          {{-- TIN --}}
          <div class="col-sm-1 no-padding"><span>TIN</span></div>
          <div class="col-sm-1 no-padding">:</div>
          <div class="col-sm-10 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ $po->tin }}</span>
          </div>

        </div>


        {{-- COL --}}
        <div class="col-sm-5" style="padding-top:9px; padding-left:5px; padding-bottom:9px;">

          {{-- PO No --}}
          <div class="col-sm-2 no-padding"><span>P.O. No.:</span></div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ $po->po_no }}</span>
          </div>
          <div class="col-sm-12"></div>

          {{-- Date --}}
          <div class="col-sm-2 no-padding"><span>Date:</span></div>
          <div class="col-sm-8 no-padding" style="border-bottom: solid 1px; white-space: nowrap;">
            <span>&nbsp;{{ __dataType::date_parse($po->date, 'm/d/Y') }}</span>
          </div>
          <div class="col-sm-12"></div>

          {{-- Mode of Procurement --}}
          <div class="col-sm-5 no-padding"><span>Mode of Procurement:</span></div>
          <div class="col-sm-7 no-padding" style="white-space: nowrap;">
            <span>&nbsp;{{ $po->mode_of_procurement }}</span>
          </div>

        </div>

      </div>




      {{-- 2nd Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">

        <div class="col-sm-12" style="padding-left:20px;">
          <span>Gentlemen:</span>
          <p style="margin-left: 55px;">
            Please furnish this Office the following articles, subject to the terms and conditions contained herein:
          </p>
        </div>

      </div>




      {{-- 3rd Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        

        {{-- COL --}}
        <div class="col-sm-7" style="border-right:solid 1.4px; padding-top:9px; padding-left:20px; padding-bottom:9px;">

          {{-- Place of Delivery --}}
          <div class="col-sm-3 no-padding"><span>Place of Delivery:</span></div>
          <div class="col-sm-9 no-padding" style="white-space: nowrap;">
            <span>&nbsp;{{ $po->place_of_delivery }}</span>
          </div>

          <div class="col-md-12">&nbsp;</div>

          {{-- Date of Delivery --}}
          <div class="col-sm-3 no-padding"><span>Date of Delivery:</span></div>
          <div class="col-sm-9 no-padding" style="white-space: nowrap;">
            <span>&nbsp;{{ __dataType::date_parse($po->date_of_delivery, 'F d, Y') }}</span>
          </div>

        </div>
          

        {{-- COL --}}
        <div class="col-sm-5" style="border-right:solid 1.4px; padding-top:9px; padding-left:5px; padding-bottom:9px;">

          {{-- Delivery Term --}}
          <div class="col-sm-3 no-padding"><span>Delivery Term:</span></div>
          <div class="col-sm-9 no-padding" style="white-space: nowrap;">
            <span>&nbsp;{{ $po->delivery_term }}</span>
          </div>

          <div class="col-md-12">&nbsp;</div>

          {{-- Payment Term --}}
          <div class="col-sm-3 no-padding"><span>Payment Term:</span></div>
          <div class="col-sm-9 no-padding" style="white-space: nowrap;">
            <span>&nbsp;{{ $po->payment_term }}</span>
          </div>

        </div>


      </div>




      {{-- 4th Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; padding-left: 20px; padding-top: 5px; padding-bottom: 5px;">
        <span>THIS ORDER IS SUBJECT TO THE CONDITIONS PRINTED AT THE BACK HEREOF.</span>
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
          <span>Description</span><br>
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
          <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-1" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-5" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-1" style="border-right:solid 1.4px; padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
          
          {{-- COL --}}
          <div class="col-sm-2" style="border-right:solid 1.4px;padding-top:9px; padding-bottom:9px; height: 40em;">
          </div>
            
        </div>


        {{-- Content --}}
        <div class="col-sm-12 no-padding" style="position: absolute; margin-left: 4px; margin-top: 10px; word-wrap: break-word;">
              
          @php
            $total = 0;
          @endphp

          @foreach ($po->poParameter as $data)

            @php
              $total += $data->total_cost;
            @endphp

            <div class="col-sm-1"><p>{{ $data->stock_no }}</p></div>
            <div class="col-sm-1 no-padding"><p>{{ $data->unit }}</p></div>
            <div class="col-sm-5 no-padding">
              <p>
                <b>{{ $data->item_name }}</b><br>
                {!! strip_tags($data->item_description, '<br>') !!}
              </p>
            </div>
            <div class="col-sm-1 no-padding"><p>{{ number_format($data->qty) }}</p></div>
            <div class="col-sm-2 no-padding" style="text-align:center;"><p>{{ number_format($data->unit_cost, 2) }}</p></div>
            <div class="col-sm-2 no-padding" style="text-align:center;"><p>{{ number_format($data->total_cost, 2) }}</p></div>
            <div class="col-sm-12"></div>

          @endforeach

            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-1 no-padding">&nbsp;</div>
            <div class="col-sm-5 no-padding">
              <p>*************** Nothing Follows ***************</p>
            </div>
            <div class="col-sm-1 no-padding">&nbsp;</div>
            <div class="col-sm-2 no-padding">&nbsp;</div>
            <div class="col-sm-2 no-padding" style="font-weight:bold; text-align:center;">{{ number_format($total, 2) }}</div>
            
        </div>

      </div>



      {{-- 4th Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; padding-left: 20px; padding-top: 5px; padding-bottom: 5px;">
        (Total Amount in Words) : <span style="font-weight: bold;">{{ __dataType::num_to_words($total, 2) }}</span>
      </div>



      {{-- 5th Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px; padding-left: 20px;">
        
        <div class="col-sm-12 no-padding" style="margin-bottom: 10px;">
          <p>In case of failure to make delivery/services within the time specified above, a penalty of one tenth (1/10)<br>
            of one percent for every day of delay shall be imposed.
          </p>  
        </div>
       
        <div class="col-sm-7">&nbsp;</div>
        <div class="col-sm-5">
          <p>Very truly yours,</p>
        </div>

        <div class="col-sm-12" style="margin-bottom: 35px;"></div>

        <div class="col-sm-8">&nbsp;</div>
        <div class="col-sm-3" style="border-top:solid 1px; text-align:center;">
          <p>(Authorized Official)</p>
        </div>
        <div class="col-sm-1">&nbsp;</div>

        <div class="col-sm-12"></div>

        <div class="col-sm-1 no-padding">
          <p>Conforme:</p>
        </div>
        <div class="col-sm-11"></div>

        <div class="col-sm-12"></div>

        <div class="col-sm-1"></div>
        <div class="col-sm-5" style="border-top:solid 1px; text-align:center;">
          <p>(Signature over printed Name of Supplier)</p>
        </div>
        <div class="col-sm-6"></div>

        <div class="col-sm-12" style="margin-bottom: 10px;"></div>

        <div class="col-sm-2"></div>
        <div class="col-sm-3" style="border-top:solid 1px; text-align:center;">
          <p>(Date)</p>
        </div>

      </div>




      {{-- 6th Box --}}
      <div class="row" style="border-top:solid 1.4px; font-size:10px;">
        

        {{-- COL --}}
        <div class="col-sm-7" style="padding-top:5px; border-right:solid 1.4px; padding-left:20px;">

          <div class="col-sm-12 no-padding" style="margin-bottom: 20px;">
            <p>Funds Available:</p>
          </div>

          <div class="col-sm-4">&nbsp;</div>
          <div class="col-sm-4" style="border-bottom:solid 1px; text-align: center;">
            ERLINDA J. ABACAN
          </div>
          <div class="col-sm-4">&nbsp;</div>

          <div class="col-sm-12"></div>

          <div class="col-sm-4">&nbsp;</div>
          <div class="col-sm-4" style="text-align: center;">
            Chief Accountant
          </div>
          <div class="col-sm-4">&nbsp;</div>

          <div class="col-sm-12" style="margin-bottom:10px;"></div>

        </div>


        {{-- COL --}}
        <div class="col-sm-5" style="padding-top:5px; padding-left:5px;">

          <div class="col-sm-12 no-padding"><span>BUR No.:</span></div>
          <div class="col-sm-12 no-padding" style="margin-bottom:10px;">
            <p></p>
          </div>

          <div class="col-sm-12 no-padding"><span>Amount:</span></div>
          <div class="col-sm-12 no-padding">
            <p></p>
          </div>

        </div>

      </div>




    </div>

  </div>


  {{-- SUFFIX --}}
  <div class="row">
    
    <div class="col-sm-8 div-height">&nbsp;</div>

    <div class="col-sm-4 div-height" style="border-right:solid; padding-left:0; line-height: 1.2;"> 
      <span style="font-size:11px;">FM-AFD-PPS-003,Rev.00</span>
      <br><span style="font-size:11px;">Effectivity Date : March 12, 2015</span>
    </div>

  </div>


</body>
</html>

