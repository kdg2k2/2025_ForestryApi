$(document).ready(function () {
    $("#form-update-user").on("submit", async function (e) {
        try {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append("_method", "PATCH");
            if (!formData.get("password")) formData.delete("password");
            if (!formData.get("path")) formData.delete("path");
            const { message } = await http.post("user/update", formData);
            window.location.reload();
        } catch (error) {
            const { message } = error.responseJSON;
            notify(message, "#e74a3b");
        }
    });
});
