<!DOCTYPE html>
<html>

<head>
    <title>Google Login</title>
</head>

<body>
    <script>
        // gửi access token về cửa sổ chính
        window.opener.postMessage({
            access_token: '{{ $access }}'
        }, window.location.origin);
        // tự đóng popup
        window.close();
    </script>
</body>

</html>
