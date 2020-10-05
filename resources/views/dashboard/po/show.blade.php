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
      <h2 class="box-title" style="padding-top: 5px;">Purchase Order Details</h2>
      <div class="pull-right">
          <a href="{{ route('dashboard.po.print', [$po->slug, 'FRONT']) }}" target="_blank" class="btn btn-sm btn-default">
          	<i class="fa fa-print"></i> Print Front
          </a>
          <a href="{{ route('dashboard.po.print', [$po->slug, 'BACK']) }}" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print Back
          </a>
          {!! __html::back_button(['dashboard.po.index', 'dashboard.po.edit']) !!}
      </div> 
    </div>

    <div class="box-body">

      <div class="row">

        <div class="col-md-12">

          <div class=" col-md-12 border">
            <span>Department: {{ optional($po->department)->name }}</span><br>
            <span>Section/Unit: {{ optional($po->division)->name }}</span>
          </div>

          <div class=" col-md-8 border">
            <span>To: {{ $po->to }}</span><br>
            <span>Address: {{ $po->address }}</span><br>
            <span>TIN: {{ $po->tin }}</span>
          </div>

          <div class=" col-md-4 border">
            <span>PO. No: {{ $po->po_no }}</span><br>
            <span>Date: {{ __dataType::date_parse($po->date, 'M d, Y') }}</span><br>
            <span>Mode of Procurement: {{ $po->mode_of_procurement }}</span>
          </div>

          <div class=" col-md-8 border">
            <span>Place of Delivery: {{ $po->place_of_delivery }}</span><br>
            <span>Date of Delivery: {{ __dataType::date_parse($po->date_of_delivery, 'M d, Y') }}</span>
          </div>

          <div class=" col-md-4 border">
            <span>Delivery Term: {{ $po->delivery_term }}</span><br>
            <span>Payment Term: {{ $po->payment_term }}</span>
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
                @foreach($po->poParameter as $data)
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

          <div class="col-md-4 border">
            <span>Name of Supplier: {{ $po->name_of_supplier }}</span>
          </div>

          <div class="col-md-4 border">
            <span>BUR No.: {{ $po->bur_no }}</span>
          </div>

          <div class="col-md-4 border">
            <span>Amount: {{ number_format($po->amount, 2) }}</span>
          </div>

        </div>

      </div>

    </div>

  </div>

</section>


@endsection