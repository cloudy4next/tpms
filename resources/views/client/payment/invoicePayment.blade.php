<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Practice Management</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/dashboard/')}}/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap.min.css">
    <!-- Plugin -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/selectjs/')}}/select2.min.css">
    <!-- Style CSS -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/typography.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/responsive.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/custom.css">

</head>

<body class="sidebar-main-menu">
<!-- Preloader  -->
<div id="loading"></div>
<section class="bg-primary p-3 mb-5">
    <div class="container">
        <div class="d-flex">
            <div class="pr-3 mr-3 border-right">
                <img src="{{asset('assets/dashboard/')}}/images/logo-new.png" class="img-fluid mt-3" width="200" alt="">
            </div>
            <div class="mr-3 flex-fill">
                <h2 class="text-white">{{$name_location->facility_name}}</h2>
                <address>
                    <p>{{$name_location->address}}</p>
                    <p>{{$name_location->city}}</p>
                    <p>{{$name_location->state}}</p>
                    <p>{{$name_location->zip}}</p>
                </address>
            </div>
        </div>
    </div>
</section>
<section class="mb-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block border-right pr-3 mr-3">
                    <div class="d-flex">
                        <div class="payment_download">
                            <i class="ri-profile-line"></i>
                        </div>
                        <div class="flex-fill">
                            <h4><a href="#">File 01001.CSV</a></h4>
                            <p class="m-0">28 Feb 2022</p>
                        </div>
                    </div>
                </div>
                <div class="d-inline-block">
                    <h4 class="font-weight-normal">Balance Due</h4>
                    <p class="m-0 text-primary">$100.00
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="payment-tab">
                        <div class="nav nav-tabs flex-column">
                            <a href="#paypal" class="nav-link active" data-toggle="tab">
                                <img src="{{asset('assets/dashboard/')}}/images/paypal.png" class="img-fluid" alt="">
                            </a>
                            <a href="#stripe" class="nav-link" data-toggle="tab"><img
                                    src="{{asset('assets/dashboard/')}}/images/stripe.png"
                                    class="img-fluid" alt=""> </a>
                            {{--                            <a href="#square" class="nav-link" data-toggle="tab"><img--}}
                            {{--                                    src="{{asset('assets/dashboard/')}}/images/square.png"--}}
                            {{--                                    class="img-fluid" alt=""> </a>--}}
                        </div>
                    </div>
                    <div class="tab-content flex-fill">
                        <div class="tab-pane fade show active" id="paypal">
                            <p>You'll be redirected to PayPal from where you can log in to your account and pay the
                                amount.</p>
                            <div class="col-lg-3">

                            </div>
                            <div class="col-lg-6">
                                <div id="paypal-button-container"></div>
                            </div>

                            {{--                            <a href="https://www.paypal.com" class="btn btn-sm btn-primary">Processed To Payment</a>--}}
                        </div>
                        <div class="tab-pane fade" id="stripe">
                            <p>You'll be redirected to Stripe from where you can log in to your account and pay the
                                amount.</p>
                            <div class="row">
                                <div class="col-lg-3">
                                    <form action="{{route('client.stripe.payment.make')}}" method="post">
                                        @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js"
                                            class="stripe-button"
                                            data-key="pk_test_ceyoY7uA4tKyBOj065u9H4YN00Emw5XrJ1"
                                            data-name="TherapyPMS"
                                            data-description="10 cucumbers from Roger's Farm"
                                            data-amount="2000">
                                        </script>
                                        <input type="hidden" class="amount" name="amount" value="50">
                                    </form>
                                </div>


                            </div>
                            {{--                            <div class="tab-pane fade" id="square">--}}
                            {{--                                <p>You'll be redirected to Square from where you can log in to your account and pay the--}}
                            {{--                                    amount.</p>--}}
                            {{--                                <a href="#" class="btn btn-sm btn-primary">Processed To Payment</a>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Jq Files -->

<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
<!-- Plugin -->
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/moment.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/date-picker/daterangepicker.js"></script>
<script src="{{asset('assets/dashboard/')}}/vendor/jquery.mask.js"></script>
<!-- Custom JavaScript -->
<script src="{{asset('assets/dashboard/')}}/js/custom.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://js.stripe.com/v3/"></script>


<script>
    $('#pay_btn').hide();
    $('.payment_method').change(function (e) {
        let v = $(this).val();
        if (v == 2)
            $('#pay_btn').show();
    });
</script>
<script>
    paypal.Button.render({

        env: 'sandbox', // sandbox | production

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
            sandbox: 'AdU-mjwxuF7ja2FsyUlcuIEi1FC5S8ZPyqo4-aFSuKGF974reJHHKRBO72Ef7pP5bTNXEBoyOiM7Hnvq',
            production: ''
        },

        // Show the buyer a 'Pay Now' button in the checkout flow
        commit: true,

        // payment() is called when the button is clicked
        payment: function (data, actions) {

            // Make a call to the REST api to create the payment
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {total: '5', currency: 'USD'}
                        }
                    ]
                }
            });
        },

        // onAuthorize() is called when the buyer approves the payment
        onAuthorize: function (data, actions) {

            // Make a call to the REST api to execute the payment
            return actions.payment.execute().then(function () {
                window.alert('Payment Complete!');
            });
        }

    }, '#paypal-button-container');

</script>

</body>

</html>
