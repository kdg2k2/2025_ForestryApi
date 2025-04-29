@extends('admin.layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div
                                class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Thêm sản phẩm</h3>
                                <div>
                                    <a href="admin/products" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Chọn dịch vụ</label>
                                            <select id="id_service" name="id_service" class="form-control">
                                                @foreach($all_type as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Chọn sản phẩm</label>
                                            <input class="form-control" type="file" multiple name="file[]"
                                                   id="fileInput" accept=".png, .jpg, .jpeg, .mp4, .mov" required>
                                        </div>
                                    </div>

                                    <div class="form-footer text-right">
                                        <button type="button" id="uploadButton" class="btn btn-primary btn-block">Thực
                                            hiện
                                        </button>
                                    </div>
                                </form>
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
        const MyRes = [];
        const numFile = 0;
        $('#uploadButton').on('click', function () {
            const files = $('#fileInput')[0].files;
            if (files.length === 0) {
                showToast('err', 'Vui lòng chọn file trước!');
                return 0;
            }

            $('#uploadButton').html('Đang upload');
            $('#uploadButton').addClass('disabled');

            var arr_put = [{
                'name': 'id_service',
                'value': $('#id_service').val(),
            }];

            var arr_store = [];
            $.each(files, function (index, file) {
                uploadFileInChunks(file, files.length,@json(csrf_token()), "/admin/products/add", "/admin/products/upload", "/admin/products?type=" + $('#id_service').val(), arr_put, arr_store);
            });

        });

        function showToast(type, message) {
            $.notify(message, {
                align: "right",
                verticalAlign: "bottom",
                color: "#fff",
                background: type == 'success' ? "#1cc88a" : "#dc3545",
                animationType: "drop",
            });
        }

        async function uploadFileInChunks(
            file,
            files_length,
            _token,
            put_url,
            store_url,
            redirect_url,
            arr_put,
            arr_store
        ) {
            const slice = (file, start, end) => {
                return file.slice
                    ? file.slice(start, end)
                    : file.mozSlice
                        ? file.mozSlice(start, end)
                        : file.webkitSlice
                            ? file.webkitSlice(start, end)
                            : null;
            };

            const step = 1048576 * 5;
            const filename = file.name;
            const size = file.size;

            const sendSlice = (start, id = 0) => {
                const end = start + step < size ? start + step : size;
                const formData_put = new FormData();
                formData_put.append("_token", _token);
                formData_put.append("id", id);
                formData_put.append("file", slice(file, start, end), filename);
                if (arr_put.length > 0) {
                    $.each(arr_put, function (key, val) {
                        formData_put.append(val.name, val.value);
                    });
                }

                $.ajax({
                    url: put_url,
                    type: "POST",
                    data: formData_put,
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        if (!response.id || !response.path) {
                            showToast('err', response);
                        }

                        if (response.id.length !== 13 && response.path) {
                            showToast('err', "Phản hồi không hợp lệ");
                        }

                        if (end !== size) {
                            sendSlice(end, response.id);
                        } else {
                            const formData_store = new FormData();
                            formData_store.append("_token", _token);
                            formData_store.append("data", JSON.stringify(response));
                            if (arr_store.length > 0) {
                                $.each(arr_store, function (key, val) {
                                    formData_store.append(val.name, val.value);
                                });
                            }

                            $.ajax({
                                url: store_url,
                                type: "POST",
                                data: formData_store,
                                processData: false,
                                contentType: false,
                                success: function (res) {
                                    MyRes.push(res);
                                    if (MyRes.length == files_length) {
                                        window.location.href = "/admin/products?type=" + $('#id_service').val();
                                    }
                                },
                                error: (xhr, status, error) => {
                                    MyRes.push('err');
                                    if (MyRes.length == files_length) {
                                        window.location.href = "/admin/products?type=" + $('#id_service').val();
                                    }
                                },
                            });
                        }
                    },
                    error: (xhr, status, error) => {
                        showToast('err', xhr.responseText);
                    },
                });
            };
            sendSlice(0);
        }
    </script>
@endsection

