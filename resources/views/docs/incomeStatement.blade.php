<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Income Statement</title>
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
        <div class="row">
            <div class="col-12">
                <div class="title text-center">
                    <h2>INCOME STATEMENT</h2>
                </div>
            </div>
        </div>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            
                            
                            
                        </div> <!-- end col -->
                        <div class="col-xs-6  float-right" style="float:right;text-align:right;">
                            <div class="mt-3 float-right">
                                <img src="" alt="DEMO LOGO" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!--<div class="title text-center">-->
                        <!--    <h4>Detailed Income Statement</h4>-->
                        <!--</div>-->
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                               
                              <tr style="padding-top:0px; padding-bottom:0px;">
                                <th style="padding-top:0px; padding-bottom:0px;">Date</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Member Name</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Description</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Reference</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Income Amount</th>
                              </tr>
                            </thead>
                            <tbody style="padding-top:0px; padding-bottom:0px;">
                                @foreach($entries as $entry)
                              <tr>
                                <th style="padding-top:0px; padding-bottom:0px;">{{$entry['date']}}</th>
                                <th style="padding-top:0px; padding-bottom:0px;">{{$entry['member_name']}}</th>
                                <td style="padding-top:0px; padding-bottom:0px;">{{$entry['description']}}</td>
                                <td style="padding-top:0px; padding-bottom:0px;">{{$entry['reference']}}</td>
                                
                               

                                @if($entry['paid_in'] === '-')
                                <td style="padding-top:0px; padding-bottom:0px;">
                                    {{$entry['paid_in']}}
                                </td>
                                @else 
                                <td style="padding-top:0px; padding-bottom:0px;">
                                    {{number_format($entry['paid_in'],2)}}
                                </td>
                                @endif
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                    <div class="col-12">
                        <!--<div class="title text-center">-->
                        <!--    <h4>Summary</h4>-->
                        <!--</div>-->
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                              <tr style="padding-top:0px; padding-bottom:0px;">
                                <td style="padding-top:0px; padding-bottom:0px;">Details</td>
                                <td style="padding-top:0px; padding-bottom:0px;" >Income</td>
                              </tr>
                            </thead>
                            <tbody style="padding-top:0px; padding-bottom:0px;">
                               
                                
                                
                               
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <td style="padding-top:0px; padding-bottom:0px;">Collections</td>
                                    <td style="padding-top:0px; padding-bottom:0px;">{{$payments}}</td>
                                </tr>
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <th style="padding-top:0px; padding-bottom:0px;">Total Income</th>
                                    <th style="padding-top:0px; padding-bottom:0px;">{{$payments}}</th>
                                </tr>
                                
                            </tbody>
                          </table>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->
</body>

</html>