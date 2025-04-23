const getUsers = () => {
    return http.get("user/list", {
        paginate: 0,
    });
};

const loadTable = async () => {
    // detroy datatable nếu có
    if ($.fn.DataTable.isDataTable("#datatable")) {
        $("#datatable").DataTable().destroy();
    }
    const { data } = await getUsers();
    $("#datatable").DataTable({
        paging: true,
        ordering: false,
        info: false,
        responsive: true,
        data: data, // đảm bảo đây là một mảng
        columns: [
            {
                title: "STT",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                title: "Thông tin",
                data: null,
                render: function (data, type, row) {
                    return /*html*/ `
                    <div class="d-flex align-items-center">
                        <div class="user-img">
                            <img
                                src="${row.path}"
                                alt="${row.name}"
                                style="object-fit: cover; padding: 2px;"
                                onerror="this.onerror=null;this.src='/template-admin/admin/images/profile.png';"
                            >
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-0">${row.name} (${row.unit.name})</h6>
                            <span class="badge text-bg-primary">${row.role.name_vn}</span>
                        </div>
                    </div>
                `;
                },
            },
            { title: "Email", data: "email" },
            // action
            {
                title: "Hành động",
                data: null,
                render: function (data, type, row) {
                    return /*html*/ `
                        <a href="/admin/users/${row.id}" class="btn btn-warning btn-sm">
                            <span class="icon-pencil"></span>
                        </a>
                        <a data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#confirm-lock" class="btn btn-danger btn-sm" type="button">
                            <span class="icon-trash"></span>
                        </a>
                    `;
                },
            },
            // thêm cột nếu cần
        ],
    });
};

$(document).ready(async function () {
    loadTable();
});

const deleteUser = async (id) => {
    try {
        const { message } = await http.delete(`user/delete?id=${id}`);
        notify(message, "#1cc88a");
        loadTable();
    } catch (error) {
        const { message } = error.responseJSON;
        notify(message, "#e74a3b");
    }
};

// listen modal confirm lock
$("#confirm-lock").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const id = button.data("id"); // Extract info from data-* attributes
    const modal = $(this);
    modal.find(".btn-ok").click(function () {
        deleteUser(id);
        modal.modal("hide");
    });
});
