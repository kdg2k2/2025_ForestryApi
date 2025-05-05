const checkout = {
    checkout: function (data) {
        return http.post("api/checkout", data);
    },
    init: function () {
        $(".form-checkout").submit(async function (e) {
            try {
                e.preventDefault();
                const form = new FormData(this);
                if (!form.get("cart_ids[]")) return;
                const { data } = await checkout.checkout(form);
                location.href = data;
            } catch (error) {
                alertErr(error.message);
            }
        });
    },
};

checkout.init();
