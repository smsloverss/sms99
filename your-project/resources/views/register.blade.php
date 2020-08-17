<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ env('WEBSITE_TITLE') }}</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="./assets/css/nice-select.css">
    <link rel="stylesheet" href="./assets/css/owl.min.css">
    <link rel="stylesheet" href="./assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">
    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/main.css">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">


</head>

<body>

<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<!--============= Sign In Section Starts Here =============-->
<div class="account-section bg_img" data-background="./assets/images/account-bg.jpg">
    <div class="container">
        <div class="account-title text-center">
            <a href="index.html" class="back-home"><i class="fas fa-angle-left"></i><span>Back <span class="d-none d-sm-inline-block"></span></span></a>
        </div>
        <div class="account-wrapper">

            <div class="account-body">
                <span class="d-block mb-20">Fill in your details below</span>
                <form class="account-form" method="POST" action="{{ route('register.perform') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="sign-up">Your username </label>
                        <input type="text" name="name" placeholder="Enter Your username " id="sign-up">
                    </div>
                    <div class="form-group">
                        <label for="sign-up">Your password </label>
                        <input type="password" name="password" placeholder="Enter Your Passsword " id="sign-up">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit">Create account</button>
                        <span class="d-block mt-15">Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--============= Sign In Section Ends Here =============-->

<script src="./assets/js/jquery-3.3.1.min.js"></script>
<script src="./assets/js/modernizr-3.6.0.min.js"></script>
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/magnific-popup.min.js"></script>
<script src="./assets/js/jquery-ui.min.js"></script>
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/waypoints.js"></script>
<script src="./assets/js/nice-select.js"></script>
<script src="./assets/js/owl.min.js"></script>
<script src="./assets/js/counterup.min.js"></script>
<script src="./assets/js/paroller.js"></script>
<script src="./assets/js/countdown.js"></script>
<script src="./assets/js/main.js"></script>


</body>

</html>
