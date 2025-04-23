<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <base href="{{ asset('') }}">
    <link rel="icon" type="image/x-icon" href="{{ env('APP_LOGO') }}">

    @include('admin.partials.base-style')

    @yield('css')
</head>

<body>
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>

    @include('admin.partials.loader')

    @yield('main')

    @include('admin.partials.base-script')

    @yield('modal')

    <script>
        $(document).ready(function() {
            @if (session('success'))
                var success = @json(session('success'));
                alertSuccess(success);
            @endif

            @if (session('err'))
                var fail = @json(session('err'));
                alertErr(fail);
            @endif
        });
    </script>

    @yield('js')
</body>

</html>
