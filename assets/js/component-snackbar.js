/*$(document).ready(function () {
    $(".snackbar-btn").click(function (t) {
        t.preventDefault();
        var o = $(this).attr("data-pos"),
            a = $(this).attr("data-actionText"),
            n = $(this).attr("data-actionColor");
        void 0 === a && (a = "Dismiss"), void 0 === n && (n = "#FF8A80");
        var c = $(this).attr("data-showActionButton");
        c = void 0 === c || "true" == c, Snackbar.show({
            text: "Welcome! Thanks for checking out Snackbar",
            showActionButton: c,
            actionText: a,
            actionTextColor: n,
            backgroundColor: "#232323",
            width: "auto",
            pos: o
        })
    }), $(".snackbar-btn-callback").click(function () {
        Snackbar.show({
            text: "I have a custom callback when action button is clicked.",
            width: "475px",
            onActionClick: function (t) {
                $(t).css("opacity", 0), Snackbar.show({
                    text: "Thanks for clicking the  <strong>Dismiss</strong>  button!",
                    showActionButton: !1
                })
            }
        })
    })
})(jQuery);