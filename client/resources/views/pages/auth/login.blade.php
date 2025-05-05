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
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="template-admin/css/notify.css" rel="stylesheet" />
    <link href="template-admin/css/prettify.css" rel="stylesheet" />
</head>

<body class="main-body light-theme login-card">
    <div class="page justify-content-center">
        <div class="main-content app-content pt-0">
            <section class="section banner-pd-1">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-8 col-lg-7 mt-3">
                            <a href="/">
                                <img width="300" src="../assets/images/brand/logo-color.png" alt="img"
                                    class="auth-logo logo-color mb-4 mx-auto">
                                <img width="300" src="../assets/images/brand/logo-white.png" alt="img"
                                    class="auth-logo logo-dark mb-4 mx-auto">
                            </a>
                            <div class="card border mb-0">
                                <div class="card-body p-sm-6">
                                    <h3 class="mb-1">Đăng nhập</h3>
                                    <p class="mb-4 tx-muted">Đăng nhập tài khoản để sử dụng dịch vụ.</p>
                                    <form class="form-horizontal theme-form" action="login" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Email<span
                                                            class="tx-danger ms-1">*</span></label>
                                                    <input name="email" class="form-control ms-0" type="email"
                                                        placeholder="Enter your Email">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="mb-2 fw-500">Mật khẩu<span
                                                            class="tx-danger ms-1">*</span></label>
                                                    <div class="input-group">
                                                        <input name="password" class="form-control ms-0 border-end-0"
                                                            type="password" placeholder="Enter your Password"
                                                            id="password">
                                                        <a href="javascript:void(0)"
                                                            class="input-group-text bg-transparent tx-muted"> <i
                                                                class="fe fe-eye tx-muted op-7" id="showPassword"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="d-flex mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label tx-15" for="flexCheckDefault">
                                                            Ghi nhớ </label>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <a href="forgot-password.html"
                                                            class="tx-primary ms-1 tx-13">Quên mật khẩu?</a>
                                                    </div>
                                                </div>
                                                <div class="d-grid mb-3">
                                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="d-grid mb-3">
                                        <button id="btnGoogleLogin" type="button" class="btn btn-white border"><img
                                                src="assets/images/png/45.png" class="me-2" alt="img" width="20">Đăng
                                            nhập với Google
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <p class="mb-0 tx-14">Chưa có tài khoản?
                                            <a href="register" class="tx-primary ms-1">Đăng ký</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="template-admin/admin/js/vendors/jquery/jquery.min.js"></script>
    <script src="template-admin/js/notify.js"></script>
    <script src="template-admin/js/prettify.js"></script>
    <script src="template-admin/js/use-notify.js"></script>
    <script src="asset/js/fetch.js"></script>
    <script src="asset/js/loading.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/show-password.js"></script>
    <script>
        const loginApiUrl = @json(route('auth.login'));
        const dashboardUrl = @json(route('dashboard'));

        const redirect = () => {
            window.location.href = dashboardUrl;
        }

        const loginForm = document.querySelector('form.theme-form');
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = this.email.value;
            const password = this.password.value;
            const csrf = this._token.value;

            apiRequest('post', loginApiUrl, {
                email,
                password
            }, csrf)
                .then(data => {
                    redirect();
                })
                .catch(err => {
                    console.error('Login failed', err);
                });
        });

        window.addEventListener('message', function (evt) {
            if (evt.origin !== window.location.origin) return;
            if (evt.data.access_token) {
                redirect();
            }
        }, false);

        document.getElementById('btnGoogleLogin').addEventListener('click', function () {
            const url = @json(route('auth.google.redirect'));
            const w = 500,
                h = 600;
            const left = (screen.width - w) / 2,
                top = (screen.height - h) / 2;
            window.open(url, 'GoogleLogin', `width=${w},height=${h},top=${top},left=${left}`);
        });
    </script>
</body>

</html>
