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
                                <h3>Chỉnh sửa dịch vụ</h3>
                                <div>
                                    <a href="admin/services" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/services/edit/{{$data->id}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tên dịch vụ (VN)</label>
                                            <input class="form-control" name="name" required placeholder="" value="{{$data->name}}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tên dịch vụ (EN)</label>
                                            <input class="form-control" name="name_en" required placeholder="" value="{{$data->name_en}}">
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

