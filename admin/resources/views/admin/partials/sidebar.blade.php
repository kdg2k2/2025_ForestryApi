<aside class="page-sidebar">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="pin-title sidebar-main-title">
                <div>
                    <h5 class="sidebar-title f-w-700">Đã Ghim</h5>
                </div>
            </li>
            <li class="sidebar-main-title">
                <div>
                    <h5 class="f-w-700 sidebar-title pt-3">Tổng Quan</h5>
                </div>
            </li>
            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link" href="template-admin/admin/dashboard">
                    <svg class="stroke-icon">
                        <use href="template-admin/admin/svg/iconly-sprite.svg#Home-dashboard"></use>
                    </svg>
                    <h6 class="f-w-600">Dashboard</h6>
                </a>
            </li>

            <li class="sidebar-main-title">
                <div>
                    <h5 class="f-w-700 sidebar-title pt-3">Tài liệu</h5>
                </div>
            </li>

            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link" href="#">
                    <svg class="stroke-icon">
                        <use href="../template-admin/admin/svg/iconly-sprite.svg#Edit-line"></use>
                    </svg>
                    <h6 class="f-w-600">Loại tài liệu</h6>
                </a>
            </li>

            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link" href="{{ route('admin.document.index') }}">
                    <svg class="stroke-icon">
                        <use href="../template-admin/admin/svg/iconly-sprite.svg#Document"></use>
                    </svg>
                    <h6 class="f-w-600">Tài liệu</h6>
                </a>
            </li>

            <li class="sidebar-main-title">
                <div>
                    <h5 class="f-w-700 sidebar-title pt-3">Tài khoản</h5>
                </div>
            </li>

            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link" href="{{ route('admin.users.index') }}">
                    <svg class="stroke-icon">
                        <use href="../template-admin/admin/svg/iconly-sprite.svg#Document"></use>
                    </svg>
                    <h6 class="f-w-600">Danh sách user</h6>
                </a>
            </li>

            <li class="sidebar-list">
                <i class="fa-solid fa-thumbtack"></i>
                <a class="sidebar-link" href="{{ route('admin.admins.index') }}">
                    <svg class="stroke-icon">
                        <use href="../template-admin/admin/svg/iconly-sprite.svg#Document"></use>
                    </svg>
                    <h6 class="f-w-600">Danh sách admin</h6>
                </a>
            </li>
        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>
