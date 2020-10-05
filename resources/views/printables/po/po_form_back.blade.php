<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Order</title>

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
        <h5>PURCHASE ORDER (PO)</h5>
        <span style="font-style:italic; font-size: 10px;">INSTRUCTION</span> 
      </center>
    </div>
    <div class="col-sm-12" style="margin-top:10px;"></div>


    <div class="col-sm-12" style="padding-right: 70px; padding-left: 70px; font-size: 10px;">
      
      <div class="row">


        {{-- A --}}
        <div class="col-sm-2">
          <span style="float:right;">A.</span>
        </div>

        <div class="col-sm-10">

          <p> this form shall be accomplished as follows;</p>

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
              <p>Supplier/Address/TIN - name and address and TIN of the supplier</p>
            </div>

            {{-- A. 3 --}}
            <div class="col-sm-2">
              <span style="float:right;">3.</span>
            </div>
            <div class="col-sm-10">
              <p>P.O No. - the number assigned to the P.O. Whcih shall be as follows:</p>

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
                    Serial number (one series for each year)<br><br>
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
              <p>Date - date of the preparation of the P.O.</p>
            </div>

            {{-- A. 5 --}}
            <div class="col-sm-2">
              <span style="float:right;">5.</span>
            </div>
            <div class="col-sm-10">
              <p>
                Mode of Procurement mode of procurment such as public bidding, procurment<br>
                service, negotiated purchase, etc.
              </p>
            </div>

            {{-- A. 6 --}}
            <div class="col-sm-2">
              <span style="float:right;">6.</span>
            </div>
            <div class="col-sm-10">
              <p>Place/Date of delivery - place of delivery and definite date/s opf delivery, if stated<br>
              shall mean seven days (7) days after the receipt of the P.O. By the supplier.</p>
            </div>

            {{-- A. 7 --}}
            <div class="col-sm-2">
              <span style="float:right;">7.</span>
            </div>
            <div class="col-sm-10">
              <p>Delivery term delivery term i.e. FOB destination, FOB shipping point.</p>
            </div>

            {{-- A. 8 --}}
            <div class="col-sm-2">
              <span style="float:right;">8.</span>
            </div>
            <div class="col-sm-10">
              <p>
                Payment term specified period required when the delivered goods shall be paid.<br>
                and discounts allowed such as 2/10, 8/30
              </p>
            </div>

            {{-- A. 9 --}}
            <div class="col-sm-2">
              <span style="float:right;">9.</span>
            </div>
            <div class="col-sm-10">
              <p>
                Stock No. stock number of the goods to he purchased as provided by the supply and<br>
                property unit.
              </p>
            </div>

            {{-- A. 10 --}}
            <div class="col-sm-2">
              <span style="float:right;">10.</span>
            </div>
            <div class="col-sm-10">
              <p>Unit - unit of measurement of the supplies (i.e. Box, bottle, e.t.c.)</p>
            </div>

            {{-- A. 11 --}}
            <div class="col-sm-2">
              <span style="float:right;">11.</span>
            </div>
            <div class="col-sm-10">
              <p>Description brief description of the supplies/goods ordered.</p>
            </div>

            {{-- A. 12 --}}
            <div class="col-sm-2">
              <span style="float:right;">12.</span>
            </div>
            <div class="col-sm-10">
              <p>Quantity - quantity of goods ordered</p>
            </div>

            {{-- A. 13 --}}
            <div class="col-sm-2">
              <span style="float:right;">13.</span>
            </div>
            <div class="col-sm-10">
              <p>Unit cost - cost per unit of th esupplies/goods ordered.</p>
            </div>

            {{-- A. 14 --}}
            <div class="col-sm-2">
              <span style="float:right;">14.</span>
            </div>
            <div class="col-sm-10">
              <p>Amount total amount of thegoods ordered.</p>
            </div>

            {{-- A. 15 --}}
            <div class="col-sm-2">
              <span style="float:right;">15.</span>
            </div>
            <div class="col-sm-10">
              <p>
                Penalty clause - penalty imposed by the agency in case of non compliance with<br>
                the term.
              </p>
            </div>

            {{-- A. 16 --}}
            <div class="col-sm-2">
              <span style="float:right;">16.</span>
            </div>
            <div class="col-sm-10">
              <p>
                Conforme signature over printed of supplier or his representative signifying<br>
                his approval to the term set by the agency.
              </p>
            </div>

            {{-- A. 17 --}}
            <div class="col-sm-2">
              <span style="float:right;">17.</span>
            </div>
            <div class="col-sm-10">
              <p>Fund available - shall be signed by. the cheif accountant</p>
            </div>

            {{-- A. 18 --}}
            <div class="col-sm-2">
              <span style="float:right;">18.</span>
            </div>
            <div class="col-sm-10">
              <p>
                BUR (formerly ALOBS) No./Amount - The budget utilization request (BUR) number assigned
                by the Budget Unit and the amount. of the obligation supporting the purchase.
              </p>
            </div>

          </div>
        </div>



        {{-- B --}}
        <div class="col-sm-2">
          <span style="float:right;">B.</span>
        </div>
        <div class="col-sm-10">
          <p>It shall be prepared in Three (3) copies distributed as follows:<br>
            Original to the Supplier for conforme to the terms of the P.O.<br>
            and attachment to the DV upon request for payment<br>
            Duplicate Copy - retained by the Supply and Property Unit for file<br>
            Triplicate Copy - COA Auditor
          </p>
        </div>

      </div>
    </div>


  </div>
  
</body>

</html>
