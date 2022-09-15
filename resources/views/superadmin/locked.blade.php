<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    <title>Lockscreen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/bootstrap2.min.css">
    <link rel="stylesheet" href="{{asset('assets/dashboard/')}}/css/lockscreen.css">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <div class="lockscreen-container">
                <div id="output"></div>
                <img src="{{asset('assets/dashboard/')}}/images/lockscreen/logo-new.png" class="img-fluid" width="250"
                     alt="Logo">
                <div class="form-box">
                    <div class="avatar">
                        {{-- <img src="{{asset('assets/dashboard/')}}/images/lockscreen/avatar1.jpg" class="img-fluid" alt="Logo"> --}}
                    </div>
                    <form action="{{route('login.unlock')}}" method="post">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <h4 class="user-name hidden-sm hidden-md hidden-lg">Addision</h4>
                                <div class="col-sm-6">
                                    <input type="text" class="hidden-xs" value="" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control"
                                           placeholder="Password">
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button class="btn login" id="dashboard" type="submit">
                            <img src="{{asset('assets/dashboard/')}}/images/lockscreen/arrow-right.png" alt="Go"
                                 width="30" height="30">
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{asset('assets/dashboard/')}}/js/jquery.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/popper.min.js"></script>
<script src="{{asset('assets/dashboard/')}}/js/bootstrap.min.js"></script>
</body>

</html>
