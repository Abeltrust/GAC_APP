<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



  
    <style>
   
        .table{
            width: 100%;
            text-align: center
        }
        table, th,td{
            border: 1px solid #000 !important;
            border-collapse: collapse;
        }
        td{
            font-size: 12px;
        }
        th{
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div>
      
        <h4 style="font-size: 14px; text-align:center; line-height:0px;">Direct Deduction</h4>

        
    </div>

    {{-- <table class="table">
        <thead>
            <tr style="background-color: #f3f0f0eb;">
                <th width="5%">S/N</th>
                <th width="5%">PSN</th>
                <th width="15%">Name</th>
                <th>Dept.</th>
                <th>Admin Charges </th>
                <th>Leavy</th>
                <th>Shares</th>
                <th>Savings</th>
                <th>Christmas Loan</th>
                <th>Essential Comm.</th>
                <th>Main Loan Deduction</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            @php
                $no=1;
            @endphp

            @foreach ($data as $key=>$item )
                @php
                $total=0;
            @endphp

                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->psn }}</td>
                    <td style="text-transform: capitalize; text-align:left; padding-left:5px;">{{ $item->title  }} {{ $item->firstname  }} {{ $item->lastname  }} {{ $item->middlename  }}</td>
                    <td style="text-overflow: ellipsis !important;">{{ $item->department }}</td>


                            @if ( $item->monthly_charges->isEmpty())
                                    <td>-</td>
                                    <td>-</td>
                            @else

                                @foreach ($item->monthly_charges as $val)
                                    @php
                                        $total=$total+$val->charges+$val->leavy;
                                    @endphp
                                    <td>{{  number_format($val->charges,2)}}</td>
                                    <td>{{  number_format($val->leavy,2) }}</td>
                                @endforeach
                            @endif

                            @if ($item->sharedbasehistory->isEmpty())
                                <td>-</td>
                            @else

                                    @foreach ($item->sharedbasehistory as $val)
                                        @php
                                            $total=$total+ $val->amount;
                                        @endphp
                                        <td>{{  number_format($val->amount,2) }}</td>
                                    @endforeach

                            @endif

                            @if ($item->savingshistory->isEmpty())
                                <td>-</td>
                            @else

                                    @foreach ($item->savingshistory as $val)
                                    @php
                                        $total=$total+ $val->amount;
                                    @endphp
                                        <td>{{  number_format($val->amount,2) }}</td>
                                    @endforeach

                            @endif







                            @if ( $item->deductionhistory->isEmpty())
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                            @else

                            @php
                                $christmas=0;
                                $mainloan=0;
                                $commodity=0;
                            @endphp
                                        @foreach ($item->deductionhistory as $val )
                                            @if ($val->loan_type_id!='Null' && $val->application_id!='Null')


                                            @if ($val->loan_type->name =='Main Loan' || $val->loan_type->name =='main Loan' || $val->loan_type->name =='Main loan' || $val->loan_type->name =='main loan' ||  $val->loan_type->name =='main' ||  $val->loan_type->name =='Main')
                                                    @php
                                                        $mainloan= $val->amount;
                                                        $total=$total+$mainloan;
                                                    @endphp
                                                  
                                            @elseif($val->loan_type->name =='Commodity Loan' || $val->loan_type->name =='commodity Loan' || $val->loan_type->name =='Commodity loan' || $val->loan_type->name =='commodity loan' || $val->loan_type->name =='commodity' || $val->loan_type->name =='Commodity')
                                                   
                                                    @php
                                                            $commodity= $val->amount;
                                                            $total=$total+$commodity;
                                                    @endphp

                                            @elseif($val->loan_type->name =='Christmas & Easter Loan' || $val->loan_type->name =='christmas & Easter Loan' || $val->loan_type->name =='Christmas & easter Loan' || $val->loan_type->name =='Christmas & Easter loan' || $val->loan_type->name =='christmas & easter loan' || $val->loan_type->name =='Christmas & Easter' || $val->loan_type->name =='christmas & easter')
                                               
                                                    @php
                                                        $christmas= $val->amount;
                                                        $total=$total+$christmas;
                                                    @endphp
                                            @else

                                         
                                            @endif

                                            @endif
                                              
                                        @endforeach

                                        @if($christmas !=0)
                                        <td>{{ number_format($christmas,2) }}</td>
                                        @elseif($christmas ==0)
                                        <td>-</td>
                                        @endif
                                        @if($commodity !=0)
                                        <td>{{ number_format($commodity,2) }}</td>
                                        @elseif($commodity ==0)
                                        <td>-</td>
                                        @endif
                                        @if($mainloan !=0)
                                        <td>{{  number_format($mainloan,2)}}</td>

                                        @elseif($mainloan ==0)
                                        <td>-</td>
                                        @endif



                            @endif

                    <td>{{  number_format($total,2) }}</td>
                 
                </tr>
              
            @endforeach




        </tbody>
    </table> --}}


    <div id="invoice-POS">
    
        <center id="top">
          <div class="logo">
             <img src="{{ asset('assets/home/logo.png') }}" style="width:15%;">
          </div>
          <div class="info"> 
            <h2>NBA Ikeja Branch</h2>
          </div><!--End Info-->
        </center><!--End InvoiceTop-->
        
       
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                {{-- <tr class="tabletitle">
                                    <td class="item"><h2>Item</h2></td>
                            
                                    <td class="Rate"><h2>Sub Total</h2></td>
                                </tr> --}}
    
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">SCN</p></td>
                                    <td class="tableitem"><p class="itemtext">$375.00</p></td>
                                </tr>
    
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">Year of Call</p></td>
                                    <td class="tableitem"><p class="itemtext">3</p></td>
                                </tr>
    
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">Amount</p></td>
                                    <td class="tableitem"><p class="itemtext">5</p></td>
                                </tr>
    
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">Transaction Date</p></td>
                                    <td class="tableitem"><p class="itemtext">20</p></td>
                                </tr>
    
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">Transaction ID</p></td>
                                    <td class="tableitem"><p class="itemtext">10</p></td>
                                </tr>
    
                            </table>
                        </div><!--End Table-->
    
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
    
</body>
</html>
