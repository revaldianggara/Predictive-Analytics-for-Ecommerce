$(document).on("click", ".anchor-with-confirm", function () {
    let title = $(this).data("title") ?? "Do you sure?",
        text = $(this).data("text") ?? "",
        confirmButtonText = $(this).data("confirm-button-text") ?? "Yes!",
        cancelButtonText = $(this).data("cancel-button-text") ?? `Cancel.`;
    event.preventDefault();
    Swal.fire({
        icon: "question",
        title,
        text,
        showCancelButton: true,
        confirmButtonText,
        cancelButtonText,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          if (typeof loader !== 'undefined') loader.show();
            else if (typeof Loader !== 'undefined') Loader.show();
            window.location.href = $(this).attr("href");
        }
    });
});
