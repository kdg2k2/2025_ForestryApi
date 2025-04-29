const checkout = {
    checkout: function (data) {
        return http.post("api/checkout", data);
    },
    init: function () {
        $(".form-checkout").click(async function (e) {
            e.preventDefault();
            const form = new FormData(this);
            const { message } = await checkout.checkout(form);
        });
    },
};

checkout.init();
