@push('styles')
    <style>
        body {
            background: #eee;
            margin-top: 20px;
        }

        .text-danger strong {
            color: #9f181c;
        }

        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: open sans;
        }

        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }

        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }

        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }

        .receipt-main thead {
            background: #414143 none repeat scroll 0 0;
        }

        .receipt-main thead th {
            color: #fff;
        }

        .receipt-right h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 7px 0;
        }

        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }

        .receipt-right p i {
            text-align: center;
            width: 18px;
        }

        .receipt-main td {
            padding: 9px 20px !important;
        }

        .receipt-main th {
            padding: 13px 20px !important;
        }

        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }

        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }

        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }

        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            text-align: right;
            text-transform: uppercase;
        }

        .receipt-header-mid {
            margin: 24px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }
    </style>
@endpush

<div class="">
    <div class="col-md-12">
        <div class="row ">
            <div class="receipt-main col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="receipt-header">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="iamgurdeeposahan"
                                    src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                    style="width: 71px; border-radius: 43px;">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <div class="receipt-right">
                                <h5>Company Name.</h5>
                                <p>+1 3649-6589 <i class="fa fa-phone"></i></p>
                                <p>company@gmail.com <i class="fa fa-envelope-o"></i></p>
                                <p>USA <i class="fa fa-location-arrow"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <h5>Customer Name </h5>
                                <p><b>Mobile :</b> +1 12345-4569</p>
                                <p><b>Email :</b> customer@gmail.com</p>
                                <p><b>Address :</b> New York, USA</p>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h3>INVOICE # 102</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $discount = 0;
                            @endphp
                            @foreach ($produks->item as $list)
                                @php
                                    $subtotal = $list->qty * $list->produk->margin;
                                    $disc = (($list->produk->discount * $list->produk->margin) / 100) * $list->qty;
                                    $discount += $disc;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="col-md-9">{{ $list->produk->produk }}</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> {{ number_format($subtotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            @php
                                $tax = $total * 0.11;
                                $payable = $total + $tax - $discount;
                            @endphp
                            <tr>
                                <td class="text-right"><strong>Total Amount: </strong></td>
                                <td><i class="fa fa-inr"></i> {{ number_format($total, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>Discount: </strong></td>
                                <td><i class="fa fa-inr"></i> {{ number_format($discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><strong>PPN 11%: </strong></td>
                                <td><i class="fa fa-inr"></i> {{ number_format($tax, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">
                                    <h2><strong>Total: </strong></h2>
                                </td>
                                <td class="text-left text-danger">
                                    <h2><strong><i class="fa fa-inr"></i> {{ number_format($payable, 2) }}</strong></h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <p><b>Date :</b> {{ date('d M Y') }}</p>
                                <h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h1>Stamp</h1>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener("load", window.print());
    </script>
@endpush
