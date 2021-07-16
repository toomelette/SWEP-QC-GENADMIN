<!DOCTYPE html>
<html>
<head>
	<title>Purchase Request List</title>
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
          <img src="{{ asset('favicon.ico') }}" style="width:120px;">
        </div>

        <div class="col-xs-8" style="text-align: center; padding-right:125px;">
          <span>Republic of the Philippines</span><br>
          <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span>North Avenue, Diliman, Quezon City</span><br>
          <span>Purchase Order Listings</span><br>
          @if(Request::get('df') !== null && Request::get('dt') !== null)
            <span>As of {{ __dataType::date_scope(Request::get('df'), Request::get('dt')) }}</span>
          @endif
        </div>

      </div>

      <div class="col-xs-1"></div>

    </div>


    <div class="row" style="padding-top:20px; font-size:11px;">
      <div class="col-xs-12 table-responsive">

        <table class="table table-bordered">

          <thead>
            <tr>
              <th>PR No.</th>
              <th>Division</th>
              <th>Date Encoded</th>
              <th>Date Set PR No.</th>
            </tr>
          </thead>


          <tbody>
            @foreach ($pr_list as $data)
              <tr>
                <td>{{ $data->pr_no }}</td>
                <td>{{ $data->div_id != '' || $data->div_id != null ? $data->division->name : $data->department->name }}</td>
                <td>{{ $data->created_at->format('F d, Y') }}</td>
                <td>{{ $data->updated_at->format('F d, Y') }}</td>
              </tr>
            @endforeach
          </tbody>

        </table>

      </div>
    </div>

  </section>

</body>
</html>