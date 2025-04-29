function showToast (type, message)
{
    $.notify(message, {
        align: "right",
        verticalAlign: "bottom",
        color: "#fff",
        background: type == 'success' ? "#1cc88a" : "#dc3545",
        animationType: "drop",
    });
}


let uploaded = 0;
let startTime = new Date().getTime();
let res_ajax=[];

function uploadFileInChunks(
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
                    uploaded++;

                    if (uploaded == files_length) {
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
                                return res;
                                // if (res == 200) {
                                //     showToast('success', "Tải lên thành công");
                                // } else {
                                //     showToast('err', res);
                                // }
                            },
                            error: (xhr, status, error) => {
                                showToast('err', xhr.responseText);
                            },
                        });
                        uploaded = 0;
                    }
                }
            },
            error: (xhr, status, error) => {
                showToast('err', xhr.responseText);
            },
        });


    };

    sendSlice(0);
}
