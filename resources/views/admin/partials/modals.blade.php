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
                <h3 class="modal-title fs-5">Xác nhận khoá tài khoản</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Xác nhận khoá tài khoản này, tài khoản bị khoá sẽ không được truy cập hệ thống quản trị. Xác
                    nhận xóa chọn "Xác nhận", để hủy chọn "Hủy bỏ"</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-lock" type="button">Xác nhận</a>
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

<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5">Xác nhận đăng xuất</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Chắc chắn đãng xuất không?</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light text-dark" type="button" data-bs-dismiss="modal">Hủy</button>
                <a href="#" class="btn btn-danger btn-logout" type="button" id="btn-confirm-logout">Xác nhận</a>
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

    $('#confirm-logout').on('show.bs.modal', function(e) {
        $('#btn-confirm-logout').one('click', function(evt) {
            evt.preventDefault();

            const csrf = $("meta[name='csrf_token']").attr('content');

            apiRequest('post', $(e.relatedTarget).data('href'), {}, csrf)
                .then(data => {
                    window.location.href = '/';
                })
                .catch(err => {
                    console.error('Logout failed', err);
                });
        });
    });
</script>
