@extends('admin.layout.index')
@section('css')
    <link rel="stylesheet" href="\template-admin\admin\css\checkout.css">
@endsection
@section('content')
    <div class="page-body">
        <div class="container invoice-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-5 px-3 py-5" style="width: 100%;">
                        <div class="text-center checkout-header">
                            <i class="icon-checkout fa-light fa-badge-check"></i>
                            <p class="title-checkout m-0">
                                Cảm ơn bạn đã đặt hàng!
                            </p>
                            <p>#ORDER905052025135655</p>
                        </div>
                        <div class="card-body">
                            <table class="table-wrapper table-responsive table-borderless theme-scrollbar">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table-responsives table-borderless" style="width: 100%;">
                                                <tbody>
                                                    <tr class="info-checkout">
                                                        <td>
                                                            <p class="info-item">
                                                                <span><b>Họ & Tên:</b></span>
                                                                <span><i>Nguyễn Văn Ánh</i></span>
                                                            </p>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Số điện thoại:</b>
                                                                </span>
                                                                <span><i>1234567890</i></span>
                                                            </p>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Email:</b>
                                                                </span>
                                                                <span><i>a@gmail.com</i></span>
                                                            </p>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Địa chỉ:</b>
                                                                </span>
                                                                <span>
                                                                    <i>123 Đường ABC, Phường XYZ, Quận 1, TP.HCM 123 Đường
                                                                        ABC, Phường XYZ, Quận 1, TP.HCM</i>
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Ngày đặt hàng:</b>
                                                                </span>
                                                                <span><i>12/05/2024</i></span>
                                                            </p>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Hình thức thanh toán:</b>
                                                                </span>
                                                                <span><i>VNPAY</i></span>
                                                            </p>
                                                            <p class="info-item">
                                                                <span>
                                                                    <b>Ghi chú:</b>
                                                                </span>
                                                                <span><i>
                                                                        Lorem ipsum dolor sit amet consectetur adipisicing
                                                                        elit. Voluptatum ab, deleniti, illo sed magni
                                                                        aspernatur aliquam omnis corrupti eos veritatis
                                                                        perferendis dicta asperiores quia. Perspiciatis
                                                                        incidunt iusto facere odit reprehenderit.
                                                                    </i></span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span
                                                style="display:block; background: rgba(82, 82, 108, 0.3); height:1px; width: 100%; margin-bottom:20px;">
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%;border-spacing:0;">
                                                <thead>
                                                    <tr style="background: #308e87;">
                                                        <th style="padding: 18px 15px; text-align: left"><span
                                                                style="color: #fff; font-size: 16px; font-weight: 600;">Description</span>
                                                        </th>
                                                        <th
                                                            style="padding: 18px 15px; text-align: center; border-inline: 3px solid #fff;">
                                                            <span
                                                                style="color: #fff; font-size: 16px; font-weight: 600;">Qty</span>
                                                        </th>
                                                        <th
                                                            style="padding: 18px 15px; text-align: center;border-right: 3px solid #fff;">
                                                            <span
                                                                style="color: #fff; font-size: 16px; font-weight: 600;">Price</span>
                                                        </th>
                                                        <th style="padding: 18px 15px; text-align: center"><span
                                                                style="color: #fff; font-size: 16px; font-weight: 600;">Subtotal</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="padding: 18px 15px 18px 0; display:flex; align-items: center; gap: 10px; border-bottom:1px solid #52526C4D;">
                                                            <ul style="padding: 0; margin: 0; list-style: none;">
                                                                <li>
                                                                    <h4
                                                                        style="font-weight:600; margin:4px 0px; font-size: 16px; color: #308e87;">
                                                                        HTML Admin template</h4><span
                                                                        style=" opacity: 0.8; font-size: 16px;">Regular
                                                                        License</span>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td
                                                            style="padding: 18px 15px; width: 12%; text-align: center; border-bottom:1px solid #52526C4D;">
                                                            <span style=" opacity: 0.8;">2</span>
                                                        </td>
                                                        <td
                                                            style="padding: 18px 15px; width: 12%; text-align: center; border-bottom:1px solid #52526C4D;">
                                                            <span style=" opacity: 0.8;">$35</span>
                                                        </td>
                                                        <td
                                                            style="padding: 18px 15px; width: 12%; text-align: center; border-bottom:1px solid #52526C4D;">
                                                            <span style=" opacity: 0.8;">$70</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width:100%;">
                                                <tbody>
                                                    <tr
                                                        style="display:flex; justify-content: space-between; margin:28px 0;align-items: center;">
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <span
                                                                style=" font-size: 16px; font-weight: 500; opacity: 0.8; font-weight: 600;">Tổng
                                                                tiền</span>
                                                            <h4
                                                                style="font-weight:600; margin: 12px 0 5px 0; font-size: 26px; color:#308e87;">
                                                                $175.00</h4>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <span
                                                style="display:block;background: rgba(82, 82, 108, 0.3);height: 1px;width: 100%;margin-bottom:30px;"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="display: flex; justify-content: end; gap: 15px;">
                                                <a style="background: rgba(48, 142, 135, 1); color:rgba(255, 255, 255, 1);border-radius: 10px;padding: 18px 27px;font-size: 16px;font-weight: 600;outline: 0;border: 0; text-decoration: none;"
                                                    href="/admin/order">
                                                    Danh sách đơn hàng
                                                    <i class="icon-arrow-right"
                                                        style="font-size:13px;font-weight:bold; margin-left: 10px;"></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-Fluid Ends-->
    </div>
@endsection

@section('script')
    <script src="\template-admin\admin\js\checkout\order.js"></script>
@endsection
