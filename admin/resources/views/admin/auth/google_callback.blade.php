<!DOCTYPE html>
<html>

<head>
    <title>Callback</title>
</head>

<body>
    <script>
        const payload = {
            access_token: @json($access),
        };
        const callbackUrl = @json('auth.google.callback');
        console.log(callbackUrl);
        console.log(window.opener);


        if (window.opener) {
            window.opener.postMessage(payload, window.location.origin);
            setTimeout(() => window.close(), 300);
        } else {
            const qs = new URLSearchParams(payload).toString();
            window.location.href = callbackUrl + qs;
        }
    </script>
</body>

</html>
