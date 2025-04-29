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
                                <h3>Sửa tin tức</h3>
                                <div>
                                    <a href="admin/news" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/news/edit/{{$data->id}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tiêu đề (VN)</label>
                                            <input class="form-control" name="title" required placeholder="" value="{{$data->title}}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tiêu đề (EN)</label>
                                            <input class="form-control" name="title_en" required placeholder=""
                                                   value="{{$data->title_en}}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nội dung (VN)</label>
                                            <textarea class="form-control" required id="noidung" name="noidung">{{$data->content}}</textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nội dung (EN)</label>
                                            <textarea class="form-control" required id="noidung_en" name="noidung_en">{{$data->content_en}}</textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Ảnh đại diện (chọn để thay thế)</label>
                                            <input type="file" class="form-control" name="file" placeholder="">
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
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('noidung', {
            height: 400
        });

        CKEDITOR.replace('noidung_en', {
            height: 400
        });
    </script>
@endsection
