$(document).ready(function () {
    $("#form-add-user").on("submit", async function (e) {
        try {
            e.preventDefault();
            const formData = new FormData(this);
            if (!formData.get("path")) formData.delete("path");
            const { message } = await http.post("user/store", formData);
            notify(message, "#1cc88a");
            setTimeout(() => (window.location.href = "/admin/users"), 300);
        } catch (error) {
            const { message } = error.responseJSON;
            notify(message, "#e74a3b");
        }
    });
});
