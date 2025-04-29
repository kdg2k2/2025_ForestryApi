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
                                <h3>Thêm mới tài liệu</h3>
                                <div>
                                    <a href="admin/users" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form-add-document">
                                    @csrf
                                    <div class="row">
                                        {{-- name --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                Tên tài liệu:
                                            </label>
                                            <input required type="text" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>

                                        {{-- issued_date --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="issued_date" class="form-label">Ngày phát hành:</label>
                                            <input required type="date" class="form-control" name="issued_date">
                                        </div>

                                        {{-- author --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="author" class="form-label">Tác giả</label>
                                            <input type="text" class="form-control" name="author">
                                        </div>

                                        {{-- path (file upload) --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="path" class="form-label">File tải lên:</label>
                                            <input required type="file" class="form-control" name="path" accept=".pdf">
                                        </div>

                                        {{-- allow_download --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Cho phép tải xuống:</label>
                                            <select name="allow_download" class="form-select">
                                                <option value="0">Không cho phép</option>
                                                <option value="1">Cho phép</option>
                                            </select>
                                        </div>
                                        {{-- price --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label">Giá tiền:</label>
                                            <input required type="number" class="form-control" name="price" min="0">
                                        </div>
                                        {{-- id_document_type --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="id_document_type" class="form-label">Loại tài liệu:</label>
                                            <select required class="form-select" name="id_document_type" id="id_document_type">
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type['id'] }}">
                                                        {{ $type['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" id=other>
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
    <script src="\template-admin\admin\js\document\common.js"></script>
    <script src="\template-admin\admin\js\document\add.js"></script>
@endsection
