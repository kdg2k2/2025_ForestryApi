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
                                <h3>Xem tài liệu: <span class="text-danger">{{ $document->name }}</span></h3>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                            data-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Thông tin</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                            data-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Xem file</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a href="/admin/documents" class="nav-link">Danh sách</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Tên tài liệu:</span><span
                                                    class="ms-1">{{ $document->name }}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Ngày phát hành:</span><span class="ms-1">
                                                    {{ date('d/m/Y', strtotime($document->issued_date)) }}</span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Tải xuống:</span><span
                                                    class="ms-1">{{ $document->allow_download == '1' ? 'Cho phép tải xuống' : 'Không cho phép tải xuống' }}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Tác giả:</span><span
                                                    class="ms-1">{{ $document->author ?? '_' }}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Giá tiền:</span>
                                                <span class="ms-1 text-danger">
                                                    {{ number_format($document->price, 0, ',', '.') }}
                                                    <sup>đ</sup>
                                                </span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Loại tài liệu:</span>
                                                <span class="ms-1">{{ $document->type->name }}</span>
                                            </div>
                                            @if ($document->scientificPublication)
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Năm ấn phẩm:</span>
                                                    <span class="ms-1">{{ $document->scientificPublication->year }}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Loại ấn phẩm:</span>
                                                    <span
                                                        class="ms-1">{{ $document->scientificPublication->type->name }}</span>
                                                </div>
                                            @endif
                                            @if ($document->biodiversity)
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Loại đa dạng sinh học:</span>
                                                    <span class="ms-1">{{ $document->biodiversity->type->name }}</span>
                                                </div>
                                            @endif
                                            @if ($document->legal)
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Số hiệu văn bản:</span>
                                                    <span class="ms-1">{{ $document->legal->doc_number }}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Hiệu lực:</span>
                                                    <span
                                                        class="ms-1">{{ $document->getValidity($document->legal->validity) }}</span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-2">
                                                    <span class="fw-bold">Loại pháp lý:</span>
                                                    <span class="ms-1">{{ $document->legal->type->name }}</span>
                                                </div>
                                            @endif
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Người tải lên:</span>
                                                <span class="ms-1">{{ $document->uploader->name }}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Ngày đăng tải:</span>
                                                <span
                                                    class="ms-1">{{ date('d/m/Y', strtotime($document->created_at)) }}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <span class="fw-bold">Ngày cập nhật:</span>
                                                <span
                                                    class="ms-1">{{ date('d/m/Y', strtotime($document->updated_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <iframe style="width: 100%; height: calc(100vh - 255px);"
                                            src="https://view.officeapps.live.com/op/embed.aspx?src={{ $document->path }}&embedded=true"
                                            frameborder="0"></iframe>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="\template-admin\admin\js\document\common.js"></script>
    <script src="\template-admin\admin\js\document\add.js"></script>
    <script>
        const message = @json($message);
        if (message)
            alertErr(message);
    </script>
@endsection
