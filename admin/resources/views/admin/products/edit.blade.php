@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div
                                class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Chỉnh sửa sản phẩm</h3>
                                <div>
                                    <a href="javascript:history.back()" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/products/edit/{{$data->id}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Thuộc dịch vụ</label>
                                            <input class="form-control" readonly disabled placeholder="" value="{{$data->info_product_type->name}}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Dạng sản phẩm</label>
                                            <input class="form-control" readonly disabled placeholder="" value="{{$data->file_type}}">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Hình ảnh (Chọn để thay thế)</label>
                                            <input type="file" required class="form-control" name="file" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-footer text-right">
                                        <button class="btn btn-primary btn-block">Thực hiện</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

