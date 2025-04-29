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
        cartItems: $(".body-cart .body-cart__content"),
        totalPrice: $(".body-cart #total-price"),
        btnCheckout: $(".btn-checkout"),
    },
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
        this.update();
    },
    update: function () {
        this.element.cartCount.text(this.count);
        let html = '<p class="text-center py-4">Giỏ hàng trống</p>';
        let totalPrice = 0;
        if (this.count != 0) {
            html = this.items
                .map((item) => {
                    const urlDocument = `/admin/documents/${item.document.id}/view`;
                    return /*html*/ `
                        <div class="d-flex justify-content-between align-items-center py-2 cart-item">
                            <input type="hidden" value="${item.id}" name="cart_ids[]" />
                            <div class="d-flex align-items-center">
                                <div class="px-3 text-success"><i class="fs-12 fa-regular fa-file"></i></div>
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
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                            </div>
                        </div>`;
                })
                .join("");
            totalPrice = this.items.reduce((total, item) => {
                return total + item.document.price;
            }, 0);
            this.element.btnCheckout.removeClass("btn-disable");
        }
        this.element.totalPrice.html(formatNumber(totalPrice));
        this.element.cartItems.html(html);
    },
    init: function () {
        this.getData().then(({ data }) => {
            this.count = data.items.length;
            this.items = data.items;
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
    },
};

cartModule.init();
