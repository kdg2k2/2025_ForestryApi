@extends('admin.layout.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="login-card login-dark">
            <div>
                <div>
                    <a class="logo" href="/">
                        <img style="width: 100px" class="img-fluid for-light m-auto" src="{{ env('APP_LOGO') }}"
                            alt="looginpage" />
                        <img style="width: 100px" class="img-fluid for-dark" src="{{ env('APP_LOGO') }}" alt="logo" />
                    </a>
                </div>
                <div class="login-main">
                    <form method="post" class="theme-form">
                        <h2 class="text-center mb-3">ĐĂNG NHẬP</h2>
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Email</label>
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
                        <div class="form-group mb-0 checkbox-checked" style="display: flex; justify-content: space-between">
                            <div class="form-check checkbox-solid-info">
                                <input class="form-check-input" id="solid6" type="checkbox">
                                <label class="form-check-label" for="solid6">Ghi nhớ</label>
                            </div>
                            <a class="link" href="/">Quên mật khẩu?</a>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary btn-block w-100">ĐĂNG NHẬP</button>
                        </div>
                        <div class="text-end mt-3">
                            <button id="btnGoogleLogin" type="button" class="btn btn-warning btn-block w-100">
                                Login with Google
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="template-admin/admin/js/password.js"></script>

    <script>
        const loginApiUrl = @json(route('auth.login'));
        const dashboardUrl = @json(route('dashboard'));

        const setCookieAccesstoken = (data) => {
            const at = data.access_token;
            const maxAge = data.access_token_expires_in;
            document.cookie = `access_token=${at}; max-age=${maxAge}; path=/;`;

            window.location.href = dashboardUrl;
        }

        const loginForm = document.querySelector('form.theme-form');
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.email.value;
            const password = this.password.value;
            const csrf = this._token.value;

            makeHttpRequest('post', loginApiUrl, {
                    email,
                    password
                }, csrf)
                .then(data => {
                    if (!data.access_token) {
                        alertErr('Access token does not in response');
                        return;
                    }
                    setCookieAccesstoken(data);
                })
                .catch(err => {
                    console.error('Login failed', err);
                });
        });

        window.addEventListener('message', function(evt) {
            if (evt.origin !== window.location.origin) return;
            if (evt.data.access_token) {
                setCookieAccesstoken(evt.data)
            }
        }, false);

        document.getElementById('btnGoogleLogin').addEventListener('click', function() {
            const url = @json(route('auth.google.redirect'));
            const w = 500,
                h = 600;
            const left = (screen.width - w) / 2,
                top = (screen.height - h) / 2;
            window.open(url, 'GoogleLogin', `width=${w},height=${h},top=${top},left=${left}`);
        });
    </script>
@endsection
