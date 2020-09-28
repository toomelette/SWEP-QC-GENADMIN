@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit Job Request</h2>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.jr.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.jr.update', $jr->slug) }}">

        <div class="box-body">

          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            {!! __form::textbox(
              '6', 'jr_no', 'text', 'PR No.', 'PR No.', old('jr_no') ? old('jr_no') : $jr->jr_no, $errors->has('jr_no'), $errors->first('jr_no'), ''
            ) !!}

            {!! __form::datepicker(
              '6', 'date',  'Date', old('date') ? old('date') : $jr->date, $errors->has('date'), $errors->first('date')
            ) !!}



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
                      <th style="width:400px;">Nature of Work</th>
                      <th style="width: 40px"></th>
                    </tr>

                    <tbody id="table_body">

                      @if(old('row'))

                        @foreach(old('row') as $key => $value)

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_stock_no]" class="form-control" placeholder="Stock No." value="{{ $value['jp_stock_no'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_stock_no') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_unit]" class="form-control" placeholder="Unit" value="{{ $value['jp_unit'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_unit') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_item_name]" class="form-control" placeholder="Item Name" value="{{ $value['jp_item_name'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_item_name') }}</small>
                              </div>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][jp_item_description]" class="form-control" value="{{ $value['jp_item_description'] }}" rows="7">{{ $value['jp_item_description'] }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_item_description') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_qty]" class="form-control jp_qty" placeholder="Qty" value="{{ $value['jp_qty'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_qty') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][jp_nature_of_work]" class="form-control" value="{{ $value['jp_nature_of_work'] }}" rows="9">{{ $value['jp_nature_of_work'] }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_nature_of_work') }}</small>
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

                        @foreach ($jr->jrParameter as $key => $data)

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_stock_no]" class="form-control" placeholder="Stock No." value="{{ $data->stock_no }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_stock_no') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_unit]" class="form-control" placeholder="Unit" value="{{ $data->unit }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_unit') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_item_name]" class="form-control" placeholder="Item Name" value="{{ $data->item_name }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_item_name') }}</small>
                              </div>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][jp_item_description]" class="form-control" value="{!! $data->item_description !!}" rows="7">{{ str_replace('<br />', '', $data->item_description) }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_item_description') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][jp_qty]" class="form-control jp_qty" placeholder="Qty" value="{{ $data->qty }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_qty') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <textarea name="row[{{ $key }}][jp_nature_of_work]" class="form-control" value="{!! $data->nature_of_work !!}" rows="9">{{ str_replace('<br />', '', $data->nature_of_work) }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.jp_nature_of_work') }}</small>
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



            <div class="form-group col-md-12" style="margin-top:40px;">
              <label for="purpose">Purpose:</label>
              <textarea name="purpose" class="form-control" value="{{ old('purpose') ? old('purpose') : $jr->purpose }}" rows="7">{{ old('purpose') ? old('purpose') : str_replace('<br />', '', $jr->purpose) }}</textarea>
              <small class="text-danger">{{ $errors->first('purpose') }}</small>
            </div>



            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'req_by_name', 'text', 'Requested By', 'Requested By', old('req_by_name') ? old('req_by_name') : $jr->req_by_name, $errors->has('req_by_name'), $errors->first('req_by_name'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'req_by_designation', 'text', 'Requested By (Designation)', 'Requested By (Designation)', old('req_by_designation') ? old('req_by_designation') : $jr->req_by_designation, $errors->has('req_by_designation'), $errors->first('req_by_designation'), ''
                  ) !!}
                    
                </div>
              </div>
            </div>



            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'appr_by_name', 'text', 'Approved By', 'Approved By', old('appr_by_name') ? old('appr_by_name') : $jr->appr_by_name, $errors->has('appr_by_name'), $errors->first('appr_by_name'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'appr_by_designation', 'text', 'Approved By (Designation)', 'Approved By (Designation)', old('appr_by_designation') ? old('appr_by_designation') : $jr->appr_by_designation, $errors->has('appr_by_designation'), $errors->first('appr_by_designation'), ''
                  ) !!}
                    
                </div>
              </div>
            </div>


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

    $('.jp_qty').priceFormat({
        centsLimit: 0,
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
                            '<input type="text" name="row[' + i + '][jp_stock_no]" class="form-control" placeholder="Stock No.">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][jp_unit]" class="form-control" placeholder="Unit">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][jp_item_name]" class="form-control" placeholder="Item Name">' +
                          '</div>' +
                          '<div class="form-group">' +
                            '<textarea type="text" name="row[' + i + '][jp_item_description]" class="form-control" rows="7"></textarea>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][jp_qty]" class="form-control jp_qty" placeholder="Qty">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<textarea type="text" name="row[' + i + '][jp_nature_of_work]" class="form-control" rows="9"></textarea>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';

        $("#table_body").append($(content));
        
        $('.jp_qty').priceFormat({
            centsLimit: 0,
            prefix: "",
            thousandsSeparator: ",",
            clearOnEmpty: true,
            allowNegative: false
        });

      });

    });


  </script>
    
@endsection

