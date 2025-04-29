@extends('pages.layouts.index')
@section('content')
    <div class="main-content app-content">
        <section class="section banner-1 banner-section banner-arrow-down">
            <img src="../assets/images/patterns/4.png" alt="img" class="patterns-3">
            <img src="../assets/images/patterns/6.png" alt="img" class="patterns-4">
            <img src="../assets/images/patterns/9.png" alt="img" class="patterns-8 op-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="">
                            <p class="mb-3 content-1 h5 text-white text-center">Tài liệu</p>
                            <p class="mb-0 tx-26 text-center">Tất cả tài liệu về: {tên category}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section bg-gray-100" id="plans">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow-none mb-0">
                            <div class="card-body p-0">
                                <div class="table-responsive border br-7">
                                    <table class="table table-bordered mb-0 table-hover border-hidden">
                                        <thead>
                                        <tr>
                                            <th>TT</th>
                                            <th>Loại tài liệu</th>
                                            <th>Tên tài liệu</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>TT</td>
                                            <td>Name</td>
                                            <td>Email</td>
                                            <td>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>TT</td>
                                            <td>Name</td>
                                            <td>Email</td>
                                            <td>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>TT</td>
                                            <td>Name</td>
                                            <td>Email</td>
                                            <td>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
