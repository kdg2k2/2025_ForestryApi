<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Thanh toán thành công!</h1>
    <p>Mã giao dịch: {{ $inputData['vnp_TxnRef'] }}</p>
    <p>Số tiền: {{ number_format($inputData['vnp_Amount'] / 100) }} VND</p>

    <a href="/">
        Về trang chủ
    </a>
</body>

</html>
