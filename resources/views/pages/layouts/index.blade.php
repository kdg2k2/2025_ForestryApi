<!DOCTYPE html>
<html lang="vi" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-hover" data-theme-mode="light">

<head>
    <base href="{{ asset('')}}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Xanh - Vì Cộng Đồng</title>

    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="style">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/libs/@simonwep/pickr/themes/classic.min.css" rel="stylesheet">
    <link href="assets/libs/@simonwep/pickr/themes/monolith.min.css" rel="stylesheet">
    <link href="assets/libs/@simonwep/pickr/themes/nano.min.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    @yield('header')
</head>

<body class="main-body light-theme">
<div class="page">
    @include('pages.layouts.header')
    @yield('content')
    @include('pages.layouts.footer')
</div>
@include('pages.layouts.moveTop')

<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/@popperjs/core/umd/popper.min.js"></script>
<script src="assets/js/defaultmenu.js"></script>
<script src="assets/js/category-menu.js"></script>
<script src="assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/swiper.js"></script>
<script src="assets/js/countdown.js"></script>
<script src="assets/js/sticky.js"></script>
<script src="assets/js/custom.js"></script>
</body>

</html>
