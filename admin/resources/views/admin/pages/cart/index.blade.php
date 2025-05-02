@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="card mb-3"></div>
            <form class="form-checkout card px-3">
                <div class="row">
                    <div class="card-body col-md-8">
                        <h4>Giỏ hàng</h4>
                        <div class="cart-w">
                            <div class="body-cart__content cart-page"></div>
                        </div>
                    </div>
                    <div class="card-body col-md-4">
                        <h4>Thông tin đơn hàng</h4>
                        <div class="mt-3">
                            <p class="d-flex justify-content-between">
                                <span>Tổng tiền:</span>
                                <span class="text-danger fw-bold">
                                    <span class="total-price">0</span><sup>đ</sup>
                                </span>
                            </p>
                            <button type="submit" class="btn-checkout mt-3 btn btn-primary" style="width: 100%;">Thanh toán</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection
@section('script')
@endsection
