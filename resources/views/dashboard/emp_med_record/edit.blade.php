<?php
  $old_med_history = old('row_med_history');
?>

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



          {{-- Medical History --}}
          <div class="col-md-12" style="padding-top:30px;">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3>Medical History</h3>
              </div>
              
              <div class="box-body no-padding">

                @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Please fill up required fields.
                  </div>
                @endif
                
                <table class="table table-bordered">
                  
                  <thead>
                    <td style="width:320px;">Name</td>
                    <td style="width:50px; text-align: center;">Yes</td>
                    <td style="width:50px; text-align: center;">No</td>
                    <td style="width:400px;">Medication</td>
                    <td>Specify / Other Information</td>
                  </thead>
                  
                  <tbody id="table_body">

                    @foreach ($global_med_history_all as $key => $data)

                      <?php

                        $error_style = "";

                        $selected_yes = "";
                        $selected_no = "";
                        $medication = "";
                        $other_info = "";

                        if($errors->first('row_med_history.'. $key .'.status') || 
                          $errors->first('row_med_history.'. $key .'.medication') ||  
                          $errors->first('row_med_history.'. $key .'.other_info')){

                          $error_style = "background-color:#fae3e3;";

                        }

                        if(old('row_med_history')){
                          
                          if (isset($old_med_history[$key]['status'])) {
                            if ($old_med_history[$key]['status'] == 'true') {
                              $selected_yes = "checked";
                            }elseif($old_med_history[$key]['status'] == 'false'){
                              $selected_no = "checked";
                            }
                          }
                            
                          if (isset($old_med_history[$key]['medication'])) {
                            $medication = $old_med_history[$key]['medication'];
                          }
                            
                          if (isset($old_med_history[$key]['other_info'])) {
                            $other_info = $old_med_history[$key]['other_info'];
                          }

                        }

                      ?>
                      
                      <input type="hidden" name="row_med_history[{{ $key }}][med_history_id]" value="{{ $data->med_history_id }}">

                      <tr style="{!! $error_style !!}">

                        <td id="mid-vert">
                          {{ $data->seq_no }}. {{ $data->name }}
                        </td>

                        <td id="mid-vert" style="text-align: center;">
                          <input type="checkbox" class="minimal" name="row_med_history[{{ $key }}][status]" value="true" {!! $selected_yes !!}>
                        </td>

                        <td id="mid-vert" style="text-align: center;">
                          <input type="checkbox" class="minimal" name="row_med_history[{{ $key }}][status]" value="false" {!! $selected_no !!}>
                        </td>

                        <td id="mid-vert">
                          <textarea name="row_med_history[{{ $key }}][medication]" class="form-control" placeholder="Medication">{!! $medication !!}</textarea>
                        </td>

                        <td id="mid-vert">
                          <textarea name="row_med_history[{{ $key }}][other_info]" class="form-control" placeholder="Specify / Other Information">{!! $other_info !!}</textarea>
                        </td>

                      </tr>
                      
                    @endforeach

                  </tbody>

                </table>
               
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

  </script>
    
@endsection

