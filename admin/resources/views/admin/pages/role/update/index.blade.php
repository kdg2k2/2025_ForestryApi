@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row" id="role-container">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const getListRoleUrl = @json(route('api.role.list'));
        const upgradeUrl = @json(route('admin.role.payment'));
        const userRecord = localStorage.getItem('user');

        const getListRole = () => {
            return http.get(getListRoleUrl, {
                paginate: 0,
                ignore_admin: 1,
            })
        }

        const renderCard = async () => {
            const data = await getListRole();
            const container = $('#role-container');
            container.empty();
            $.each(data.data, (key, value) => {
                container.append(`
                    <div class="col-xl-3 col-md-6">
                        <div class="card pricing-card border border-primary">
                            <div class="card-body">
                                <h4 class="mb-3">${value.name_en}</h4>
                                <p class="mb-4 14 tx-gray-600">
                                    ${value.name_vn}
                                </p>
                                <h6 class="mb-4 tx-28">${formatNumber(value.price)} VNĐ<span class="tx-14 tx-muted op-7">/ tháng</span>
                                </h6>
                                <ul class="list-unstyled tx-14 fw-600 mb-4">
                                    <li class="list-item mb-3">
                                        <div class="d-flex align-items-center-start">
                                            <span class="me-2 tx-primary">
                                                <i class="bi bi-check-circle"></i>
                                            </span>
                                            <span class="flex-grow-1">
                                                ${value.download_limit_per_month} lượt tải/ tháng
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-item mb-3">
                                        <div class="d-flex align-items-center-start">
                                            <span class="me-2 tx-primary">
                                                <i class="bi bi-check-circle"></i>
                                            </span>
                                            <span class="flex-grow-1">
                                                ${value.view_limit_per_month} lượt đọc/ tháng
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-item mb-3">
                                        <div class="d-flex align-items-center-start">
                                            <span class="me-2 tx-primary">
                                                <i class="bi bi-check-circle"></i>
                                            </span>
                                            <span class="flex-grow-1">
                                                ${value.page_view_limit == null ? 'Không giới hạn trang đọc online' : `Giới hạn trang ${value.page_view_limit} khi đọc online`}
                                                
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="d-grid">
                                    ${value.price != 0 ? (
                                        userRecord?.id_role != value.id ?
                                            `<a href="${upgradeUrl}?id_role=${value.id}" class="btn btn-primary">Đăng ký</a>` :
                                            `<button class="btn btn-outline-primary">Đang sử dụng</button>`
                                    ) : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            })
        }

        $(document).ready(() => {
            renderCard();
        })
    </script>
@endsection
