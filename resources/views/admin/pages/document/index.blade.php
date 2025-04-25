@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="card mb-3">
                <div class="row p-3">
                    <div class="col-md-2">
                        <label>Loại tài liệu</label>
                        <select id="filter-type"></select>
                    </div>
                    <div class="col-md-2">
                        <label>Tải về</label>
                        <select id="filter-download" class="form-select">
                            <option selected value="">-----Chọn-----</option>
                            <option value="0">Không cho phép</option>
                            <option value="1">Cho phép</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-outline-primary rounded-pill" data-bs-toggle="tooltip" data-placement="top"
                            title="Lọc" id="btn-filter">
                            <i class="fal fa-filter"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách</h3>
                            <div>
                                <a href="{{ route('admin.document.create') }}" class="btn btn-outline-primary rounded-pill"
                                    data-bs-toggle="tooltip" data-placement="top" title="Thêm mới">
                                    <i class="fal fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable"></table>
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
        const datatable = $('#datatable');
        const listUrl = @json(route('api.document.list'));
        const storeUrl = @json(route('api.document.store'));
        const updateUrl = @json(route('api.document.update'));
        const deleteUrl = @json(route('api.document.delete'));
        const showUrl = @json(route('api.document.show'));

        const getDocuments = (param) => {
            destroyDataTable(datatable);
            createDataTableServerSide(datatable, listUrl, [{
                data: 'name',
                title: 'Tên tài liệu',
            },
            {
                data: 'type',
                title: 'Loại tài liệu',
            },
            {
                data: 'issued_date',
                title: 'Ngày ban hành',
            },
            {
                data: 'author',
                title: 'Tác giả',
            },
            {
                data: 'price',
                title: 'Giá',
            },
            {
                data: 'uploader',
                title: 'Người tải lên',
            },
            {
                data: 'actions',
                title: 'Hành động',
            },
            ], (item) => ({
                name: item.name ?? '',
                type: item.type?.name ?? '',
                issued_date: formatDateTime(item.issued_date) ?? '',
                author: item.author ?? '',
                price: formatNumber(item.price) ?? '',
                uploader: item.uploader?.name ?? '',
                actions: `
                    <div class="text-center">
                        <a href="/admin/documents/${item.id}/view" title="Xem"
                            class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="tooltip"
                            data-placement="top">
                            <i class="fal fa-book-reader"></i>
                        </a>
                        <a href="/admin/documents/${item.id}" title="Cập nhật"
                            class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="tooltip"
                            data-placement="top">
                            <i class="fal fa-edit"></i>
                        </a>
                        <a title="Xóa" data-id="${item.id}" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Xóa" class="btn btn-sm btn-outline-danger rounded-pill" data-bs-toggle="tooltip" data-placement="top">
                                <i class="fal fa-trash-alt"></i>
                        </a>
                    </div>
                `
            }), param);
        }

        const getDocumentTypes = () => http.get('api/document/type/list', { paginate: 0 });
        const main = () => {
            getDocuments({ paginate: 1 });
        }

        const renderSelect = async () => {
            const { data } = await getDocumentTypes();
            const filterType = $('#filter-type');
            filterType.append(`<option value=''>-----Chọn-----</option>`);
            data.forEach(item => {
                filterType.append(`<option value="${item.id}">${item.name}</option>`);
            });
            refreshSumoSelect()
        }

        $(document).ready(() => {
            renderSelect()
            main();
            $('#btn-filter').on('click', () => {
                const filterType = $('#filter-type').val();
                const filterDownload = $('#filter-download').val();
                let param = {
                    paginate: 1,
                    id_document_type: filterType,
                    allow_download: filterDownload
                }
                getDocuments(param);
            })
        })

        // lister modal delete
        $('#confirm-delete').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');
            const modal = $(this);
            modal.find('.btn-delete').off('click').on('click', async (e) => {
                try {
                    e.preventDefault();
                    const { message } = await http.delete(`api/document/delete`, { id });
                    alertSuccess(message);
                    getDocuments({ paginate: 1 });
                    modal.modal('hide');
                } catch (error) {
                    alertError(error.message);
                }
            });
        });
    </script>
@endsection
