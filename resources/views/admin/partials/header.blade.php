<header class="page-header row" id="top_header">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        <a href="/">
            <img style="height: 40px; border-radius: 50%;" class="img-fluid" src="asset/images/F4.jpg" alt="logo" />
            <a class="close-btn toggle-sidebar" href="javascript:void(0)">
                <svg class="svg-color">
                    <use href="template-admin/admin/svg/iconly-sprite.svg#Category"></use>
                </svg>
            </a>
        </a>
    </div>
    <div class="page-main-header col">
        <div class="header-left">

        </div>
        <div class="nav-right">
            <ul class="header-right">
                <li></li>
                <li>
                    <a class="dark-mode" href="javascript:void(0)">
                        <svg>
                            <use href="template-admin/admin/svg/iconly-sprite.svg#moondark"></use>
                        </svg>
                    </a>
                </li>

                <li>
                    <a class="full-screen" href="javascript:void(0)">
                        <svg>
                            <use href="template-admin/admin/svg/iconly-sprite.svg#scanfull"></use>
                        </svg>
                    </a>
                </li>
                <li class="cart-w" style="position: relative;">
                    <div id="cart">
                        <i class="fal fa-shopping-cart"></i>
                    </div>
                    <span id="cart-count"
                        style="font-size: 12px; position: absolute; top:-4px; left: calc(100% - 8px); line-height: 8px; border-radius: 12px;"
                        class="p-1 bg-danger d-flex align-items-center justify-content-center">
                        0
                    </span>
                    <div class="body-cart">
                        <div></div>
                    </div>
                </li>
                <li class="profile-nav custom-dropdown">
                    <div class="user-wrap">
                        <div class="user-img"><img src="template-admin/admin/images/profile.png" alt="user" /></div>
                        <div class="user-content">
                            <h6>{{ auth('api')->user()->name }}</h6>
                            <p class="mb-0">
                                {{ auth('api')->user()->role->name_en }}
                                <i class="fa-solid fa-chevron-down"></i>
                            </p>
                        </div>
                    </div>
                    <div class="custom-menu overflow-hidden">
                        <ul class="profile-body">
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="template-admin/admin/svg/iconly-sprite.svg#Profile"></use>
                                </svg>
                                <a class="ms-2" href="#">Tài khoản</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="template-admin/admin/svg/iconly-sprite.svg#Setting"></use>
                                </svg>
                                <a class="ms-2" href="#">Đổi mật khẩu</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="template-admin/admin/svg/iconly-sprite.svg#Login"></use>
                                </svg>
                                <a class="ms-2" href="" data-href="{{ route('auth.logout') }}" data-bs-toggle="modal"
                                    data-bs-target="#confirm-logout">Thoát</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
