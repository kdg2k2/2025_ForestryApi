const cart = $(".cart-w #cart");

cart.click(function () {
    $(".cart-w .body-cart").toggleClass("show");
});

// handle click outside
$(document).on("click", function (e) {
    if (!$(e.target).closest(".cart-w").length) {
        $(".cart-w .body-cart").removeClass("show");
    }
});

const cartModule = {
    element: {
        cartCount: $("#cart-count"),
        cartItems: $(".body-cart__content"),
        totalPrice: $(".total-price"),
        btnCheckout: $(".btn-checkout"),
        checkAll: $(".check-all"),
    },
    selects: [],
    count: 0,
    items: [],
    getData: async () => {
        try {
            return http.get("api/cart");
        } catch (error) {
            alertErr(error.message);
        }
    },
    addApi: async (id) => {
        const { message, data } = await http.post("api/cart", {
            document_id: id,
            quantity: 1,
            type: "document",
        });
        alertSuccess(message);
        return data;
    },
    add: async function (id) {
        const item = await this.addApi(id);
        const isExist = this.items.find((i) => i.id === item.id);
        if (isExist) return;
        this.items.unshift(item);
        this.count = this.items.length;
        this.update();
    },
    remove: function (id) {
        this.items = this.items.filter((item) => item.id !== id);
        this.count = this.items.length;
        this.selects = this.selects.filter((item) => item !== String(id));
        this.update();
    },
    update: function () {
        this.element.cartCount.text(this.count);
        let html = '<p class="text-center py-4">Giỏ hàng trống</p>';

        if (this.count != 0) {
            html = this.items
                .map((item) => {
                    const checked = this.selects.includes(String(item.id))
                        ? "checked"
                        : "";
                    const urlDocument = `/admin/documents/${item.document.id}/view`;
                    return /*html*/ `
                        <div class="d-flex justify-content-between align-items-center py-3 cart-item">
                            <div class="d-flex align-items-center" style="max-width: 75%;">
                                <input
                                    ${checked}
                                    type="checkbox"
                                    value="${item.id}"
                                    name="cart_ids[]"
                                    class="form-check-input m-0"
                                />
                                <div class="px-3 text-success d-flex align-items-center"><i style="font-size: 20px;" class="fa-regular fa-file"></i></div>
                                <div>
                                    <a
                                        href="${urlDocument}"
                                    >
                                        <h5 class="m-0">
                                            ${item.document.name}
                                        </h5>
                                    </a>
                                    <h6 class="pt-1 m-0 text-danger">
                                        ${formatNumber(item.document.price)}
                                        <sup>đ</sup>
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <span
                                    data-id="${item.id}"
                                    class="remove-item text-danger"
                                >
                                    <i style="font-size: 14px;" class="fa-solid fa-trash"></i>
                                </span>
                            </div>
                        </div>`;
                })
                .join("");
        }
        this.element.cartItems.html(html);
        this.updateTotalPrice();
        if (this.selects.length > 0) {
            this.element.btnCheckout.removeClass("btn-disable");
        } else {
            this.element.btnCheckout.addClass("btn-disable");
        }
    },
    updateTotalPrice: function () {
        const total = this.items
            .filter((item) => this.selects.includes(String(item.id)))
            .reduce((acc, item) => acc + item.document.price, 0);
        this.element.totalPrice.text(formatNumber(total));
    },
    init: function () {
        this.getData().then(({ data }) => {
            if (data?.items) {
                this.count = data.items.length;
                this.items = data.items;
            }
            this.update();
        });
        this.element.cartItems.on("click", ".remove-item", (e) => {
            e.stopPropagation(); // 👈 THÊM DÒNG NÀY
            const id = $(e.currentTarget).data("id");
            this.remove(id);
            http.delete(`api/cart`, { id }).then(({ message }) => {
                alertSuccess(message);
            });
        });

        this.element.checkAll.on("click", (e) => {
            const isChecked = $(e.currentTarget).is(":checked");
            // check all items in form
            const form = $(e.currentTarget).closest("form");
            form.find("input[type=checkbox]").each(function () {
                $(this).prop("checked", isChecked);
            });
            if (isChecked) {
                this.selects = form
                    .find('input[name="cart_ids[]"]:checked')
                    .map(function () {
                        return $(this).val();
                    })
                    .get();
            } else {
                this.selects = [];
            }
            this.update();
        });

        this.element.cartItems.on("click", 'input[name="cart_ids[]"]', (e) => {
            e.stopPropagation(); // 👈 THÊM DÒNG NÀY
            const form = $(e.currentTarget).closest("form");
            const allChecked =
                form.find('input[name="cart_ids[]"]').length ===
                form.find('input[name="cart_ids[]"]:checked').length;
            this.element.checkAll.prop("checked", allChecked);
            const id = $(e.currentTarget).val();
            if ($(e.currentTarget).is(":checked")) {
                this.selects.push(id);
            } else {
                this.selects = this.selects.filter((item) => item !== id);
            }
            this.update();
        });
    },
};

cartModule.init();
