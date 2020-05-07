@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Update Medical Record</h2>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
          &nbsp;
          {!! __html::back_button(['dashboard.emp_med_record.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.emp_med_record.update', $emp->slug) }}">

        <div class="box-body">

          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf    

            <div class="col-md-12">
              <span>Employee No. : {{ $emp->emp_no }}</span> 
            </div>

            <div class="col-md-12">
              <span>Fullname : {{ $emp->fullname() }}</span> 
            </div>

            <div class="col-md-3">
              <span>Birthday : {{ $emp->birthday->format('F d, Y') }}</span> 
            </div>

            <div class="col-md-3">
              <span>Age : {{ $emp->birthday->age }}</span> 
            </div>

            <div class="col-md-3">
              <span>Sex : {{ $emp->sex }}</span> 
            </div>

            <div class="col-md-3">
              <span>Civil Status : {{ $emp->civil_status }}</span> 
            </div>

            <div class="col-md-3">
              <span>Height : {{ $emp->height }}</span> 
            </div>

            <div class="col-md-3">
              <span>Weight : {{ $emp->weight }}</span> 
            </div>

            <div class="col-md-6"></div>

            <div class="col-md-12">
              <span>Position : {{ $emp->position }}</span>
            </div>

            <div class="col-md-12">
              <span>First day in Office : {{ $emp->firstday->format('F d, Y') }}</span>
            </div>

          </div>

        </div>



        {{-- USER MENU DYNAMIC TABLE GRID --}}
          {{-- <div class="col-md-12" style="padding-top:10px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Submenus:</h3>
                <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
              </div>
              
              <div class="box-body no-padding">
                
                <table class="table table-bordered">

                  <tr>
                    <th>Submenu ID *</th>
                    <th>Name *</th>
                    <th>Nav Name</th>
                    <th>Route *</th>
                    <th>Is Nav *</th>
                    <th style="width: 40px"></th>
                  </tr>

                  <tbody id="table_body">


                    @if(old('row'))

                      @foreach(old('row') as $key => $value)

                        <tr>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_submenu_id]" class="form-control" placeholder="Submenu ID" value="{{ $value['sub_submenu_id'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_submenu_id') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_name]" class="form-control" placeholder="Name" value="{{ $value['sub_name'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_name') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_nav_name]" class="form-control" placeholder="Nav Name" value="{{ $value['sub_nav_name'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_nav_name') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <input type="text" name="row[{{ $key }}][sub_route]" class="form-control" placeholder="Route" value="{{ $value['sub_route'] }}">
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_route') }}</small>
                            </div>
                          </td>


                          <td>
                            <div class="form-group">
                              <select name="row[{{ $key }}][sub_is_nav]" class="form-control">
                                <option value="">Select</option>
                                  <option value="true" {!! $value['sub_is_nav'] == "true" ? 'selected' : '' !!}>1</option>
                                  <option value="false" {!! $value['sub_is_nav'] == "false" ? 'selected' : '' !!}>0</option>
                              </select>
                              <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_is_nav') }}</small>
                            </div>
                          </td>


                          <td>
                              <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                          </td>

                        </tr>

                      @endforeach


                  @else


                    @foreach($menu->submenu as $key => $value)

                      <tr>

                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][sub_submenu_id]" class="form-control" placeholder="Submenu ID" value="{{ $value->submenu_id }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_submenu_id') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][sub_name]" class="form-control" placeholder="Name" value="{{ $value->name }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_name') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][sub_nav_name]" class="form-control" placeholder="Nav Name" value="{{ $value->nav_name }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_nav_name') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][sub_route]" class="form-control" placeholder="Route" value="{{ $value->route }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_route') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <select name="row[{{ $key }}][sub_is_nav]" class="form-control">
                              <option value="">Select</option>
                                <option value="true" {!! __dataType::boolean_to_string($value->is_nav) == "true" ? 'selected' : '' !!}>1</option>
                                <option value="false" {!! __dataType::boolean_to_string($value->is_nav) == "false" ? 'selected' : '' !!}>0</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.sub_is_nav') }}</small>
                          </div>
                        </td>


                        <td>
                            <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                        </td>

                      </tr>

                    @endforeach

                    @endif

                    </tbody>
                </table>
               
              </div>

            </div>
          </div> --}}



        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection



@section('scripts')

  <script type="text/javascript">

    {{-- ADD ROW --}}
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_submenu_id]" class="form-control" placeholder="Submenu ID">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_name]" class="form-control" placeholder="Name">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_nav_name]" class="form-control" placeholder="Nav Name">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][sub_route]" class="form-control" placeholder="Route">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<select name="row[' + i + '][sub_is_nav]" class="form-control">' +
                              '<option value="">Select</option>' +
                              '<option value="true">1</option>' +
                              '<option value="false">0</option>' +
                            '</select>' +
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

