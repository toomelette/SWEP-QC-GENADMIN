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
      <h2 class="box-title" style="padding-top: 5px;">Job Request Details</h2>
      <div class="pull-right">
          {!! __html::back_button(['dashboard.jr.index', 'dashboard.jr.edit']) !!}
          <a href="{{ route('dashboard.jr.print', [$jr->slug, 'FRONT']) }}" target="_blank" class="btn btn-sm btn-default">
          	<i class="fa fa-print"></i> Print
          </a>
      </div> 
    </div>

    <div class="box-body">

      <div class="row">

        <div class="col-md-12">

          <div class=" col-md-7 border">
            <span>Department: {{ optional($jr->department)->name }}</span><br>
            <span>Section/Unit: {{ optional($jr->division)->name }}</span>
          </div>

          <div class=" col-md-5 border">
          	<div class="col-md-12 no-padding">
          		<div class="col-md-9">
            		<span>JR No.: {{ $jr->jr_no }}</span>
          		</div>
          		<div class="col-md-3">&nbsp;</div>
          		<div class="col-md-9">
                <span>Date: {{ __dataType::date_parse($jr->date, 'm/d/Y') }}</span></div>
              <div class="col-md-3"></div>
          	</div>
          </div>

          <div class="col-md-12 border no-padding">

            <table class="table table-bordered">

              <thead>
                <td style="width:50px;">Stock No.</td>  
                <td style="width:50px;">Unit</td>
                <td style="width:200px;">Item Description</td>
                <td style="width:50px;">Qty</td>
                <td style="width:150px;">Nature of Work</td>
              </thead>

              <tbody>
                @foreach($jr->jrParameter as $data)
                  <tr>
                    <td>{{ $data->stock_no }}</td>
                    <td>{{ $data->unit }}</td>
                    <td>
                      {{ $data->item_name }}<br>
                      {!! strip_tags($data->item_description, '<br>') !!}
                    </td>
                    <td>{{ number_format($data->qty) }}</td>
                    <td>{!! strip_tags($data->nature_of_work, '<br>') !!}</td>
                  </tr>
                @endforeach
              </tbody>

            </table>
            
          </div>

          <div class=" col-md-12 border">
            <span>Purpose:</span><br>
            <p>{!! strip_tags($jr->purpose, '<br>') !!}</p>
          </div>

          <div class=" col-md-6 border">
            <span>Requested by: {{ $jr->req_by_name }}</span><br>
            <span>Designation: {{ $jr->req_by_designation }}</span>
          </div>

          <div class=" col-md-6 border">
            <span>Approved by: {{ $jr->appr_by_name }}</span><br>
            <span>Designation: {{ $jr->appr_by_designation }}</span>
          </div>

        </div>

      </div>

    </div>

  </div>

</section>


@endsection