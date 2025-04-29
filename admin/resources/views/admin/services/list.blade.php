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
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách</h3>
                            <div>
                                <a href="admin/services/add" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Tên dịch vụ (VN)</th>
                                    <th>Tên dịch vụ (EN)</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{!! $item->name !!}</td>
                                        <td>{!! $item->name_en !!}</td>
                                        <td style="text-align: center">
                                            <a href="admin/services/edit/{{$item->id}}" class="btn btn-warning btn-sm">
                                                <span class="icon-pencil"></span>
                                            </a>
                                            <a data-href="admin/services/delete/{{$item->id}}" data-bs-toggle="modal" data-bs-target="#confirm-delete"
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
                responsive:true,
            });
        });
    </script>
@endsection
