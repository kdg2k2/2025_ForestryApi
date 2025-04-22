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
                    <div class="col-xl-6">
                        <div class="card">
                            <div
                                class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Cập nhật thông tin</h3>
                                <div>
                                    <a href="admin/contacts" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="admin/contacts/reply/{{$data->id}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Người gửi</label>
                                            <input class="form-control" disabled placeholder="" value="{{$data->name}}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" disabled placeholder="" value="{{$data->email}}">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Chủ đề</label>
                                            <input class="form-control" disabled placeholder="" value="{{$data->subject}}">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Nội dung</label>
                                            <textarea cols="30" rows="3" disabled class="form-control" placeholder="Lời nhắn...">{{$data->message}}</textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Nội dung trả lời</label>
                                            <textarea id="reply" name="reply" cols="30" rows="3" class="form-control" placeholder=""></textarea>
                                        </div>
                                    </div>

                                    <div class="form-footer text-right">
                                        <button class="btn btn-primary btn-block">Thực hiện</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div
                                class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Lịch sử phản hồi</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>Họ tên</th>
                                            <th>Thời gian</th>
                                            <th>Nội dung</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reply as $item)
                                            <tr>
                                                <td>{{$item->info_user->name}}</td>
                                                <td>{{Date('d-m-Y H:i:s', strtotime($item->reply_time))}}</td>
                                                <td>{!! $item->content !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('reply', {
            height: 250
        });
    </script>
@endsection

