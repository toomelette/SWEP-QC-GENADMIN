@extends('layouts.admin-master')

@section('utils')

  <style type="text/css">
    
    .border {
      border:solid 1px;
      border-color:gray;
      padding:5px;
    }

  </style>

@endsection

@section('content')

<section class="content">
    
  <div class="box box-solid">
      
    <div class="box-header with-border">
      <h2 class="box-title" style="padding-top: 5px;">Job Order Details</h2>
      <div class="pull-right">
          <a href="{{ route('dashboard.jo.print', [$jo->slug, 'FRONT']) }}" target="_blank" class="btn btn-sm btn-default">
          	<i class="fa fa-print"></i> Print Front
          </a>
          <a href="{{ route('dashboard.jo.print', [$jo->slug, 'BACK']) }}" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print Back
          </a>
          {!! __html::back_button(['dashboard.jo.index', 'dashboard.jo.edit']) !!}
      </div> 
    </div>

    <div class="box-body">

      <div class="row">

        <div class="col-md-12">

          <div class=" col-md-12 border">
            <span>Department: {{ optional($jo->department)->name }}</span><br>
            <span>Section/Unit: {{ optional($jo->division)->name }}</span>
          </div>

          <div class=" col-md-8 border">
            <span>To: {{ $jo->to }}</span><br>
            <span>Address: {{ $jo->address }}</span><br>
            <span>TIN: {{ $jo->tin }}</span>
          </div>

          <div class=" col-md-4 border">
            <span>JO. No: {{ $jo->jo_no }}</span><br>
            <span>Date: {{ __dataType::date_parse($jo->date, 'M d, Y') }}</span><br>
            <span>Reference J.R No.: {{ optional($jo->jr)->jr_no }}</span>
          </div>

          <div class=" col-md-8 border">
            <span>Place of Delivery: {{ $jo->place_of_delivery }}</span><br>
            <span>Date of Delivery: {{ __dataType::date_parse($jo->date_of_delivery, 'M d, Y') }}</span>
          </div>

          <div class=" col-md-4 border">
            <span>Delivery Term: {{ $jo->delivery_term }}</span><br>
            <span>Payment Term: {{ $jo->payment_term }}</span>
          </div>

          <div class="col-md-12 border">
            <span>Description / Specification:</span><br>
            <span>{{ $jo->description }}</span>
          </div>

          <div class="col-md-12 border">
            <span>Scope of Works:</span><br>
            <span>{!! $jo->scope_of_works !!}</span>
          </div>

        </div>

      </div>

    </div>

  </div>

</section>


@endsection