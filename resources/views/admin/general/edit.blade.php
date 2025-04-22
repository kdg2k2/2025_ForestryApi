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
                            <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Cập nhật thông tin</h3>
                                <div>
                                    <a href="admin/general" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/general/edit/{{$data->id}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Tiêu đề</label>
                                        <input class="form-control" disabled placeholder="" value="{{$data->lable}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mô tả</label>
                                        <input class="form-control" disabled placeholder="" value="{{$data->descriptiton}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hiển thị (VN)</label>
                                        <input class="form-control" name="value_vn" placeholder="" value="{{$data->value}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hiển thị (EN)</label>
                                        <input class="form-control" name="value_en" placeholder="" value="{{$data->value_en}}">
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

