@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Job Order</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.jo.eu_index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.jo.update', $jo->slug) }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf

            <input name="_method" value="PUT" type="hidden">
            
            <input type="hidden" name="type" value="EU">

            {!! __form::select_dynamic(
              '4', 'dept_id', 'Department *', old('dept_id') ? old('dept_id') : $jo->dept_id, $global_departments_all, 'dept_id', 'name', $errors->has('dept_id'), $errors->first('dept_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'div_id', 'Division *', old('div_id') ? old('div_id') : $jo->div_id, $global_divisions_all, 'div_id', 'name', $errors->has('div_id'), $errors->first('div_id'), 'select2', ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date',  'Date', old('date') ? old('date') : $jo->date, $errors->has('date'), $errors->first('date')
            ) !!}


            <div class="col-md-12" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'to', 'text', 'To', 'To', old('to') ? old('to') : $jo->to, $errors->has('to'), $errors->first('to'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'address', 'text', 'Address', 'Address', old('address') ? old('address') : $jo->address, $errors->has('address'), $errors->first('address'), ''
                  ) !!}
                    
                  {!! __form::textbox(
                    '12', 'tin', 'text', 'TIN', 'TIN', old('tin') ? old('tin') : $jo->tin, $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}
                
                </div>
              </div>
            </div>


            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'place_of_delivery', 'text', 'Place of Delivery', 'Place of Delivery', old('place_of_delivery') ? old('place_of_delivery') : $jo->place_of_delivery, $errors->has('place_of_delivery'), $errors->first('place_of_delivery'), ''
                  ) !!}

                  {!! __form::datepicker(
                    '12', 'date_of_delivery',  'Date of Delivery', old('date_of_delivery') ? old('date_of_delivery') : $jo->date_of_delivery, $errors->has('date_of_delivery'), $errors->first('date_of_delivery')
                  ) !!}
                
                </div>
              </div>
            </div>


            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'delivery_term', 'text', 'Delivery Term', 'Delivery Term', old('delivery_term') ? old('delivery_term') : $jo->delivery_term, $errors->has('delivery_term'), $errors->first('delivery_term'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'payment_term', 'text', 'Payment Term', 'Delivery Term', old('payment_term') ? old('payment_term') : $jo->payment_term, $errors->has('payment_term'), $errors->first('payment_term'), ''
                  ) !!}
                
                </div>
              </div>
            </div>

            {!! __form::textbox(
              '12', 'description', 'text', 'Description', 'Description', old('description') ? old('description') : $jo->description, $errors->has('description'), $errors->first('description'), ''
            ) !!}

            {!! __form::textarea(
              '12', 'scope_of_works', 'Scope of Works', old('scope_of_works') ? old('scope_of_works') : $jo->scope_of_works, $errors->has('scope_of_works'), $errors->first('scope_of_works'), ''
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
              '12', 'amount', 'text', 'Amount', 'Amount', old('amount') ? old('amount') : number_format($jo->amount, 2), $errors->has('amount'), $errors->first('amount'), ''
            ) !!}
                        
            
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
  
    @if(Session::has('JO_CREATE_SUCCESS'))
      $('#jo_create').modal('show');
    @endif

    $(function () {
      CKEDITOR.replace('editor');
    });
        
    $('#amount').priceFormat({
        centsLimit: 2,
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: false
    });
        
    $('.pp_qty').priceFormat({
        centsLimit: 0,
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: false
    });
    
    $('.pp_unit_cost').priceFormat({
        centsLimit: 2,
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: false
    });
    
    $('.pp_total_cost').priceFormat({
        centsLimit: 2,
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: false
    });


  </script>
    
@endsection