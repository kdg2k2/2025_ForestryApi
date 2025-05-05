const pageCheckoutOrder = {
    getData: function () {
        const codeOrder = window.location.pathname.split('/').pop();
        return http.get(`api/order/${codeOrder}`)
    },
    update: function () {},
    updateStatus: function () {},
    init: function () {
        this.getData();
    },
};
pageCheckoutOrder.init();
