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
                            <p class="mb-3 content-1 h5 text-white text-center">Bản đồ</p>
                            <p class="mb-0 tx-26 text-center">Tất cả loại bản đồ</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section bg-pattern-1 bg-gray-100">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-primary hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-hdd"></i> </span></div>
                                    <h5 class="mb-2">Linux Hosting</h5>
                                    <p class="mb-0 op-8">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                        blanditiism expedita.</p><a href="linux-shared-hosting.html"
                                                                    class="tx-primary tx-12">View More <i
                                            class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-secondary hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-hdd-stack"></i> </span></div>
                                    <h5 class="mb-2">Windows Hosting</h5>
                                    <p class="mb-0 op-8">Quas molestias excepturi sint occaecati cupiditate non
                                        provident placeat facere.</p><a href="windows-shared-hosting.html"
                                                                        class="tx-primary tx-12">View More <i
                                            class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-success hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-boxes"></i> </span></div>
                                    <h5 class="mb-2">WordPress Hosting</h5>
                                    <p class="mb-0 op-8">Similique sunt in culpa qui officia deserunt mollitia animi, id
                                        est omnis voluptas assumend.</p><a href="wordpress-shared-hosting.html"
                                                                           class="tx-primary tx-12">View More <i
                                            class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-danger hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-gear"></i> </span></div>
                                    <h5 class="mb-2">VPS Hosting</h5>
                                    <p class="mb-0 op-8">Et harum quidem rerum facilis est et expedita distinctio. Nam
                                        libero tempore.</p><a href="virtualserver-linux-hosting.html"
                                                              class="tx-primary tx-12">View More <i
                                            class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-info hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-clouds"></i> </span></div>
                                    <h5 class="mb-2">Cloud Hosting</h5>
                                    <p class="mb-0 op-8">Quo minus id quod maxime placeat facere possimus, omnis
                                        voluptas assumenda est.</p><a href="cloud.html" class="tx-primary tx-12">View
                                        More <i class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card feature-card-4 feature-card-4-warning hover mt-5">
                            <div class="card-body p-0">
                                <div class="p-4 text-start mt-lg--13p">
                                    <div class="icon p-2 br-5 transform-rotate-45 d-inline-block mb-4"><span
                                            class="avatar feature-avatar all-ease-03 rounded-circle transform-rotate--45 tx-20"> <i
                                                class="bi bi-bounding-box"></i> </span></div>
                                    <h5 class="mb-2">Dedicated Server Hosting</h5>
                                    <p class="mb-0 op-8">Itaque earum rerum hic tenetur a sapiente delectus, ut aut
                                        reiciendis voluptatibus.</p><a href="dedicated-server.html"
                                                                       class="tx-primary tx-12">View More <i
                                            class="bi bi-arrow-right ms-1"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
