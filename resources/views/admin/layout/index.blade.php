<!DOCTYPE html >
<html lang="en">

<head>
    <base href="{{ asset('')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        {{env('APP_NAME')}}
    </title>

    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap"
        rel="stylesheet"/>
    <link rel="stylesheet" href="template-admin/admin/css/vendors/flag-icon.css"/>
    <link rel="stylesheet" href="template-admin/admin/css/iconly-icon.css"/>
    <link rel="stylesheet" href="template-admin/admin/css/bulk-style.css"/>
    <link rel="stylesheet" href="template-admin/admin/css/themify.css"/>
    <link rel="stylesheet" href="template-admin/admin/css/fontawesome-min.css"/>
    <link rel="stylesheet" type="text/css" href="template-admin/admin/css/vendors/weather-icons/weather-icons.min.css"/>
    <link rel="stylesheet" type="text/css" href="template-admin/admin/css/vendors/scrollbar.css"/>
    @yield('header')
    <link rel="stylesheet" type="text/css" href="template-admin/admin/css/vendors/slick.css"/>
    <link rel="stylesheet" type="text/css" href="template-admin/admin/css/vendors/slick-theme.css"/>
    <link rel="stylesheet" href="template-admin/admin/css/style.css"/>
    <link id="color" rel="stylesheet" href="template-admin/admin/css/color-1.css" media="screen"/>
    <link href="template-admin/css/notify.css" rel="stylesheet"/>
    <link href="template-admin/css/prettify.css" rel="stylesheet"/>
    <style>
        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
@include('admin.layout.loader')
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('admin.layout.header')
    <div class="page-body-wrapper">
        @include('admin.layout.sidebar')
        @yield('content')
        @include('admin.layout.footer')
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận xóa dữ liệu</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xóa dữ liệu này sẽ xóa hết dữ liệu liên quan. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-delete" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-lock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận khoá tài khoản</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận khoá tài khoản này, tài khoản bị khoá sẽ không được truy cập hệ thống quản trị. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-lock" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unlock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận mở khoá tài khoản</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận mở khoá tài khoản này, tài khoản được mở khoá sẽ được truy cập hệ thống quản trị. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-unlock" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-approve" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận phê duyệt đánh giá</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận phê duyệt đánh giá này, đánh giá sẽ được hiển thị ở trang chủ. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-approve" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận xoá sản phẩm</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Sản phẩm bị xoá sẽ không thể khôi phục. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-product" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>
<script src="template-admin/admin/js/vendors/jquery/jquery.min.js"></script>
<script src="template-admin/admin/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
<script src="template-admin/admin/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
<script src="template-admin/admin/js/vendors/font-awesome/fontawesome-min.js"></script>
<script src="template-admin/admin/js/vendors/feather-icon/feather.min.js"></script>
<script src="template-admin/admin/js/vendors/feather-icon/custom-script.js"></script>
<script src="template-admin/admin/js/sidebar.js"></script>
<script src="template-admin/admin/js/height-equal.js"></script>
<script src="template-admin/admin/js/config.js"></script>
<script src="template-admin/admin/js/scrollbar/simplebar.js"></script>
<script src="template-admin/admin/js/scrollbar/custom.js"></script>
<script src="template-admin/admin/js/slick/slick.min.js"></script>
<script src="template-admin/admin/js/slick/slick.js"></script>
<script src="template-admin/admin/js/js-datatables/datatables/jquery.dataTables.min.js"></script>
<script src="template-admin/admin/js/animation/tilt/tilt.jquery.js"></script>
<script src="template-admin/admin/js/animation/tilt/tilt-custom.js"></script>
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

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-delete').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-lock').on('show.bs.modal', function (e) {
        $(this).find('.btn-lock').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-unlock').on('show.bs.modal', function (e) {
        $(this).find('.btn-unlock').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-approve').on('show.bs.modal', function (e) {
        $(this).find('.btn-approve').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#delete-product').on('show.bs.modal', function (e) {
        $(this).find('.btn-product').attr('href', $(e.relatedTarget).data('href'));
    });


</script>
@yield('script')
</body>

</html>
