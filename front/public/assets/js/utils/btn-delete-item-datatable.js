$(document).on("click", ".btn-delete-item-datatable", function () {
    event.preventDefault();
    let title = $(this).data("title") ?? "Do you sure want to delete?",
        text = $(this).data("text") ?? "";
    let datatableId = $(this).data("datatable-id") ?? "dataTable";
    Swal.fire({
        icon: "question",
        title,
        text,
        showCancelButton: true,
        confirmButtonText: "Yes!",
        cancelButtonText: `Cancel.`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed || result.value) {
            if (typeof Loader !== "undefined") Loader.show();
            if (typeof loader !== "undefined") loader.show();
            fetch_post(
                $(this).attr("href"),
                {
                    _method: "delete",
                },
                {},
                {
                    method: "delete",
                }
            )
                .then((data) => {
                    if (data.status == false) {
                        throw data.message;
                    }
                    if (typeof Toast !== "undefined")
                        Toast.success(data.message);
                    else
                        Swal.fire({
                            icon: "question",
                            title: data.message,
                        });
                    $(`#${datatableId}`).DataTable().draw();
                })
                .catch((err) => {
                    if (typeof Toast !== "undefined") {
                        if (err.message) Toast.error(err.message);
                        else Toast.error(err);
                    } else {
                        if (err.message)
                            Swal.fire({
                                icon: "question",
                                title: err.message,
                            });
                        else
                            Swal.fire({
                                icon: "question",
                                title: err,
                            });
                    }
                    $(".loading.dimmer").hide();
                })
                .finally(() => {
                    if (typeof Loader !== "undefined") Loader.hide();
                    if (typeof loader !== "undefined") loader.hide();
                });
        }
    });
});
