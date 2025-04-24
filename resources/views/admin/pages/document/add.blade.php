@extends('admin.layout.index')
@section('content')
    <div class="page-body" id="main-content">
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
                                <h3>Thêm mới tài khoản</h3>
                                <div>
                                    <a href="admin/users" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form-add-user">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Họ & tên
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control" name="name" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Vai trò
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" name="id_role" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role['id'] }}">
                                                        {{ $role['name_vn'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Thời hạn vai trò</label>
                                            <input type="datetime-local" class="form-control" name="role_expires_in">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Đơn vị
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select required class="form-select" name="id_unit">
                                                @foreach ($units as $u)
                                                    <option value="{{ $u['id'] }}">
                                                        {{ $u['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Mật khẩu
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" name="path">
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

@section('script')
    <script src="\template-admin\admin\js\http.js"></script>
    <script src="\template-admin\admin\js\user\add.js"></script>
@endsection
