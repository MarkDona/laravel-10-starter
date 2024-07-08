
<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Donatus admin is super flexible, powerful">
    <meta name="keywords" content="admin template, MarkDona admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Donatus Ankah (L0MAX)">
    <title>
        {{ __('eng.login') }}
    </title>
    <link rel="apple-touch-icon" href="{{asset('app_assets/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app_assets/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/app-assets/css/pages/authentication.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app_assets/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('app_assets/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('app_assets/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('app_assets/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app_assets/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('app_assets/app-assets/js/scripts/pages/auth-login.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
