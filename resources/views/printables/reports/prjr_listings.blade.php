<!DOCTYPE html>
<html>
<head>
	<title>PR and JR Listings</title>
	<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

</head>
<body onload="window.print();" onafterprint="window.close()">

	<section class="invoice">

    {{-- HEADER --}}
    <div class="row" style="padding:10px;">
      <div class="col-xs-1"></div>
      <div class="col-xs-12">
        <div class="col-xs-1"></div>
        <div class="col-xs-3">
          <img src="{{ asset('favicon.ico') }}" style="width:100px;">
        </div>
        <div class="col-xs-8" style="text-align: center; padding-right:125px;">
          <span>Republic of the Philippines</span><br>
          <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span>North Avenue, Diliman, Quezon City</span><br>
          <span>Purchase Request and Job Request Listings</span><br>
          @if(Request::get('df') !== null && Request::get('dt') !== null)
            <span>As of {{ __dataType::date_scope(Request::get('df'), Request::get('dt')) }}</span><br>
          @endif
          @isset($dept_name)
            <span style="font-size:15px; font-weight:bold;">{{ $dept_name }}</span>
          @endif
        </div>
      </div>
      <div class="col-xs-1"></div>
    </div>

    
    <div class="row" style="padding-top:20px; font-size:10px;">
        <div class="col-xs-12 table-responsive">

            <h4>PURCHASE REQUESTS</h4>
            <table class="table table-bordered">

            <thead>
                <tr>
                    <th style="width:100px;">Date Encoded by Requisitioner</th>
                    <th>Items</th>
                    <th style="width:100px;">PR No.</th>
                    <th style="width:100px;">Date of PR No.</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pr_list as $pr_data)
                    <tr>
                        <td>{{ __dataType::date_parse($pr_data->created_at, 'm/d/Y') }}</td>
                        <td>
                            @foreach ($pr_data->prParameter as $key => $pr_param)
                                <span>{{ $key + 1 }}. {{ $pr_param->item_name }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ isset($pr_data->pr_no) ? $pr_data->pr_no : 'Not Set' }}</td>
                        <td>{{ isset($pr_data->pr_no) ? __dataType::date_parse($pr_data->updated_at, 'm/d/Y') : '' }}</td>
                    </tr>
                @endforeach
            </tbody>

            </table>

        </div>
    </div>

    
    <div class="row" style="padding-top:20px; font-size:10px;">
        <div class="col-xs-12 table-responsive">

            <h4>JOB REQUESTS</h4>

            <table class="table table-bordered table-sm">

            <thead>
                <tr>
                <th style="width:100px;">Date Encoded by Requisitioner</th>
                <th>Items</th>
                <th style="width:100px;">JR No.</th>
                <th style="width:100px;">Date of PR No.</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($jr_list as $jr_data)
                    <tr>
                        <td>{{ __dataType::date_parse($jr_data->created_at, 'm/d/Y') }}</td>
                        <td>
                            @foreach ($jr_data->jrParameter as $key => $jr_param)
                                <span>{{ $key + 1 }}. {{ $jr_param->item_name }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ isset($jr_data->jr_no) ? $jr_data->jr_no : 'Not Set' }}</td>
                        <td>{{ isset($jr_data->jr_no) ? __dataType::date_parse($jr_data->updated_at, 'm/d/Y') : '' }}</td>
                    </tr>
                @endforeach
            </tbody>

            </table>

        </div>
    </div>

  </section>

</body>
</html>