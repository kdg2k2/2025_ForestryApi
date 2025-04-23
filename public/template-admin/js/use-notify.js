const notify = (message, hexCodeBackgroundColor) => {
    $.notify(message, {
        align: "right",
        verticalAlign: "bottom",
        color: "#fff",
        background: hexCodeBackgroundColor,
        animationType: "drop",
    });
};
