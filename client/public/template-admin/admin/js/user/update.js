$(document).ready(function () {
    $("#form-update-user").on("submit", async function (e) {
        try {
            e.preventDefault();
            const formData = new FormData(this);
            if (!formData.get("password")) formData.delete("password");
            if (!formData.get("path")) formData.delete("path");
            await http.patch("api/user/update", formData);
            window.location.reload();
        } catch (error) {
            const { message } = error
            alertErr(message);
        }
    });
});
