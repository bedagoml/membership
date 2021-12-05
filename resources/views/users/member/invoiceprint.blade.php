<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoice | Download</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- <link href=" {{ asset('assets/css/invoice_bootstrap.min.css') }} " rel="stylesheet" type="text/css" /> --}}
    <link href=" {{ asset('assets/css/invoice_style.css') }} " rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <!-- Logo & title -->
                                <div class="clearfix">
                                    <div class="float-left">
                                         <img src="{{URL::asset('assets/assets/images/brand/logo2.png')}}" alt="Rotary Logo" height="100">
                                    </div>
                                    <div class="float-right">
                                        {{-- <h3 class="m-0 d-print-none">Invoice</h3> --}}
                                    </div>
                                </div>

                               	<!-- Row-->
						<div class="row">
							<div class="col-md-12">
							    @include('includes.messages')
								<div class="card overflow-hidden">
									<div class="card-status bg-primary"></div>
									<div class="card-body">
										<h2 class="text-muted font-weight-bold">INVOICE</h2>
										<!--<div class="">-->
										<!--	<h5 class="mb-1">Hi <strong>Jessica Allen</strong>,</h5>-->
										<!--	This is the receipt for a payment of <strong>$450.00</strong> (USD) for your works-->
										<!--</div>-->

										<div class="card-body pl-0 pr-0">
											<div class="row">
												<div class="col-sm-6">
													<span>Invoice No.</span><br>
													<strong>INV #{{ $invoice->id}}</strong>
												</div>
												<div class="col-sm-6 text-right">
													<span>Generated Date</span><br>
													<strong>{{$invoice->created_at }}</strong>
												</div>
											</div>
										</div>
										<div class="dropdown-divider"></div>
										<div class="row pt-4">
											<div class="col-lg-6 ">
												<p class="h5 font-weight-bold">Billing Details</p>
												<address>
                              
                             
                                Status:
                                    @if ($invoice->is_paid===1)
                                    <span class="text-success font-weight-bold"> PAID </span>
                                    @elseif ($invoice->is_paid===0 && $invoice->paid_in > 0 )
                                    <span class="text-warning font-weight-bold"> PARTIAL PAYMENT</span>
                                    @else
                                    <span class="text-danger font-weight-bold"> UNPAID </span>
                                    @endif

												</address>
											</div>
											<div class="col-lg-6 text-right">
												<p class="h5 font-weight-bold">Invoice To</p>
												 <address>
                                        Name: @if($invoice->tenant_id > 0)
                                              {{ $invoice->tenant->full_name}}
                                              @else
                                              {{ $invoice->tenant_name}}
                                              @endif <br>
                                             
                                      
                                       
                                        Phone Number: @if($invoice->tenant_id > 0)
                                              +{{ $invoice->tenant->phone}}
                                              @elseif ($invoice->tenant_phone > 0)
                                              +{{ $invoice->tenant_phone}}
                                              @else
                                              <span class="text-danger "> NO PHONE </span>
                                              @endif<br>
                                        Account Number: @if($invoice->tenant_id > 0)
                                              {{ $invoice->tenant->account_number}}
                                              @else
                                             <span class="text-danger "> NO ACCOUNT NUMBER </span>
                                              @endif<br>
                                        
                                    </address>
											</div>
										</div>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover text-nowrap">
											    
												<tr>
                                   
                                    <th class="d-none d-sm-table-cell">DESCRIPTION</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                                @if($invoice->type == 'annual_subscription' || $invoice->type == 'First Annual Subscription' || $invoice->type == null)
                                @if($invoice->amount > 0)
                                <tr>
                              
                                   <td class="d-none d-sm-table-cell"> Subscription Amount - {{$invoice->description}} </td>
                                    <td class="text-right">Ksh {{ number_format($invoice->amount)}}</td>
                                </tr>
                                @endif
                               
                                @if($invoice->carryforward > 0)
                                <tr>
                                
                                   
                                    <td class="d-none d-sm-table-cell"> Arrears </td>
                                    <td class="text-right">Ksh {{ number_format($invoice->carryforward)}}</td>
                                </tr>
                                @endif
                               
                                
                                @else
                                <tr>
                                   
                                     @if($invoice->type === 'donation')
                                    <td class="d-none d-sm-table-cell">Donation Amount</td>
                                    @elseif($invoice->type === 'foundation')
                                    <td class="d-none d-sm-table-cell">Foundation Fee</td>
                                     @else
                                     <td class="d-none d-sm-table-cell">Others - {{$invoice->description}}</td>
                                      @endif
                                    <td class="text-right">Ksh {{ number_format($invoice->total_payable)}}</td>
                                </tr>
                                 @endif
                                

                                @php
                                $count=3;
                                @endphp

                               
												
												
											
											
                                
                                                <tr>
                                                   	<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Sub Total</td>
                                                    <td class="text-right">Ksh
                                                        {{ number_format($invoice->total_payable )  }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                   	<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Total Paid</td>
                                                    <td class="text-right text-success text-bold">Ksh
                                                        {{ number_format($invoice->paid_in )  }}
                                                    </td>
                                                </tr>
                                                
                                                    
                                                <!--    <tr>-->
                                                <!--    <th>To pay:</th>-->
                                                <!--    <td class="text-right">Ksh {{ number_format($invoice->total_payable- $invoice->paid_in ) }} -->
                                                <!--    </td>-->
                                                <!--</tr>-->
                                                
                                             <tr>
													<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Total Due</td>
													<td class="text-right text-danger text-bold">Ksh {{number_format($invoice->balance)}}</td>
												</tr>
                                    			
												
											</table>
										</div>
										<h5>Other information</h5>
                            <p class="text-muted"><br>
                                The invoiced member has a balance of <strong>Ksh {{number_format($invoice->balance )}}</strong> on this invoice<br />
                                </p>
									</div>
								</div>
							</div>
						</div>
						<!-- End row-->

					</div>
				</div><!-- end app-content-->
			</div>    <!-- END wrapper -->
</body>

</html>