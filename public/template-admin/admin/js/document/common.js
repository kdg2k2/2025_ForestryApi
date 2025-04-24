const reset = () => $("#other").empty();
const getLegalTypes = () => {
    return http.get("/api/document/type/legal/list", { paginate: 0 });
};
const getScientificPublicationTypes = () => {
    return http.get("/api/document/type/scientific_publication/list", {
        paginate: 0,
    });
};
const getBiodiversityTypes = () => {
    return http.get("/api/document/type/biodiversity/list", { paginate: 0 });
};

const listerNewDocumentLegal = () => {
    $("select[name='new_document_legal[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác</label>
                        <input required type="text" class="form-control" name="new_document_legal_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const listerNewDocumentScientificPublication = () => {
    $("select[name='new_document_scientific_publication[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác</label>
                        <input required type="text" class="form-control" name="new_document_scientific_publication_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const listerNewDocumentBiodiversity = () => {
    $("select[name='new_document_biodiversitie[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác</label>
                        <input required type="text" class="form-control" name="new_document_biodiversitie_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const handleChange = async () => {
    const value = $("#id_document_type").val();
    const bodyForm = $("#other");
    reset();
    // value of case file config\documents.php
    switch (value) {
        case "1":
            bodyForm.append(`
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu pháp lý khác</label>
                    <input required type="text" class="form-control" name="new_document_type[name]" placeholder="Nhập loại tài liệu pháp lý khác">
                </div>
            `);
            break;
        case "2":
            const { data } = await getLegalTypes();
            bodyForm.append(/*html */ `
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Số hiệu văn bản</label>
                    <input required type="text" class="form-control" name="new_document_legal[doc_number]" placeholder="Nhập số hiệu văn bản">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Thời gian có hiệu lực</label>
                    <select required class="form-select" name="new_document_legal[validity]">
                        <option value="active">Có hiệu lực</option>
                        <option value="expired">Hết hiệu lực</option>
                        <option value="upcoming">Chưa có hiệu lực</option>
                        <option value="undefined">Chưa xác định</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu pháp lý:</label>
                    <select required class="form-select" name="new_document_legal[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentLegal();
            break;

        case "3": {
            const { data } = await getScientificPublicationTypes();
            bodyForm.append(`
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Năm ấn phẩm</label>
                    <input required type="number" class="form-control" name="new_document_scientific_publication[year]" placeholder="Nhập năm ấn phẩm">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại ấn phẩm khoa học</label>
                    <select required class="form-select" name="new_document_scientific_publication[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentScientificPublication();
            break;
        }
        case "4": {
            const { data } = await getBiodiversityTypes();
            bodyForm.append(`
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu đa dạng sinh học</label>
                    <select required class="form-select" name="new_document_biodiversitie[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentBiodiversity();
            break;
        }
    }
};
