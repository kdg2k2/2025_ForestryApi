$(document).ready(async function () {
    $("#id_document_type").on("change", function () {
        const value = $(this).val();
        const bodyForm = $("#other");
        // value of case file config\documents.php
        switch (value) {
            case "1":
                bodyForm.append(`
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Loại tài liệu khác</label>
                        <input required type="text" class="form-control" name="name">
                    </div>
                `);
                break;
        }
    });
});
