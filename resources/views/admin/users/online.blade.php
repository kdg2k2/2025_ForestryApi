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
                            <div>
                                <a href="admin/users/add" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                <img style="object-fit: cover; height: 100%" class="img-90 rounded-circle" src="{{$item->path}}" alt="avatar">
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <span class="badge rounded-pill badge-success">{{$item->email}}</span>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="admin/users/edit/{{$item->id}}" class="btn btn-warning btn-sm">
                                                <span class="icon-pencil"></span>
                                            </a>
                                            <a data-href="admin/users/lock/{{$item->id}}" data-bs-toggle="modal" data-bs-target="#confirm-lock"
                                               class="btn btn-danger btn-sm" type="button">
                                                <span class="icon-lock"></span>
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
                responsive:true,
            });
        });
    </script>
@endsection
