<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận xóa dữ liệu</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xóa dữ liệu này sẽ xóa hết dữ liệu liên quan. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"
                </h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-delete" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-lock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận xóa tài khoản</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận xóa tài khoản này, tài khoản bị xóa sẽ không được truy cập hệ thống quản trị. Xác
                    nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <button class="btn btn-danger btn-ok" type="button">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unlock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận mở khoá tài khoản</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận mở khoá tài khoản này, tài khoản được mở khoá sẽ được truy cập hệ thống quản trị. Xác
                    nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-unlock" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-approve" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận phê duyệt đánh giá</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận phê duyệt đánh giá này, đánh giá sẽ được hiển thị ở trang chủ. Xác nhận xóa chọn "Xác
                    nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-approve" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận xoá sản phẩm</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Sản phẩm bị xoá sẽ không thể khôi phục. Xác nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-product" type="button">Xác nhận</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-delete').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-lock').on('show.bs.modal', function(e) {
        $(this).find('.btn-lock').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-unlock').on('show.bs.modal', function(e) {
        $(this).find('.btn-unlock').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-approve').on('show.bs.modal', function(e) {
        $(this).find('.btn-approve').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#delete-product').on('show.bs.modal', function(e) {
        $(this).find('.btn-product').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
