<!DOCTYPE html>
<html lang="vi">

<head>
    <base href="{{ asset('')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOTO-PRO</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="template-admin/admin/css/vendors/flag-icon.css">
    <link rel="stylesheet" href="template-admin/admin/css/iconly-icon.css">
    <link rel="stylesheet" href="template-admin/admin/css/bulk-style.css">
    <link rel="stylesheet" href="template-admin/admin/css/themify.css">
    <link rel="stylesheet" href="template-admin/admin/css/fontawesome-min.css">
    <link rel="stylesheet" type="text/css" href="template-admin/admin/css/vendors/weather-icons/weather-icons.min.css">
    <link rel="stylesheet" href="template-admin/admin/css/style.css">
    <link id="color" rel="stylesheet" href="template-admin/admin/css/color-1.css" media="screen">
    <link href="template-admin/css/notify.css" rel="stylesheet"/>
    <link href="template-admin/css/prettify.css" rel="stylesheet"/>
</head>

<body>
<div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
<div class="loader-wrapper">
    <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
</div>
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div>
                        {{-- <a class="logo" href="/">
                            <img style="width: 250px" class="img-fluid for-light m-auto" src="{{\App\General_Information::find(14)->value}}" alt="looginpage" />
                            <img style="width: 250px" class="img-fluid for-dark" src="{{\App\General_Information::find(14)->value}}" alt="logo" />
                        </a> --}}
                    </div>
                    <div class="login-main">
                        <form action="dang-nhap" method="post" class="theme-form">
                            <h2 class="text-center">ĐĂNG NHẬP HỆ THỐNG</h2>
                            <p class="text-center">Vui lòng nhập email và mật khẩu để đăng nhập</p>
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">Địa chỉ Email</label>
                                <input class="form-control" name="email" type="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control password" name="password" type="password"
                                           placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                            </div>
                            <div class="form-group mb-0 checkbox-checked"
                                 style="display: flex; justify-content: space-between">
                                <div class="form-check checkbox-solid-info">
                                    <input class="form-check-input" id="solid6" type="checkbox">
                                    <label class="form-check-label" for="solid6">Ghi nhớ</label>
                                </div>
                                <a class="link" href="/">Quên mật khẩu?</a>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary btn-block w-100">ĐĂNG NHẬP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="template-admin/admin/js/vendors/jquery/jquery.min.js"></script>
    <script src="template-admin/admin/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="template-admin/admin/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
    <script src="template-admin/admin/js/vendors/font-awesome/fontawesome-min.js"></script>
    <script src="template-admin/admin/js/password.js"></script>
    <script src="template-admin/admin/js/script.js"></script>
    <script src="template-admin/js/notify.js"></script>
    <script src="template-admin/js/prettify.js"></script>

    <script>
        $(document).ready(function () {
            @if(session('success'))
            var success = {!! json_encode(Str::ucfirst(session('success'))) !!};
            $.notify(success, {
                align: "right",
                verticalAlign: "bottom",
                color: "#fff",
                background: "#1cc88a",
                animationType: "drop",
            });
            @endif

            @if (session('err'))
            var fail = {!! json_encode(Str::ucfirst(session('err'))) !!};
            $.notify(fail, {
                align: "right",
                verticalAlign: "bottom",
                color: "#fff",
                background: "#dc3545",
                animationType: "drop",
            });
            @endif
        });
    </script>
</div>
</body>
</html>
