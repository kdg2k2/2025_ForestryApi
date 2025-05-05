$(document).ready(function () {
    $("#form-add-user").on("submit", async function (e) {
        try {
            e.preventDefault();
            const formData = new FormData(this);
            if (!formData.get("path")) formData.delete("path");
            const { message } = await http.post("api/user/store", formData);
            alertSuccess(message);
            setTimeout(() => (window.location.href = "/admin/users"), 300);
        } catch (error) {
            const { message } = error.responseJSON;
            alertErr(message);
        }
    });
});
