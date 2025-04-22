@extends('admin.layout.index')
@section('header')
    <link rel="stylesheet" type="text/css" href="admin/css/vendors/datatables.css">
    <style>
        th, td {
            min-width: 150px !important;
            max-width: 300px !important;
            vertical-align: middle;
        }

    </style>
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Chủ đề</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <span class="badge rounded-pill badge-success">{{$item->email}}</span>
                                            </td>
                                            <td>{{$item->subject}}</td>
                                            <td>{{$item->message}}</td>
                                            <td>
                                                @if($item->info_reply->count() > 0)
                                                    <span class="badge rounded-pill badge-success">Đã phản hồi</span>
                                                @else
                                                    <span class="badge rounded-pill badge-danger">Chưa phản hồi</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                <a href="admin/contacts/reply/{{$item->id}}"
                                                   class="btn btn-warning btn-sm">
                                                    <span class="icon-pencil-alt"></span>
                                                </a>
                                                <a data-href="admin/contacts/delete/{{$item->id}}" data-bs-toggle="modal"
                                                   data-bs-target="#confirm-delete"
                                                   class="btn btn-danger btn-sm" type="button">
                                                    <span class="icon-trash"></span>
                                                </a>
                                            </td>
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
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#datatable").DataTable({
                paging: true,
                ordering: false,
                info: false,
                responsive: true,
            });
        });
    </script>
@endsection
