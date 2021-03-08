@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit Purchase Order</h2>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.po.eu_index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.po.update', $po->slug) }}">

        <div class="box-body">

          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            <input type="hidden" name="type" value="EU">

            {!! __form::select_dynamic(
              '4', 'dept_id', 'Department *', old('dept_id') ? old('dept_id') : $po->dept_id, $global_departments_all, 'dept_id', 'name', $errors->has('dept_id'), $errors->first('dept_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'div_id', 'Division *', old('div_id') ? old('div_id') : $po->div_id, $global_divisions_all, 'div_id', 'name', $errors->has('div_id'), $errors->first('div_id'), 'select2', ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date',  'Date', old('date') ? old('date') : $po->date, $errors->has('date'), $errors->first('date')
            ) !!}


            <div class="col-md-12" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '6', 'to', 'text', 'To', 'To', old('to') ? old('to') : $po->to, $errors->has('to'), $errors->first('to'), ''
                  ) !!}

                  {!! __form::textbox(
                    '6', 'address', 'text', 'Address', 'Address', old('address') ? old('address') : $po->address, $errors->has('address'), $errors->first('address'), ''
                  ) !!}
                    
                  {!! __form::textbox(
                    '6', 'tin', 'text', 'TIN', 'TIN', old('tin') ? old('tin') : $po->tin, $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}

                  {!! __form::textbox(
                    '6', 'mode_of_procurement', 'text', 'Mode of Procurement', 'Mode of Procurement', old('mode_of_procurement') ? old('mode_of_procurement') : $po->mode_of_procurement, $errors->has('mode_of_procurement'), $errors->first('mode_of_procurement'), ''
                  ) !!}
                
                </div>
              </div>
            </div>


            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'place_of_delivery', 'text', 'Place of Delivery', 'Place of Delivery', old('place_of_delivery') ? old('place_of_delivery') : $po->place_of_delivery, $errors->has('place_of_delivery'), $errors->first('place_of_delivery'), ''
                  ) !!}

                  {!! __form::datepicker(
                    '12', 'date_of_delivery',  'Date of Delivery', old('date_of_delivery') ? old('date_of_delivery') : $po->date_of_delivery, $errors->has('date_of_delivery'), $errors->first('date_of_delivery')
                  ) !!}
                
                </div>
              </div>
            </div>


            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px; border-color:#A9A9A9;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'delivery_term', 'text', 'Delivery Term', 'Delivery Term', old('delivery_term') ? old('delivery_term') : $po->delivery_term, $errors->has('delivery_term'), $errors->first('delivery_term'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'payment_term', 'text', 'Payment Term', 'Delivery Term', old('payment_term') ? old('payment_term') : $po->payment_term, $errors->has('payment_term'), $errors->first('payment_term'), ''
                  ) !!}
                
                </div>
              </div>
            </div>


            {{-- Purchase Request Items --}}
            <div class="col-md-12" style="padding-top:40px;">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">ITEMS:</h3>
                  <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">
                    Add Item &nbsp;<i class="fa fw fa-plus"></i>
                  </button>
                </div>
                
                <div class="box-body no-padding">
                  
                  <table class="table table-bordered">

                    <tr>
                      <th style="width:120px;">Stock No.</th>
                      <th style="width:120px;">Unit</th>
                      <th>Item Description</th>
                      <th style="width:150px;">Qty</th>
                      <th style="width:150px;">Unit Cost</th>
                      <th style="width:150px;">Total Cost</th>
                      <th style="width: 40px"></th>
                    </tr>

                    <tbody id="table_body">

                      @if(old('row'))

                        @foreach(old('row') as $key => $value)

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_stock_no]" class="form-control" placeholder="Stock No." value="{{ $value['pp_stock_no'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_stock_no') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_unit]" class="form-control" placeholder="Unit" value="{{ $value['pp_unit'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_unit') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_item_name]" class="form-control" placeholder="Item Name" value="{{ $value['pp_item_name'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_item_name') }}</small>
                              </div>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][pp_item_description]" class="form-control" value="{{ $value['pp_item_description'] }}" rows="7">{{ $value['pp_item_description'] }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_item_description') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_qty]" class="form-control pp_qty" placeholder="Qty" value="{{ $value['pp_qty'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_qty') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_unit_cost]" class="form-control pp_unit_cost" placeholder="Unit Cost" value="{{ $value['pp_unit_cost'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_unit_cost') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_total_cost]" class="form-control pp_total_cost" placeholder="Total Cost" value="{{ $value['pp_total_cost'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_total_cost') }}</small>
                              </div>
                            </td>


                            <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red">
                                <i class="fa fa-times"></i>
                              </button>
                            </td>

                          </tr>

                        @endforeach

                      @else

                        @foreach ($po->poParameter as $key => $data)

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_stock_no]" class="form-control" placeholder="Stock No." value="{{ $data->stock_no }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_stock_no') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_unit]" class="form-control" placeholder="Unit" value="{{ $data->unit }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_unit') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_item_name]" class="form-control" placeholder="Item Name" value="{{ $data->item_name }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_item_name') }}</small>
                              </div>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][pp_item_description]" class="form-control" value="{!! $data->item_description !!}" rows="7">{{ str_replace('<br />', '', $data->item_description) }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_item_description') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_qty]" class="form-control pp_qty" placeholder="Qty" value="{{ $data->qty }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_qty') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_unit_cost]" class="form-control pp_unit_cost" placeholder="Unit Cost" value="{{ number_format($data->unit_cost, 3) }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_unit_cost') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_total_cost]" class="form-control pp_total_cost" placeholder="Total Cost" value="{{ number_format($data->total_cost, 3) }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_total_cost') }}</small>
                              </div>
                            </td>


                            <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red">
                                <i class="fa fa-times"></i>
                              </button>
                            </td>

                          </tr>

                        @endforeach

                      @endif

                    </tbody>
                  </table>
                 
                </div>

              </div>
            </div>


            {!! __form::textbox(
              '12', 'name_of_supplier', 'text', 'Name of Supplier', 'Name of Supplier', old('name_of_supplier') ? old('name_of_supplier') : $po->name_of_supplier, $errors->has('name_of_supplier'), $errors->first('name_of_supplier'), ''
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


    {{-- ADD ITEM --}}
    $(document).ready(function() {
      $("#add_row").on("click", function() {

        var i = $("#table_body").children().length;

        var content = '<tr>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_stock_no]" class="form-control" placeholder="Stock No.">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_unit]" class="form-control" placeholder="Unit">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_item_name]" class="form-control" placeholder="Item Name">' +
                          '</div>' +
                          '<div class="form-group">' +
                            '<textarea type="text" name="row[' + i + '][pp_item_description]" class="form-control" rows="7"></textarea>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_qty]" class="form-control pp_qty" placeholder="Qty">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_unit_cost]" class="form-control pp_unit_cost" placeholder="Unit Cost">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_total_cost]" class="form-control pp_total_cost" placeholder="Total Cost">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';

        $("#table_body").append($(content));
        
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

      });

    });


  </script>
    
@endsection

