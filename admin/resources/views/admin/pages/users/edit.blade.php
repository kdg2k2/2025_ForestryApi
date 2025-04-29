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
                                <h3>Chỉnh sửa tài khoản</h3>
                                <div>
                                    <a href="admin/users" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form class="col-md-6" id="form-update-user">
                                        <input type="hidden" value="{{$data->id}}" name="id">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Họ tên
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" name="name" required placeholder=""
                                                    value="{{$data->name}}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" required
                                                    placeholder="" value="{{$data->email}}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Vai trò</label>
                                                <select class="form-select" name="id_role">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['id'] }}" {{ $data->id_role == $role['id'] ? 'selected' : '' }}>
                                                            {{ $role['name_vn'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Thời hạn vai trò</label>
                                                <input type="datetime-local" class="form-control" name="role_expires_in"
                                                    value="{{$data->role_expires_in}}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Đơn vị</label>
                                                <select class="form-select" name="id_unit">
                                                    @foreach ($units as $u)
                                                        <option value="{{ $u['id'] }}" {{ $data->id_unit == $u['id'] ? 'selected' : '' }}>
                                                            {{ $u['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Địa chỉ</label>
                                                <input class="form-control" name="address" placeholder=""
                                                    value="{{$data->address}}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Hình ảnh (Chọn để thay đổi)</label>
                                                <input type="file" class="form-control" name="path" placeholder="">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mật khẩu (Nhập để thay đổi)</label>
                                                <input type="password" class="form-control" name="password" value="">
                                            </div>
                                        </div>
                                        <div class="form-footer text-right">
                                            <button type="submit" class="btn btn-primary btn-block">Thực hiện</button>
                                        </div>
                                    </form>
                                    <div class="col-md-6 text-center">
                                        <div class="py-4" style="border-radius: 8px; background: #f0f0f0;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img
                                                    src="{{ $data->path }}"
                                                    alt="{{$data->name }}"
                                                    class="rounded-circle"
                                                    style="border: 1px solid #fff; object-fit: cover; padding: 3px; background: var(--theme-secondary);"
                                                    width="60px"
                                                    height="60px"
                                                    onerror="this.onerror=null;this.src='/template-admin/admin/images/profile.png';"
                                                >
                                            </div>
                                            <p>
                                                <span class="badge text-bg-primary">{{$data->role->name_vn}}</span>
                                                <strong class="d-block text-center mt-2">{{$data->name}} ({{$data->unit->name}})</strong>
                                                <span class="d-block text-center">{{$data->email}}</span>
                                                @if ($data->role_expires_in)
                                                    <span class="d-block text-center">
                                                        Thời hạn gói: <span class="text-danger">{{ \Carbon\Carbon::parse($data->role_expires_in)->format('d/m/Y H:i') }}</span>
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-center mt-3">Chờ cập nhật...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="\template-admin\admin\js\user\update.js"></script>
@endsection
