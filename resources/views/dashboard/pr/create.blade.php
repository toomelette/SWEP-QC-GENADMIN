@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">New Purchase Request</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.pr.store') }}">

        <div class="box-body">

          <div class="col-md-12">
                  
            @csrf

            {!! __form::select_dynamic(
              '6', 'dept_id', 'Department', Auth::user()->dept_id, $global_departments_all, 'dept_id', 'name', $errors->has('dept_id'), $errors->first('dept_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '6', 'div_id', 'Division', Auth::user()->div_id, $global_divisions_all, 'div_id', 'name', $errors->has('div_id'), $errors->first('div_id'), 'select2', ''
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
              '3', 'pr_no', 'text', 'PR No.', 'PR No.', old('pr_no'), $errors->has('pr_no'), $errors->first('pr_no'), ''
            ) !!}

            {!! __form::datepicker(
              '3', 'pr_date',  'PR Date', old('pr_date'), $errors->has('pr_date'), $errors->first('pr_date')
            ) !!}

            {!! __form::textbox(
              '3', 'sai_no', 'text', 'SAI No.', 'SAI No.', old('sai_no'), $errors->has('sai_no'), $errors->first('sai_no'), ''
            ) !!}

            {!! __form::datepicker(
              '3', 'sai_date',  'SAI Date', old('sai_date'), $errors->has('sai_date'), $errors->first('sai_date')
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
                      <th style="width:200px;">Qty</th>
                      <th style="width:200px;">Unit Cost</th>
                      <th style="width:200px;">Total Cost</th>
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
                                <textarea name="row[{{ $key }}][pp_description]" class="form-control" value="{{ $value['pp_description'] }}" rows="5">{{ $value['pp_description'] }}</textarea>
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_description') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_qty]" class="form-control" placeholder="Qty" value="{{ $value['pp_qty'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_qty') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_unit_cost]" class="form-control" placeholder="Unit Cost" value="{{ $value['pp_unit_cost'] }}">
                                <small class="text-danger">{{ $errors->first('row.'. $key .'.pp_unit_cost') }}</small>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[{{ $key }}][pp_total_cost]" class="form-control" placeholder="Total Cost" value="{{ $value['pp_total_cost'] }}">
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



            <div class="form-group col-md-12" style="margin-top:40px;">
              <label for="purpose">Purpose</label>
              <textarea name="purpose" class="form-control" value="{{ old('purpose') }}" rows="5">{{ old('purpose') }}</textarea>
              <small class="text-danger">{{ $errors->first('purpose') }}</small>
            </div>



            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'req_by_name', 'text', 'Requested By', 'Requested By', old('req_by_name'), $errors->has('req_by_name'), $errors->first('req_by_name'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'req_by_designation', 'text', 'Requested By (Designation)', 'Requested By (Designation)', old('req_by_designation'), $errors->has('req_by_designation'), $errors->first('req_by_designation'), ''
                  ) !!}
                    
                </div>
              </div>
            </div>



            <div class="col-md-6" style="margin-top:10px;">
              <div class="box box-solid" style="border:solid 1px;">
                <div class="box-body">

                  {!! __form::textbox(
                    '12', 'appr_by_name', 'text', 'Approved By', 'Approved By', old('appr_by_name'), $errors->has('appr_by_name'), $errors->first('appr_by_name'), ''
                  ) !!}

                  {!! __form::textbox(
                    '12', 'appr_by_designation', 'text', 'Approved By (Designation)', 'Approved By (Designation)', old('appr_by_designation'), $errors->has('appr_by_designation'), $errors->first('appr_by_designation'), ''
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

    @if(Session::has('PR_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('PR_CREATE_SUCCESS')) !!}
    @endif

    $(document).ready(function(){
      $("#dept_id").prop('disabled', true);
    });

    $(document).ready(function(){
      $("#div_id").prop('disabled', true);
    });


    {{-- ADD ROW --}}
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
                            '<textarea type="text" name="row[' + i + '][pp_description]" class="form-control" rows="5"></textarea>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_qty]" class="form-control" placeholder="Qty">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_unit_cost]" class="form-control" placeholder="Unit Cost">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][pp_total_cost]" class="form-control" placeholder="Total Cost">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';

        $("#table_body").append($(content));

      });
    });

  </script>
    
@endsection