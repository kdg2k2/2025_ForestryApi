@extends('admin.layout.index')
@section('header')
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <style>
        .fancybox__button--thumbs {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid manager-card">
            <div class="row">
                <div class="col-xl-3 box-col-6">
                    <div class="file-sidebar">
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <h4 class="mb-2">Danh mục sản phẩm</h4>
                                    <li>
                                        <a href="admin/products"
                                           class="btn @if($type_selected == 'all') bg-primary @else bg-light font-dark @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-folder">
                                                <path
                                                    d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                            All
                                        </a>
                                    </li>
                                    @foreach($all_type as $type)
                                        <li>
                                            <a href="admin/products?type={{$type->id}}"
                                               class="btn @if($type->id == $type_selected) bg-primary @else bg-light font-dark @endif">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-folder">
                                                    <path
                                                        d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                                </svg>
                                                {{$type->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                    <hr>
                                    <h4 class="mb-2">Thêm mới sản phẩm</h4>
                                    <a href="admin/products/add"
                                       class="btn btn-primary btn-block w-100 justify-content-center">Thêm mới sản
                                        phẩm</a>
                                    <hr>
                                    <h4 class="mb-2">Tìm kiếm sản phẩm</h4>
                                    <div class="form-group">
                                        <form action="admin/products" method="GET">
                                            <div class="input-group pill-input-group">
                                                <input type="hidden" name="type" value="{{$type_selected}}">
                                                <input class="form-control" name="s" placeholder="Tìm kiếm sản phẩm..."
                                                       type="text">
                                                <button type="submit" class="input-group-text bg-primary">
                                                    <i class="fa-solid fa-magnifying-glass text-white"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-12">
                    <div class="email-right-aside bookmark-tabcontent">
                        <div class="card email-body radius-left">
                            <div class="ps-0">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="pills-created" role="tabpanel"
                                         aria-labelledby="pills-created-tab">
                                        <div class="card mb-0 file-content">
                                            <div class="card-body pb-0">
                                                <div class="details-bookmark text-center">
                                                    <div class="row" id="bookmarkData">
                                                        @foreach($data as $item)
                                                            <div class="col-xxl-3 col-md-4 col-ed-4 col-sm-6">
                                                                <div
                                                                    class="card card-with-border bookmark-card overflow-hidden">
                                                                    <div class="details-website">
                                                                        @if($item->file_type == 'video')
                                                                        <video style="object-fit: cover" width="100%" height="180" controls>
                                                                            <source src="{{$item->path}}#t=0.8" type="video/mp4">
                                                                        </video>
                                                                        @else
                                                                        <img class="img-fluid"
                                                                             src="{{$item->path_thumb}}" alt="">
                                                                        @endif
                                                                        <div class="desciption-data">
                                                                            <div class="title-bookmark">
                                                                                <h5 class="title_0">{{$item->filename}}</h5>
                                                                                <div class="hover-block">
                                                                                    <ul class="d-flex justify-content-between align-items-center"
                                                                                        style="padding-left: 10px">
                                                                                        <li>
                                                                                            <a href="admin/products/edit/{{$item->id}}">
                                                                                                <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-width="2"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    class="feather feather-edit-3">
                                                                                                    <path
                                                                                                        d="M12 20h9"></path>
                                                                                                    <path
                                                                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                                                                                </svg>
                                                                                            </a>
                                                                                        </li>

                                                                                        <li>
                                                                                            @if($item->file_type == 'video')
                                                                                            <a href="{{$item->path}}">
                                                                                                <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-width="2"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    class="feather feather-eye">
                                                                                                    <path
                                                                                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                                                    <circle cx="12"
                                                                                                            cy="12"
                                                                                                            r="3"></circle>
                                                                                                </svg>
                                                                                            </a>
                                                                                            @else
                                                                                                <a data-fancybox="products" href="{{$item->path}}">
                                                                                                    <img class="d-none" src="{{$item->path_thumb}}" alt=""/>
                                                                                                    <svg
                                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                                        width="24"
                                                                                                        height="24"
                                                                                                        viewBox="0 0 24 24"
                                                                                                        fill="none"
                                                                                                        stroke="currentColor"
                                                                                                        stroke-width="2"
                                                                                                        stroke-linecap="round"
                                                                                                        stroke-linejoin="round"
                                                                                                        class="feather feather-eye">
                                                                                                        <path
                                                                                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                                                        <circle cx="12"
                                                                                                                cy="12"
                                                                                                                r="3"></circle>
                                                                                                    </svg>
                                                                                                </a>
                                                                                            @endif
                                                                                        </li>

                                                                                        <li><a href="admin/products/download/{{$item->id}}">
                                                                                                <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-width="2"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    class="feather feather-download">
                                                                                                    <path
                                                                                                        d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                                                    <polyline
                                                                                                        points="7 10 12 15 17 10"></polyline>
                                                                                                    <line x1="12"
                                                                                                          y1="15"
                                                                                                          x2="12"
                                                                                                          y2="3"></line>
                                                                                                </svg>
                                                                                            </a></li>

                                                                                        <li>
                                                                                            <a data-href="admin/products/delete/{{$item->id}}"
                                                                                               data-bs-toggle="modal"
                                                                                               data-bs-target="#delete-product"
                                                                                               type="button">
                                                                                                <svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    stroke="currentColor"
                                                                                                    stroke-width="2"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    class="feather feather-delete">
                                                                                                    <path
                                                                                                        d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                                                                                                    <line x1="18" y1="9"
                                                                                                          x2="12"
                                                                                                          y2="15"></line>
                                                                                                    <line x1="12" y1="9"
                                                                                                          x2="18"
                                                                                                          y2="15"></line>
                                                                                                </svg>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if(count($data) > 0)
                                                        <div class="pagination-area">
                                                            {{$data->appends(request()->query())->links('pagination.admin')}}
                                                        </div>
                                                    @endif
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
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        $(document).ready(function () {

            Fancybox.bind('[data-fancybox="products"]');
        });
    </script>
@endsection
