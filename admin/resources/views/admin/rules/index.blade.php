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
                                <h3>Cập nhật: {{$data->title}}</h3>
                            </div>
                            <div class="card-body">
                                <form action="admin/{{$data->route}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Nội dung (VN)</label>
                                        <textarea  class="form-control" required id="noidung" name="noidung">
                                            {{$data->content}}
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nội dung (EN)</label>
                                        <textarea class="form-control" required id="noidung_en" name="noidung_en">
                                            {{$data->content_en}}
                                        </textarea>
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

