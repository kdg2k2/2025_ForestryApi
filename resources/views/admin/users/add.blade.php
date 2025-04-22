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
                                <h3>Thêm mới tài khoản</h3>
                                <div>
                                    <a href="admin/users/online" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/users/add" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Họ tên</label>
                                            <input class="form-control" name="name" required placeholder="" value="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" required placeholder="" value="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" name="password" required placeholder="" value="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" name="file" required placeholder="">
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

