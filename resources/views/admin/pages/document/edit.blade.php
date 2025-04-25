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
                                <h3>Chỉnh sửa tài liệu</h3>
                                <div>
                                    <a href="admin/users" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form-update-document">
                                    @csrf
                                    <input required type="hidden" name="id" value="{{ $document->id }}">
                                    <div class="row">
                                        {{-- name --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                Tên tài liệu:
                                            </label>
                                            <input required type="text" class="form-control" name="name"
                                                value="{{ $document->name }}">
                                        </div>

                                        {{-- issued_date --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="issued_date" class="form-label">Ngày phát hành:</label>
                                            <input required type="date" class="form-control" name="issued_date"
                                                value="{{ $document->issued_date }}">
                                        </div>

                                        {{-- author --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="author" class="form-label">Tác giả</label>
                                            <input type="text" class="form-control" name="author"
                                                value="{{ $document->author }}">
                                        </div>

                                        {{-- path (file upload) --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="path" class="form-label">File tải lên:</label>
                                            <input type="file" class="form-control" name="path" accept=".pdf">
                                        </div>

                                        {{-- allow_download --}}
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Cho phép tải xuống:</label>
                                            <select name="allow_download" class="form-select">
                                                <option {{$document->allow_download == '0' ? 'selected' : ''}} value="0">Không
                                                    cho phép</option>
                                                <option {{$document->allow_download == '1' ? 'selected' : ''}} value="1">Cho
                                                    phép</option>
                                            </select>
                                        </div>

                                        {{-- price --}}
                                        <div class="col-md-3 mb-3">
                                            <label for="price" class="form-label">Giá tiền:</label>
                                            <input required type="number" class="form-control" name="price" min="0"
                                                value="{{ $document->price }}">
                                        </div>
                                        {{-- id_document_type --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="id_document_type" class="form-label">Loại tài liệu:</label>
                                            <select required class="form-select" name="id_document_type"
                                                id="id_document_type">
                                                @foreach($documentTypes as $type)
                                                    <option {{$type['id'] == $document->id_document_type ? 'selected' : ''}}
                                                        value="{{ $type['id'] }}">
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
    <script>
        const year = @json($document->scientificPublication ? $document->scientificPublication->year : null);
        const scientificPublicationId = @json($document->scientificPublication ? $document->scientificPublication->type->id : null);
        const biodiversitieId = @json($document->biodiversity ? $document->biodiversity->type->id : null);
        const docNumber = @json($document->legal ? $document->legal->doc_number : null);
        const validity = @json($document->legal ? $document->legal->validity : null);
        const legalId = @json($document->legal ? $document->legal->type->id : null);
    </script>
    <script src="\template-admin\admin\js\document\common.js"></script>
    <script src="\template-admin\admin\js\document\update.js"></script>
@endsection
