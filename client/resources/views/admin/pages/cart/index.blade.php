@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container pt-4">
            <div class="card mb-3"></div>
            <form class="form-checkout card px-3">
                <div class="row">
                    <div class="card-body col-md-12">
                        <h2 class="mb-0">Giỏ hàng</h2>
                        <div class="cart-w">
                            <div class="body-cart__content cart-page"></div>
                        </div>
                        <div class="mt-3 border-top pt-4">
                            <h5 class="d-flex justify-content-end align-items-center gap-2 mb-2">
                                <span>Tổng tiền:</span>
                                <span class="text-danger fw-bold">
                                    <span class="total-price">0</span><sup>đ</sup>
                                </span>
                            </h5>
                            <div class="d-flex align-items-center gap-2">
                                <input title="Chọn tất cả" type="checkbox" class="check-all form-check-input m-0 me-1" />
                                <button type="submit" class="btn-disable btn-checkout btn btn-primary py-2" style="width: 100%;">
                                    Thanh toán
                                </button>
                                <a type="/" class="btn btn-info py-2" style="flex-shrink: 0;">
                                    Tiếp tục mua hàng
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
@endsection
@section('script')
@endsection
