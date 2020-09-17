<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Request</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">
    
    .arrow {
      position: absolute;
      overflow: hidden;
      display: inline-block;
      font-size: 3px;
      width: 3em;
      height: 3em;
      border-top: 2px solid black;
      border-right: 2px solid black ;
      transform: rotate(54deg) skew(20deg);
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper">

    {{-- HEADER --}}
    <div class="col-sm-12" style="margin-top:40px;">
      <center>
        <h5>PURCHASE REQUEST (PR)</h5>
        <span style="font-style:italic; font-size: 10px;">INSTRUCTIONS</span> 
      </center>
    </div>
    <div class="col-sm-12" style="margin-top:10px;"></div>


    {{-- LEFT CONTENT --}}
    <div class="col-sm-12" style="padding-right: 70px; padding-left: 70px; font-size: 10px;">
      
      <div class="row">


        {{-- A --}}
        <div class="col-sm-2">
          <span style="float:right;">A.</span>
        </div>

        <div class="col-sm-10">

          <p> This form shall be accomplished as follows;</p>

          <div class="row">

            {{-- A. 1 --}}
            <div class="col-sm-2">
              <span style="float:right;">1.</span>
            </div>
            <div class="col-sm-10">
              <p>Agency - Name of the Agency</p>
            </div>

            {{-- A. 2 --}}
            <div class="col-sm-2">
              <span style="float:right;">2.</span>
            </div>
            <div class="col-sm-10">
              <p>Department/Section - Name of the requesting office/section</p>
            </div>

            {{-- A. 3 --}}
            <div class="col-sm-2">
              <span style="float:right;">3.</span>
            </div>
            <div class="col-sm-10">
              <p>PR No. Date - number assigned and date the PR id prepared. It <br>
              shall be numbered as follows: <br></p>

              <u style="font-size:10px;">00</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">00</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">000</u>

              <div class="row">
                <div style="border-left: 2px solid; 
                            width: 95px; 
                            border-bottom: 2px solid; 
                            height: 60px; 
                            margin-left:18px;">
                  <div class="arrow" style="margin-top: 55px; margin-left: 85px;"></div>
                </div>

                <div style="border-left: 2px solid; 
                            width: 60px; 
                            border-bottom: 2px solid; 
                            height: 47px; 
                            margin-left:45px; 
                            margin-top:-60px;">
                  <div class="arrow" style="margin-top: 41px; margin-left: 50px;"></div>
                </div>

                <div style="border-left: 2px solid; 
                            width: 22px; 
                            border-bottom: 2px solid; 
                            height: 25px; 
                            margin-left:70px; 
                            margin-top:-47px;">
                  <div class="arrow" style="margin-top: 20px; margin-left: 12px;"></div>
                </div>

                <div class="row"> 
                  <p style="margin-left:145px; margin-top:-11px; font-size:10px;">
                    Serial number (one series each year)<br><br>
                    <span>Month</span><br>
                    <span>Year</span>
                  </p><br>
                </div>

              </div>

            </div>

            {{-- A. 4 --}}
            <div class="col-sm-2">
              <span style="float:right;">4.</span>
            </div>
            <div class="col-sm-10">
              <p>SAI No./Date - Number and date of the Supplier Availability</p>
            </div>

            {{-- A. 5 --}}
            <div class="col-sm-2">
              <span style="float:right;">5.</span>
            </div>
            <div class="col-sm-10">
              <p>Stock No. Stock no. based on the SAI</p>
            </div>

            {{-- A. 6 --}}
            <div class="col-sm-2">
              <span style="float:right;">6.</span>
            </div>
            <div class="col-sm-10">
              <p>Unit - Unit of measurement of goods/property requested(i.e Piece<br>
              roll box, ream etc.)</p>
            </div>

            {{-- A. 7 --}}
            <div class="col-sm-2">
              <span style="float:right;">7.</span>
            </div>
            <div class="col-sm-10">
              <p>Item Description - Brief description of the supplies/goods/property ordered</p>
            </div>

            {{-- A. 8 --}}
            <div class="col-sm-2">
              <span style="float:right;">8.</span>
            </div>
            <div class="col-sm-10">
              <p>Quantity - Quantity of goods/property/requested in the purchased.</p>
            </div>

            {{-- A. 9 --}}
            <div class="col-sm-2">
              <span style="float:right;">9.</span>
            </div>
            <div class="col-sm-10">
              <p>Unit Cost - The estimated cost per unit of the goods/property being<br>
              requested.</p>
            </div>

            {{-- A. 10 --}}
            <div class="col-sm-2">
              <span style="float:right;">10.</span>
            </div>
            <div class="col-sm-10">
              <p>Total Cost - estimated total cost of the goods/property being requested.</p>
            </div>

            {{-- A. 11 --}}
            <div class="col-sm-2">
              <span style="float:right;">11.</span>
            </div>
            <div class="col-sm-10">
              <p>Purpose - A brief explanation of the purpose why the goods/property<br>
              are being requested.</p>
            </div>

            {{-- A. 12 --}}
            <div class="col-sm-2">
              <span style="float:right;">12.</span>
            </div>
            <div class="col-sm-10">
              <p>Requested by - Name and signature of the person requesting the purchase of the items.</p>
            </div>

          </div>
        </div>



        {{-- B --}}
        <div class="col-sm-2">
          <span style="float:right;">B.</span>
        </div>
        <div class="col-sm-10">
          <p>This form shall be prepared if the goods/supplies/properties are not carried<br>
          in the stock based on the SAI received from the Accounting Unit.</p>
        </div>



        {{-- C --}}
        <div class="col-sm-2">
          <span style="float:right;">C.</span>
        </div>
        <div class="col-sm-10">
          <p>The PR shall be prepared in the two copies distributed as follows:<br>
          Original - Supply and Property Unit (SPU) for their appropriate action<br>
          Duplicate copy - Requesitioning Department/Office/Division File</p>
        </div>



        {{-- D --}}
        <div class="col-sm-2">
          <span style="float:right;">D.</span>
        </div>
        <div class="col-sm-10">
          <p>Based on the approved PR , the SPU shall process the procurement of the<br>
          Item requesitioned. </p>
        </div>



        {{-- E --}}
        <div class="col-sm-2">
          <span style="float:right;">E.</span>
        </div>
        <div class="col-sm-10">
          <p>After completion of the process, the SPU shall prepare the Purchase Order</p>
        </div>

      </div>
    </div>


  </div>
  
</body>

</html>
