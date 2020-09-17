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
      <h2 class="box-title" style="padding-top: 5px;">Purchase Request Details</h2>
      <div class="pull-right">
          {!! __html::back_button(['dashboard.pr.index', 'dashboard.pr.edit']) !!}
          <a href="{{ route('dashboard.pr.print', [$pr->slug, 'FRONT']) }}" target="_blank" class="btn btn-sm btn-default">
          	<i class="fa fa-print"></i> Print Front
          </a>
          <a href="{{ route('dashboard.pr.print', [$pr->slug, 'BACK']) }}" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print Back
          </a>
      </div> 
    </div>

    <div class="box-body">

      <div class="row">

        <div class="col-md-12">

          <div class=" col-md-7 border">
            <span>Department: {{ optional($pr->department)->name }}</span><br>
            <span>Section/Unit: {{ optional($pr->division)->name }}</span>
          </div>

          <div class=" col-md-5 border">
          	<div class="col-md-12 no-padding">
          		<div class="col-md-6">
            		<span>PR No.: {{ $pr->pr_no }}</span>
          		</div>
          		<div class="col-md-6">
            		<span>Date: {{ __dataType::date_parse($pr->pr_no_date, 'm/d/Y') }}</span>
          		</div>
          		<div class="col-md-6">
            		<span>PR No.: {{ $pr->sai_no }}</span>
          		</div>
          		<div class="col-md-6">
            		<span>Date: {{ __dataType::date_parse($pr->sai_no_date, 'm/d/Y') }}</span>
          		</div>
          	</div>
          </div>

          <div class="col-md-12 border no-padding">

            <table class="table table-bordered">

              <thead>
                <td style="width:50px;">Stock No.</td>  
                <td style="width:50px;">Unit</td>
                <td style="width:200px;">Item Description</td>
                <td style="width:50px;">Qty</td>
                <td style="width:50px;">Unit Cost</td>
                <td style="width:50px;">Total Cost</td>
              </thead>

              <tbody>
                @foreach($pr->prParameter as $data)
                  <tr>
                    <td>{{ $data->stock_no }}</td>
                    <td>{{ $data->unit }}</td>
                    <td>
                      {{ $data->item_name }}<br>
                      {!! strip_tags($data->item_description, '<br>') !!}
                    </td>
                    <td>{{ number_format($data->qty) }}</td>
                    <td>{{ number_format($data->unit_cost, 3) }}</td>
                    <td>{{ number_format($data->total_cost, 3) }}</td>
                  </tr>
                @endforeach
              </tbody>

            </table>
            
          </div>

          <div class=" col-md-12 border">
            <span>Purpose:</span><br>
            <p>{!! strip_tags($pr->purpose, '<br>') !!}</p>
          </div>

          <div class=" col-md-6 border">
            <span>Requested by: {{ $pr->req_by_name }}</span><br>
            <span>Designation: {{ $pr->req_by_designation }}</span>
          </div>

          <div class=" col-md-6 border">
            <span>Approved by: {{ $pr->appr_by_name }}</span><br>
            <span>Designation: {{ $pr->appr_by_designation }}</span>
          </div>

        </div>

      </div>

    </div>

  </div>

</section>


@endsection